<?php
namespace App\Controllers\Api;

use App\Models\KeuanganMasjid;
use Core\Controller;
use Core\Request;
use Core\Response;

class KeuanganMasjidController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/keuangan-masjid",
     *     tags={"Keuangan Masjid"},
     *     summary="Get a list of keuangan masjid records",
     *     description="Retrieve a list of keuangan masjid records",
     *     operationId="keuanganMasjidIndex",
     *     @OA\Response(
     *         response=200,
     *         description="List of keuangan masjid records",
     *     )
     * )
     */
    public function index()
    {
        $keuanganMasjid = KeuanganMasjid::all();
        return Response::json([
            'success' => true,
            'data' => $keuanganMasjid,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/keuangan-masjid/{id}",
     *     tags={"Keuangan Masjid"},
     *     summary="Get a single keuangan masjid record",
     *     description="Retrieve a single keuangan masjid record by ID",
     *     operationId="keuanganMasjidShow",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Keuangan masjid record details",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Keuangan masjid record not found",
     *     )
     * )
     */
    public function show(Request $request)
    {
        $id = $request->params['id'];
        $keuangan = KeuanganMasjid::find($id);
        if ($keuangan) {
            return Response::json([
                'success' => true,
                'data' => $keuangan,
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Record not found',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/keuangan-masjid",
     *     tags={"Keuangan Masjid"},
     *     summary="Create a new keuangan masjid record",
     *     description="Create a new keuangan masjid record",
     *     operationId="keuanganMasjidStore",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Keuangan masjid details",
     *         @OA\JsonContent(
     *              required={"masjid_id","jumlah"},
     *              @OA\Property(property="masjid_id", type="integer"),
     *              @OA\Property(property="jumlah", type="number")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Keuangan masjid created successfully",
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
        $jumlah = $request->input('jumlah');

        // Here, you should add code to validate the inputs.

        // Create the keuangan_masjid array
        $keuangan = [
            'masjid_id' => $masjidId,
            'jumlah' => $jumlah,
        ];

        $keuanganCreated = KeuanganMasjid::create($keuangan);

        if ($keuanganCreated) {
            return Response::json([
                'success' => true,
                'message' => 'Record created successfully',
                'data' => $keuanganCreated,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record creation failed',
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/keuangan-masjid/{id}",
     *     tags={"Keuangan Masjid"},
     *     summary="Update an existing keuangan masjid record",
     *     description="Update an existing keuangan masjid record by ID",
     *     operationId="keuanganMasjidUpdate",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Keuangan masjid details",
     *         @OA\JsonContent(
     *              @OA\Property(property="masjid_id", type="integer"),
     *              @OA\Property(property="jumlah", type="number")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Keuangan masjid updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Keuangan masjid record not found",
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
        $keuangan = KeuanganMasjid::find($id);
        if (!$keuangan) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $keuangan->masjid_id = $request->input('masjid_id') ?? $keuangan->masjid_id;
        $keuangan->jumlah = $request->input('jumlah') ?? $keuangan->jumlah;

        $keuanganUpdated = KeuanganMasjid::update($id, $keuangan);

        if ($keuanganUpdated) {
            return Response::json([
                'success' => true,
                'message' => 'Record updated successfully',
                'data' => $keuangan,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record update failed',
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/keuangan-masjid/{id}",
     *     tags={"Keuangan Masjid"},
     *     summary="Delete a keuangan masjid record",
     *     description="Delete a keuangan masjid record by ID",
     *     operationId="keuanganMasjidDestroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Keuangan masjid deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Keuangan masjid record not found",
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $id = $request->params['id'];
        $keuangan = KeuanganMasjid::find($id);
        if (!$keuangan) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $keuanganDeleted = KeuanganMasjid::delete($id);

        if ($keuanganDeleted) {
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
