<?php
namespace App\Controllers\Api;

use App\Models\DetailKeuangan;
use App\Models\KeuanganMasjid;
use Core\Controller;
use Core\Request;
use Core\Response;
use Core\UploadedFile;

class DetailKeuanganController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/detail-keuangan",
     *     tags={"Detail Keuangan"},
     *     summary="Get a list of detail keuangan records",
     *     description="Retrieve a list of detail keuangan records",
     *     operationId="detailKeuanganIndex",
     *     @OA\Response(
     *         response=200,
     *         description="List of detail keuangan records",
     *     )
     * )
     */
    public function index()
    {
        $details = DetailKeuangan::all();
        return Response::json([
            'success' => true,
            'data' => $details,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/detail-keuangan/{id}",
     *     tags={"Detail Keuangan"},
     *     summary="Get a single detail keuangan record",
     *     description="Retrieve a single detail keuangan record by ID",
     *     operationId="detailKeuanganShow",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail keuangan record details",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Detail keuangan record not found",
     *     )
     * )
     */
    public function show(Request $request)
    {
        $id = $request->params['id'];
        $detail = DetailKeuangan::find($id);
        if ($detail) {
            return Response::json([
                'success' => true,
                'data' => $detail,
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Record not found',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/detail-keuangan",
     *     tags={"Detail Keuangan"},
     *     summary="Create a new detail keuangan record",
     *     description="Create a new detail keuangan record",
     *     operationId="detailKeuanganStore",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Detail keuangan details",
     *         @OA\JsonContent(
     *              required={"masjid_id", "jenis", "jumlah", "tanggal", "keterangan"},
     *              @OA\Property(property="masjid_id", type="integer"),
     *              @OA\Property(property="jenis", type="string"),
     *              @OA\Property(property="jumlah", type="number"),
     *              @OA\Property(property="tanggal", type="string", format="date"),
     *              @OA\Property(property="keterangan", type="string"),
     *              @OA\Property(property="bukti", type="file")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Detail keuangan created successfully",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *     )
     * )
     */
    public function store(Request $request)
    {
        $masjidId = $request->input('masjid_id');
        $jenis = $request->input('jenis');
        $jumlah = $request->input('jumlah');
        $tanggal = $request->input('tanggal');
        $keterangan = $request->input('keterangan');

        // Cek apakah ada file yang diunggah
        if ($request->hasFile('bukti')) {
            $uploadedFile = new UploadedFile($_FILES['bukti']);

            // Validasi file yang diunggah
            if ($uploadedFile->isValid()) {
                $destinationPath = public_path('uploads');
                $filePath = $uploadedFile->move($destinationPath);
                $fileHash = $uploadedFile->getFileHash();
                $detail = [
                    'masjid_id' => $masjidId,
                    'jenis' => $jenis,
                    'jumlah' => $jumlah,
                    'tanggal' => $tanggal,
                    'keterangan' => $keterangan,
                    'bukti' => $uploadedFile->getHashedFileName(),
                ];

                $detailCreated = DetailKeuangan::create($detail);

                if ($detailCreated) {
                    // Berhasil membuat detail keuangan, berikan respons sukses
                    return Response::json([
                        'success' => true,
                        'message' => 'Record created successfully',
                        'data' => $detailCreated,
                    ]);
                }

                // Gagal membuat detail keuangan, berikan respons gagal
                return Response::json([
                    'success' => false,
                    'message' => 'Record creation failed',
                ]);
            }
        }

        // Tidak ada file yang diunggah, lanjutkan tanpa file

        // Buat detail keuangan tanpa file
        $detail = [
            'masjid_id' => $masjidId,
            'jenis' => $jenis,
            'jumlah' => $jumlah,
            'tanggal' => $tanggal,
            'keterangan' => $keterangan,
        ];

        // Simpan detail keuangan
        $detailCreated = DetailKeuangan::create($detail);

        if ($detailCreated) {
            // Recalculate total balance
            $keuanganDetails = DetailKeuangan::where('masjid_id', '=', $masjidId);
            $totalSaldo = 0;

            foreach ($keuanganDetails as $keuanganDetail) {
                if ($keuanganDetail->jenis === 'pemasukan') {
                    $totalSaldo += $keuanganDetail->jumlah;
                } else {
                    $totalSaldo -= $keuanganDetail->jumlah;
                }
            }

            // Update keuangan masjid
            $keuanganMasjid = KeuanganMasjid::first('masjid_id', '=', $masjidId);
            if ($keuanganMasjid) {
                KeuanganMasjid::update($keuanganMasjid->id, ['jumlah' => $totalSaldo]);
            } else {
                KeuanganMasjid::create([
                    'masjid_id' => $masjidId,
                    'jumlah' => $totalSaldo,
                ]);
            }
        }

        if ($detailCreated) {
            return Response::json([
                'success' => true,
                'message' => 'Record created successfully',
                'data' => $detailCreated,
            ]);
        }

        // Gagal membuat detail keuangan, berikan respons gagal
        return Response::json([
            'success' => false,
            'message' => 'Record creation failed',
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/detail-keuangan/{id}",
     *     tags={"Detail Keuangan"},
     *     summary="Update an existing detail keuangan record",
     *     description="Update an existing detail keuangan record by ID",
     *     operationId="detailKeuanganUpdate",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the detail keuangan record",
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Detail keuangan details",
     *         @OA\JsonContent(
     *              @OA\Property(property="masjid_id", type="integer", example=1),
     *              @OA\Property(property="jenis", type="string", example="Pemasukan"),
     *              @OA\Property(property="jumlah", type="number", example=100000),
     *              @OA\Property(property="tanggal", type="string", format="date", example="2023-01-01"),
     *              @OA\Property(property="keterangan", type="string", example="Donasi"),
     *              @OA\Property(property="bukti", type="file")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail keuangan updated successfully",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=true),
     *             @OA\Property(property="message", type="string", example="Record updated successfully"),
     *             @OA\Property(property="data", type="object",
     *                 @OA\Property(property="id", type="integer", example=1),
     *                 @OA\Property(property="masjid_id", type="integer", example=1),
     *                 @OA\Property(property="jenis", type="string", example="Pemasukan"),
     *                 @OA\Property(property="jumlah", type="number", example=100000),
     *                 @OA\Property(property="tanggal", type="string", format="date", example="2023-01-01"),
     *                 @OA\Property(property="keterangan", type="string", example="Donasi")
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Detail keuangan record not found",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Record not found")
     *         )
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *         @OA\JsonContent(
     *             @OA\Property(property="success", type="boolean", example=false),
     *             @OA\Property(property="message", type="string", example="Validation error")
     *         )
     *     )
     * )
     */
    public function update(Request $request)
    {
        $id = $request->params['id'];
        $detail = DetailKeuangan::find($id);
        if (!$detail) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        if ($request->hasFile('bukti')) {
            $uploadedFile = new UploadedFile($request->file('bukti'));

            if ($uploadedFile->isValid()) {
                $destinationPath = public_path('uploads');
                $filePath = $uploadedFile->move($destinationPath);
                $fileHash = $uploadedFile->getFileHash();
                $detail->bukti = $uploadedFile->getHashedFileName();
                $detail->masjid_id = $request->input('masjid_id') ?? $detail->masjid_id;
                $detail->jenis = $request->input('jenis') ?? $detail->jenis;
                $detail->jumlah = $request->input('jumlah') ?? $detail->jumlah;
                $detail->tanggal = $request->input('tanggal') ?? $detail->tanggal;
                $detail->keterangan = $request->input('keterangan') ?? $detail->keterangan;

                $detail = [
                    'jenis' => $detail->jenis,
                    'jumlah' => $detail->jumlah,
                    'tanggal' => $detail->tanggal,
                    'keterangan' => $detail->keterangan,
                    'bukti' => $uploadedFile->getHashedFileName(),
                ];


                $detailUpdated = DetailKeuangan::update($id, $detail);

                if ($detailUpdated) {
                    // Berhasil membuat detail keuangan, berikan respons sukses
                    return Response::json([
                        'success' => true,
                        'message' => 'Record created successfully',
                        'data' => $detailUpdated,
                    ]);
                }

                // Gagal membuat detail keuangan, berikan respons gagal
                return Response::json([
                    'success' => false,
                    'message' => 'Record creation failed',
                ]);
            }
        }

        $detail->masjid_id = $request->input('masjid_id') ?? $detail->masjid_id;
        $detail->jenis = $request->input('jenis') ?? $detail->jenis;
        $detail->jumlah = $request->input('jumlah') ?? $detail->jumlah;
        $detail->tanggal = $request->input('tanggal') ?? $detail->tanggal;
        $detail->keterangan = $request->input('keterangan') ?? $detail->keterangan;

        $detailUpdated = DetailKeuangan::update($id, $detail);


        if ($detailUpdated) {
            $keuanganDetails = DetailKeuangan::where('masjid_id', '=', $detail->masjid_id);
            $totalSaldo = 0;

            foreach ($keuanganDetails as $keuanganDetail) {
                if ($keuanganDetail->jenis === 'pemasukan') {
                    $totalSaldo += $keuanganDetail->jumlah;
                } else {
                    $totalSaldo -= $keuanganDetail->jumlah;
                }
            }

            $keuanganMasjid = KeuanganMasjid::first('masjid_id', '=', $detail->masjid_id);
            if ($keuanganMasjid) {
                KeuanganMasjid::update($keuanganMasjid->id, ['jumlah' => $totalSaldo]);
            } else {
                KeuanganMasjid::create([
                    'masjid_id' => $detail->masjid_id,
                    'jumlah' => $totalSaldo,
                ]);
            }

            return Response::json([
                'success' => true,
                'message' => 'Record updated successfully',
                'data' => DetailKeuangan::find($id),
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record update failed',
        ]);
    }



    /**
     * @OA\Delete(
     *     path="/api/detail-keuangan/{id}",
     *     tags={"Detail Keuangan"},
     *     summary="Delete a detail keuangan record",
     *     description="Delete a detail keuangan record by ID",
     *     operationId="detailKeuanganDestroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detail keuangan deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Detail keuangan record not found",
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $id = $request->params['id'];
        $detail = DetailKeuangan::find($id);
        if (!$detail) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $detailDeleted = DetailKeuangan::delete($id);

        if ($detailDeleted) {
            $keuanganDetails = DetailKeuangan::where('masjid_id', '=', $detail->masjid_id);
            $totalSaldo = 0;

            foreach ($keuanganDetails as $keuanganDetail) {
                if ($keuanganDetail->jenis === 'pemasukan') {
                    $totalSaldo += $keuanganDetail->jumlah;
                } else {
                    $totalSaldo -= $keuanganDetail->jumlah;
                }
            }

            $keuanganMasjid = KeuanganMasjid::first('masjid_id', '=', $detail->masjid_id);
            if ($keuanganMasjid) {
                KeuanganMasjid::update($keuanganMasjid->id, ['jumlah' => $totalSaldo]);
            } else {
                KeuanganMasjid::create([
                    'masjid_id' => $detail->masjid_id,
                    'jumlah' => $totalSaldo,
                ]);
            }
            return Response::json([
                'success' => true,
                'message' => 'Record deleted successfully',
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record deletion failed',
        ]);
    }
}
