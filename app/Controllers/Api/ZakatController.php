<?php
namespace App\Controllers\Api;

use App\Models\Zakat;
use Core\Controller;
use Core\Request;
use Core\Response;

class ZakatController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/zakat",
     *     tags={"Zakat"},
     *     summary="Get a list of zakat records",
     *     description="Retrieve a list of zakat records",
     *     operationId="zakatIndex",
     *     @OA\Response(
     *         response=200,
     *         description="List of zakat records",
     *     )
     * )
     */
    public function index()
    {
        $zakats = Zakat::all();
        return Response::json([
            'success' => true,
            'data' => $zakats,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/zakat/{id}",
     *     tags={"Zakat"},
     *     summary="Get a single zakat record",
     *     description="Retrieve a single zakat record by ID",
     *     operationId="zakatShow",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Zakat record details",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Zakat record not found",
     *     )
     * )
     */
    public function show(Request $request)
    {
        $id = $request->params['id'];
        $zakat = Zakat::find($id);
        if ($zakat) {
            return Response::json([
                'success' => true,
                'data' => $zakat,
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Zakat not found',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/zakat",
     *     tags={"Zakat"},
     *     summary="Create a new zakat record",
     *     description="Create a new zakat record",
     *     operationId="zakatStore",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Zakat details",
     *         @OA\JsonContent(
     *              required={"nama","jumlah","alamat","rincian","keterangan","masjid_id","waktu","status"},
     *              @OA\Property(property="nama", type="string"),
     *              @OA\Property(property="jumlah", type="number"),
     *              @OA\Property(property="alamat", type="string"),
     *              @OA\Property(property="rincian", type="string"),
     *              @OA\Property(property="keterangan", type="string"),
     *              @OA\Property(property="masjid_id", type="integer"),
     *              @OA\Property(property="waktu", type="string", format="date-time"),
     *              @OA\Property(property="status", type="string")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Zakat created successfully",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *     )
     * )
     */
    public function store(Request $request)
    {
        $nama = $request->input('nama');
        $jumlah = $request->input('jumlah');
        $alamat = $request->input('alamat');
        $rincian = $request->input('rincian');
        $keterangan = $request->input('keterangan');
        $masjidId = $request->input('masjid_id');
        $waktu = $request->input('waktu');
        $status = $request->input('status');

        $zakat = [
            'nama' => $nama,
            'jumlah' => $jumlah,
            'alamat' => $alamat,
            'rincian' => $rincian,
            'keterangan' => $keterangan,
            'masjid_id' => $masjidId,
            'waktu' => $waktu,
            'status' => $status,
        ];

        $zakatCreated = Zakat::create($zakat);

        if ($zakatCreated) {
            return Response::json([
                'success' => true,
                'message' => 'Zakat created successfully',
                'data' => $zakatCreated,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Zakat creation failed',
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/zakat/{id}",
     *     tags={"Zakat"},
     *     summary="Update an existing zakat record",
     *     description="Update an existing zakat record by ID",
     *     operationId="zakatUpdate",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Zakat details",
     *         @OA\JsonContent(
     *              @OA\Property(property="nama", type="string"),
     *              @OA\Property(property="jumlah", type="number"),
     *              @OA\Property(property="alamat", type="string"),
     *              @OA\Property(property="rincian", type="string"),
     *              @OA\Property(property="keterangan", type="string"),
     *              @OA\Property(property="masjid_id", type="integer"),
     *              @OA\Property(property="waktu", type="string", format="date-time"),
     *              @OA\Property(property="status", type="string")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Zakat updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Zakat record not found",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *     )
     * )
     */
    public function update(Request $request)
    {
        $id = $request->params['id'];
        $zakat = Zakat::find($id);
        if (!$zakat) {
            return Response::json([
                'success' => false,
                'message' => 'Zakat not found',
            ]);
        }

        $zakat->nama = $request->input('nama') ?? $zakat->nama;
        $zakat->jumlah = $request->input('jumlah') ?? $zakat->jumlah;
        $zakat->alamat = $request->input('alamat') ?? $zakat->alamat;
        $zakat->rincian = $request->input('rincian') ?? $zakat->rincian;
        $zakat->keterangan = $request->input('keterangan') ?? $zakat->keterangan;
        $zakat->masjid_id = $request->input('masjid_id') ?? $zakat->masjid_id;
        $zakat->waktu = $request->input('waktu') ?? $zakat->waktu;
        $zakat->status = $request->input('status') ?? $zakat->status;

        $zakatUpdated = Zakat::update($id, $zakat);

        if ($zakatUpdated) {
            return Response::json([
                'success' => true,
                'message' => 'Zakat updated successfully',
                'data' => $zakat,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Zakat update failed',
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/zakat/{id}",
     *     tags={"Zakat"},
     *     summary="Delete a zakat record",
     *     description="Delete a zakat record by ID",
     *     operationId="zakatDestroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Zakat deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Zakat record not found",
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $id = $request->params['id'];
        $zakat = Zakat::find($id);
        if (!$zakat) {
            return Response::json([
                'success' => false,
                'message' => 'Zakat not found',
            ]);
        }

        $zakatDeleted = Zakat::delete($id);

        if ($zakatDeleted) {
            return Response::json([
                'success' => true,
                'message' => 'Zakat deleted successfully',
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Zakat deletion failed',
        ]);
    }
}
