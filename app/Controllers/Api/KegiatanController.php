<?php
namespace App\Controllers\Api;

use App\Models\Kegiatan;
use Core\Controller;
use Core\Request;
use Core\Response;

class KegiatanController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/kegiatan",
     *     tags={"Kegiatan"},
     *     summary="Get a list of kegiatan records",
     *     description="Retrieve a list of kegiatan records",
     *     operationId="kegiatanIndex",
     *     @OA\Response(
     *         response=200,
     *         description="List of kegiatan records",
     *     )
     * )
     */
    public function index()
    {
        $kegiatan = Kegiatan::all();
        return Response::json([
            'success' => true,
            'data' => $kegiatan,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/kegiatan/{id}",
     *     tags={"Kegiatan"},
     *     summary="Get a single kegiatan record",
     *     description="Retrieve a single kegiatan record by ID",
     *     operationId="kegiatanShow",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Kegiatan record details",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kegiatan record not found",
     *     )
     * )
     */
    public function show(Request $request)
    {
        $id = $request->params['id'];
        $kegiatan = Kegiatan::find($id);
        if ($kegiatan) {
            return Response::json([
                'success' => true,
                'data' => $kegiatan,
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Record not found',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/kegiatan",
     *     tags={"Kegiatan"},
     *     summary="Create a new kegiatan record",
     *     description="Create a new kegiatan record",
     *     operationId="kegiatanStore",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Kegiatan details",
     *         @OA\JsonContent(
     *              required={"masjid_id","acara","waktu"},
     *              @OA\Property(property="masjid_id", type="integer"),
     *              @OA\Property(property="acara", type="string"),
     *              @OA\Property(property="waktu", type="string", format="date-time"),
     *              @OA\Property(property="keterangan", type="string")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Kegiatan created successfully",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Create the kegiatan array
        $kegiatan = [
            'masjid_id' => $request->input('masjid_id'),
            'acara' => $request->input('acara'),
            'waktu' => $request->input('waktu'),
            'keterangan' => $request->input('keterangan'),
        ];

        $kegiatanCreated = Kegiatan::create($kegiatan);

        if ($kegiatanCreated) {
            return Response::json([
                'success' => true,
                'message' => 'Record created successfully',
                'data' => $kegiatanCreated,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record creation failed',
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/kegiatan/{id}",
     *     tags={"Kegiatan"},
     *     summary="Update an existing kegiatan record",
     *     description="Update an existing kegiatan record by ID",
     *     operationId="kegiatanUpdate",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Kegiatan details",
     *         @OA\JsonContent(
     *              @OA\Property(property="masjid_id", type="integer"),
     *              @OA\Property(property="acara", type="string"),
     *              @OA\Property(property="waktu", type="string", format="date-time"),
     *              @OA\Property(property="keterangan", type="string")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Kegiatan updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kegiatan record not found",
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
        $kegiatan = Kegiatan::find($id);
        if (!$kegiatan) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $kegiatan->masjid_id = $request->input('masjid_id') ?? $kegiatan->masjid_id;
        $kegiatan->acara = $request->input('acara') ?? $kegiatan->acara;
        $kegiatan->waktu = $request->input('waktu') ?? $kegiatan->waktu;
        $kegiatan->keterangan = $request->input('keterangan') ?? $kegiatan->keterangan;

        $kegiatanUpdated = Kegiatan::update($id, $kegiatan);

        if ($kegiatanUpdated) {
            return Response::json([
                'success' => true,
                'message' => 'Record updated successfully',
                'data' => $kegiatan,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record update failed',
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/kegiatan/{id}",
     *     tags={"Kegiatan"},
     *     summary="Delete a kegiatan record",
     *     description="Delete a kegiatan record by ID",
     *     operationId="kegiatanDestroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Kegiatan deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Kegiatan record not found",
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $id = $request->params['id'];
        $kegiatan = Kegiatan::find($id);
        if (!$kegiatan) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $kegiatanDeleted = Kegiatan::delete($id);

        if ($kegiatanDeleted) {
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
