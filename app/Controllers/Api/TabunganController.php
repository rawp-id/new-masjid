<?php
namespace App\Controllers\Api;

use App\Models\Tabungan;
use Core\Controller;
use Core\Request;
use Core\Response;

class TabunganController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/tabungan",
     *     tags={"Tabungan"},
     *     summary="Get list of tabungan records",
     *     description="Retrieve a list of tabungan records",
     *     operationId="tabunganIndex",
     *     @OA\Response(
     *         response=200,
     *         description="List of tabungan records",
     *     )
     * )
     */
    public function index()
    {
        $tabungan = Tabungan::all();
        return Response::json([
            'success' => true,
            'data' => $tabungan,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/tabungan/{id}",
     *     tags={"Tabungan"},
     *     summary="Get a single tabungan record",
     *     description="Retrieve a single tabungan record by ID",
     *     operationId="tabunganShow",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tabungan record details",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tabungan record not found",
     *     )
     * )
     */
    public function show($id)
    {
        $tabungan = Tabungan::find($id);
        if ($tabungan) {
            return Response::json([
                'success' => true,
                'data' => $tabungan,
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Record not found',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/tabungan",
     *     tags={"Tabungan"},
     *     summary="Create a new tabungan record",
     *     description="Create a new tabungan record",
     *     operationId="tabunganStore",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Tabungan details",
     *         @OA\JsonContent(
     *              required={"jamaah_id","jumlah","tanggal","keterangan"},
     *              @OA\Property(property="jamaah_id", type="integer"),
     *              @OA\Property(property="jumlah", type="number"),
     *              @OA\Property(property="tanggal", type="string", format="date"),
     *              @OA\Property(property="keterangan", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Tabungan record created successfully",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *     )
     * )
     */
    public function store(Request $request)
    {
        // Create the tabungan array
        $tabungan = [
            'jamaah_id' => $request->input('jamaah_id'),
            'jumlah' => $request->input('jumlah'),
            'tanggal' => $request->input('tanggal'),
            'keterangan' => $request->input('keterangan'),
        ];

        $tabunganCreated = Tabungan::create($tabungan);

        if ($tabunganCreated) {
            return Response::json([
                'success' => true,
                'message' => 'Record created successfully',
                'data' => $tabunganCreated,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record creation failed',
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/tabungan/{id}",
     *     tags={"Tabungan"},
     *     summary="Update an existing tabungan record",
     *     description="Update an existing tabungan record by ID",
     *     operationId="tabunganUpdate",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Tabungan details",
     *         @OA\JsonContent(
     *              required={"jamaah_id","jumlah","tanggal","keterangan"},
     *              @OA\Property(property="jamaah_id", type="integer"),
     *              @OA\Property(property="jumlah", type="number"),
     *              @OA\Property(property="tanggal", type="string", format="date"),
     *              @OA\Property(property="keterangan", type="string"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tabungan record updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tabungan record not found",
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
        $tabungan = Tabungan::find($id);
        if (!$tabungan) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $tabungan->jamaah_id = $request->input('jamaah_id') ?? $tabungan->jamaah_id;
        $tabungan->jumlah = $request->input('jumlah') ?? $tabungan->jumlah;
        $tabungan->tanggal = $request->input('tanggal') ?? $tabungan->tanggal;
        $tabungan->keterangan = $request->input('keterangan') ?? $tabungan->keterangan;

        $tabunganUpdated = Tabungan::update($id, $tabungan);

        if ($tabunganUpdated) {
            return Response::json([
                'success' => true,
                'message' => 'Record updated successfully',
                'data' => $tabungan,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record update failed',
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/tabungan/{id}",
     *     tags={"Tabungan"},
     *     summary="Delete a tabungan record",
     *     description="Delete a tabungan record by ID",
     *     operationId="tabunganDestroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Tabungan record deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Tabungan record not found",
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $id = $request->params['id'];
        $tabungan = Tabungan::find($id);
        if (!$tabungan) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $tabunganDeleted = $tabungan->delete();

        if ($tabunganDeleted) {
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
