<?php
namespace App\Controllers\Api;

use App\Models\Users;
use Core\Auth;
use Core\Controller;
use Core\Request;
use Core\Response;

class UserController extends Controller
{
    /**
     * @OA\Post(
     *     path="/api/login",
     *     tags={"User"},
     *     summary="Login user",
     *     description="Login user with email and password",
     *     operationId="userLogin",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User credentials",
     *         @OA\JsonContent(
     *              required={"email","password"},
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string", format="password"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Login successful",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Login failed",
     *     )
     * )
     */
    public function login(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        $user = [
            'email' => $email,
            'password' => $password,
        ];
        Auth::attempt($user);
        if (Auth::check()) {
            return Response::json([
                'success' => true,
                'message' => 'Login successful'
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'Login failed',
        ]);
    }

    /**
     * @OA\Get(
     *     path="/api/user/check",
     *     tags={"User"},
     *     summary="Check user authentication",
     *     description="Check if user is authenticated",
     *     operationId="userCheck",
     *     @OA\Response(
     *         response=200,
     *         description="User is authenticated",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="User is not authenticated",
     *     )
     * )
     */
    public function check()
    {
        if (Auth::check()) {
            return Response::json([
                'success' => true,
                'message' => 'User is authenticated',
                'user' => Users::find(Auth::id()),
            ]);
        }
        return Response::json([
            'success' => false,
            'message' => 'User is not authenticated'

        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/register",
     *     tags={"User"},
     *     summary="Register user",
     *     description="Register user with email and password",
     *     operationId="userRegister",
     *     @OA\RequestBody(
     *         required=true,
     *         description="User details",
     *         @OA\JsonContent(
     *              required={"nama","email","password"},
     *              @OA\Property(property="nama", type="string"),
     *              @OA\Property(property="email", type="string"),
     *              @OA\Property(property="password", type="string", format="password"),
     *         ),
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Registration successful",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Registration failed",
     *     )
     * )
     */
    public function register(Request $request)
    {
        $nama = $request->input('nama');
        $password = $request->input('password');
        $email = $request->input('email');

        // Here, you should add code to validate the inputs, such as checking if the email or email already exists, password strength, etc.

        // Create the user array
        $user = [
            'nama' => $nama,
            'password' => password_hash($password, PASSWORD_DEFAULT), // Hash the password
            'email' => $email,
        ];

        // Assuming you have a User model with a create method to save the user to the database
        $userCreated = Users::create($user);

        if ($userCreated) {
            return Response::json([
                'success' => true,
                'message' => 'Registration successful',
            ]);
        }

        return Response::json([
            'success' => false,
            'message' => 'Registration failed',
        ]);
    }

    /**
     * @OA\Post(
     *     path="/api/logout",
     *     tags={"User"},
     *     summary="Logout user",
     *     description="Logout authenticated user",
     *     operationId="userLogout",
     *     @OA\Response(
     *         response=200,
     *         description="Logout successful",
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Logout failed",
     *     )
     * )
     */
    public function logout()
    {
        Auth::logout();
        if (!Auth::check()) {
            return Response::json([
                'success' => true,
                'message' => 'Logout successful',
            ]);
        }
    }
}
