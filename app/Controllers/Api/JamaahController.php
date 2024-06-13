<?php
namespace App\Controllers\Api;

use App\Models\Jamaah;
use Core\Controller;
use Core\Request;
use Core\Response;

class JamaahController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/jamaah",
     *     tags={"Jamaah"},
     *     summary="Get a list of jamaah records",
     *     description="Retrieve a list of jamaah records",
     *     operationId="jamaahIndex",
     *     @OA\Response(
     *         response=200,
     *         description="List of jamaah records",
     *     )
     * )
     */
    public function index()
    {
        $jamaah = Jamaah::all();
        return Response::json([
            'success' => true,
            'data' => $jamaah,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/jamaah/{id}",
     *     tags={"Jamaah"},
     *     summary="Get a single jamaah record",
     *     description="Retrieve a single jamaah record by ID",
     *     operationId="jamaahShow",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Jamaah record details",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jamaah record not found",
     *     )
     * )
     */
    public function show(Request $request)
    {
        $id = $request->params['id'];
        $jamaah = Jamaah::find($id);
        if ($jamaah) {
            return Response::json([
                'success' => true,
                'data' => $jamaah,
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Record not found',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/jamaah",
     *     tags={"Jamaah"},
     *     summary="Create a new jamaah record",
     *     description="Create a new jamaah record",
     *     operationId="jamaahStore",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Jamaah details",
     *         @OA\JsonContent(
     *              required={"nama", "alamat", "jenis_kelamin", "masjid_id"},
     *              @OA\Property(property="nama", type="string"),
     *              @OA\Property(property="alamat", type="string"),
     *              @OA\Property(property="jenis_kelamin", type="string"),
     *              @OA\Property(property="masjid_id", type="integer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Jamaah created successfully",
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
        $alamat = $request->input('alamat');
        $jenis_kelamin = $request->input('jenis_kelamin');
        $masjid_id = $request->input('masjid_id');

        $jamaah = [
            'nama' => $nama,
            'alamat' => $alamat,
            'jenis_kelamin' => $jenis_kelamin,
            'masjid_id' => $masjid_id,
        ];

        $jamaahCreated = Jamaah::create($jamaah);

        if ($jamaahCreated) {
            return Response::json([
                'success' => true,
                'message' => 'Record created successfully',
                'data' => $jamaahCreated,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record creation failed',
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/jamaah/{id}",
     *     tags={"Jamaah"},
     *     summary="Update an existing jamaah record",
     *     description="Update an existing jamaah record by ID",
     *     operationId="jamaahUpdate",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Jamaah details",
     *         @OA\JsonContent(
     *              @OA\Property(property="nama", type="string"),
     *              @OA\Property(property="alamat", type="string"),
     *              @OA\Property(property="jenis_kelamin", type="string"),
     *              @OA\Property(property="masjid_id", type="integer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Jamaah updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jamaah record not found",
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
        $jamaah = Jamaah::find($id);
        if (!$jamaah) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $jamaah->nama = $request->input('nama') ?? $jamaah->nama;
        $jamaah->alamat = $request->input('alamat') ?? $jamaah->alamat;
        $jamaah->jenis_kelamin = $request->input('jenis_kelamin') ?? $jamaah->jenis_kelamin;
        $jamaah->masjid_id = $request->input('masjid_id') ?? $jamaah->masjid_id;

        $jamaahUpdated = Jamaah::update($id, $jamaah);

        if ($jamaahUpdated) {
            return Response::json([
                'success' => true,
                'message' => 'Record updated successfully',
                'data' => $jamaah,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record update failed',
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/jamaah/{id}",
     *     tags={"Jamaah"},
     *     summary="Delete a jamaah record",
     *     description="Delete a jamaah record by ID",
     *     operationId="jamaahDestroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Jamaah deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Jamaah record not found",
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $id = $request->params['id'];
        $jamaah = Jamaah::find($id);
        if (!$jamaah) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $jamaahDeleted = Jamaah::delete($id);

        if ($jamaahDeleted) {
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
