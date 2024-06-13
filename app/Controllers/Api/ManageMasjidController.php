<?php
namespace App\Controllers\Api;

use App\Models\ManageMasjid;
use App\Models\Masjid;
use Core\Controller;
use Core\Request;
use Core\Response;

class ManageMasjidController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/manage-masjid",
     *     tags={"Manage Masjid"},
     *     summary="Get a list of manage masjid records",
     *     description="Retrieve a list of manage masjid records",
     *     operationId="manageMasjidIndex",
     *     @OA\Response(
     *         response=200,
     *         description="List of manage masjid records",
     *     )
     * )
     */
    public function index()
    {
        $manageMasjids = ManageMasjid::all();
        return Response::json([
            'success' => true,
            'data' => $manageMasjids,
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/manage-masjid/{id}",
     *     tags={"Manage Masjid"},
     *     summary="Get a single manage masjid record",
     *     description="Retrieve a single manage masjid record by ID",
     *     operationId="manageMasjidShow",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Manage masjid record details",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Manage masjid record not found",
     *     )
     * )
     */
    public function show(Request $request)
    {
        $id = $request->params['id'];
        $manageMasjid = ManageMasjid::find($id);
        if ($manageMasjid) {
            return Response::json([
                'success' => true,
                'data' => $manageMasjid,
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Record not found',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/manage-masjid",
     *     tags={"Manage Masjid"},
     *     summary="Create a new manage masjid record",
     *     description="Create a new manage masjid record",
     *     operationId="manageMasjidStore",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Manage masjid details",
     *         @OA\JsonContent(
     *              required={"user_id","masjid_id","role_id"},
     *              @OA\Property(property="user_id", type="integer"),
     *              @OA\Property(property="masjid_id", type="integer"),
     *              @OA\Property(property="role_id", type="integer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Manage masjid created successfully",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error",
     *     )
     * )
     */
    public function store(Request $request)
    {
        $userId = $request->input('user_id');
        $kode_ms = $request->input('kode_ms');
        $roleId = $request->input('role_id');

        // Here, you should add code to validate the inputs, such as checking if the IDs exist, etc.
        $masjid = Masjid::first('kode_ms', '=', $kode_ms);

        if ($masjid) {
            // Create the manage_masjid array
            $manageMasjid = [
                'user_id' => $userId,
                'masjid_id' => $masjid->id,
                'role_id' => $roleId,
            ];

            $manageMasjidCreated = ManageMasjid::create($manageMasjid);

            if ($manageMasjidCreated) {
                return Response::json([
                    'success' => true,
                    'message' => 'Record created successfully',
                    'data' => $manageMasjidCreated,
                ]);
            }
        }

        return Response::json([
            'success' => false,
            'message' => 'Record creation failed',
        ]);
    }

    /**
     * @OA\Put(
     *     path="/api/manage-masjid/{id}",
     *     tags={"Manage Masjid"},
     *     summary="Update an existing manage masjid record",
     *     description="Update an existing manage masjid record by ID",
     *     operationId="manageMasjidUpdate",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Manage masjid details",
     *         @OA\JsonContent(
     *              @OA\Property(property="user_id", type="integer"),
     *              @OA\Property(property="masjid_id", type="integer"),
     *              @OA\Property(property="role_id", type="integer")
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Manage masjid updated successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Manage masjid record not found",
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
        $manageMasjid = ManageMasjid::find($id);
        if (!$manageMasjid) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $manageMasjid->user_id = $request->input('user_id') ?? $manageMasjid->user_id;
        $manageMasjid->masjid_id = $request->input('masjid_id') ?? $manageMasjid->masjid_id;
        $manageMasjid->role_id = $request->input('role_id') ?? $manageMasjid->role_id;

        $manageMasjidUpdated = ManageMasjid::update($id, $manageMasjid);

        if ($manageMasjidUpdated) {
            return Response::json([
                'success' => true,
                'message' => 'Record updated successfully',
                'data' => $manageMasjid,
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Record update failed',
        ]);
    }

    /**
     * @OA\Delete(
     *     path="/api/manage-masjid/{id}",
     *     tags={"Manage Masjid"},
     *     summary="Delete a manage masjid record",
     *     description="Delete a manage masjid record by ID",
     *     operationId="manageMasjidDestroy",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Manage masjid deleted successfully",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Manage masjid record not found",
     *     )
     * )
     */
    public function destroy(Request $request)
    {
        $id = $request->params['id'];
        $manageMasjid = ManageMasjid::find($id);
        if (!$manageMasjid) {
            return Response::json([
                'success' => false,
                'message' => 'Record not found',
            ]);
        }

        $manageMasjidDeleted = ManageMasjid::delete($id);

        if ($manageMasjidDeleted) {
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
