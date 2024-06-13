<?php
namespace App\Controllers\Api;

use App\Models\ManageMasjid;
use App\Models\Masjid;
use Core\Auth;
use Core\Controller;
use Core\Request;
use Core\Response;

class MasjidController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/masjid",
     *     tags={"Masjid"},
     *     summary="Get a list of masjid",
     *     description="Retrieve a list of masjid",
     *     operationId="masjidIndex",
     *     @OA\Response(
     *         response=200,
     *         description="List of masjid",
     *     )
     * )
     */
    public function index()
    {
        $masjids = Masjid::all();
        return Response::json([
            'success' => true,
            'data' => $masjids,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/masjid/{id}",
     *     tags={"Masjid"},
     *     summary="Get a single masjid",
     *     description="Retrieve a single masjid by ID",
     *     operationId="masjidShow",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Masjid details",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Masjid not found",
     *     )
     * )
     */
    public function show(Request $request)
    {
        $id = $request->params['id'];
        $masjid = Masjid::find($id);
        if ($masjid) {
            return Response::json([
                'success' => true,
                'data' => $masjid,
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Masjid not found',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/masjid",
     *     tags={"Masjid"},
     *     summary="Create a new masjid",
     *     description="Create a new masjid",
     *     operationId="masjidStore",
     *     @OA\RequestBody(
     *         required=true,
     *          description="form masjid",
     *          @OA\JsonContent(
     *              required={"nama,alamat,keterangan,kode_ms"},
     *              @OA\Property(property="nama", type="string"),
     *              @OA\Property(property="alamat", type="string"),
     *              @OA\Property(property="keterangan", type="string"),
     *              @OA\Property(property="kode_ms", type="string")
     *          ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Masjid created successfully",
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
        $keterangan = $request->input('keterangan');
        $kode_ms = $request->input('kode_ms');

        // Create the masjid array
        $masjid = [
            'nama' => $nama,
            'alamat' => $alamat,
            'keterangan' => $keterangan,
            'kode_ms' => $kode_ms,
        ];

        $masjidCreated = Masjid::create($masjid);

        if ($masjidCreated) {
            $manageData = [
                'masjid_id' => $masjidCreated->id,
                'user_id' => Auth::id(),
                'role_id' => 1
            ];
            $manage = ManageMasjid::create($manageData);
            if ($manage) {
                return Response::json([
                    'success' => true,
                    'message' => 'Masjid created successfully',
                    'data' => $masjidCreated,
                ]);
            }
        }

        return Response::json([
            'success' => false,
            'message' => 'Masjid creation failed',
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/masjid/{id}",
     *     tags={"Masjid"},
     *     summary="Update an existing masjid",
     *     description="Update an existing masjid by ID",
     *     operationId="masjidUpdate",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *          @OA\JsonContent(
     *              required={"nama,alamat,keterangan,kode_ms"},
     *              @OA\Property(property="nama", type="string"),
     *              @OA\Property(property="alamat", type="string"),
     *              @OA\Property(property="keterangan", type="string"),
     *              @OA\Property(property="kode_ms", type="string")
     *          ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Masjid updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Masjid not found",
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
        $masjid = Masjid::find($id);
        if (!$masjid) {
            return Response::json([
                'success' => false,
                'message' => 'Masjid not found',
            ]);
        }

        $masjid->nama = $request->input('nama') ?? $masjid->nama;
        $masjid->alamat = $request->input('alamat') ?? $masjid->alamat;
        $masjid->keterangan = $request->input('keterangan') ?? $masjid->keterangan;
        $masjid->kode_ms = $request->input('kode_ms') ?? $masjid->kode_ms;

        $masjidUpdated = Masjid::update($id, $masjid);

        if ($masjidUpdated) {
            return Response::json([
                'success' => true,
                'message' => 'Masjid updated successfully',
                'data' => $masjid,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Masjid update failed',
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/masjid/{id}",
     *     tags={"Masjid"},
     *     summary="Delete a masjid",
     *     description="Delete a masjid by ID",
     *     operationId="masjidDestroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Masjid deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Masjid not found",
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $id = $request->params['id'];
        $masjid = Masjid::find($id);
        if (!$masjid) {
            return Response::json([
                'success' => false,
                'message' => 'Masjid not found',
            ]);
        }

        $masjidDeleted = Masjid::delete($id);

        if ($masjidDeleted) {
            return Response::json([
                'success' => true,
                'message' => 'Masjid deleted successfully',
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Masjid deletion failed',
        ]);
    }
}
