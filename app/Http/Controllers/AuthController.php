<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class AuthController
 *
 * Controller responsible for handling authentication-related actions
 * including registration, login, and logout.
 *
 * @package App\Http\Controllers
 */
class AuthController extends Controller
{
    /**
     * Handle user registration.
     *
     * This method registers a new user, validates the input, creates a user
     * in the database, and generates a JWT token for authentication.
     *
     * @param Request $request The incoming registration request containing user details.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the generated JWT token.
     *
     * @throws \Illuminate\Validation\ValidationException If the request validation fails.
     */
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:Admin,Manager,User',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'],
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token], 201);
    }

    /**
     * Handle user login.
     *
     * This method attempts to authenticate the user using the provided credentials.
     * If successful, it returns a JWT token for further authentication.
     *
     * @param Request $request The incoming login request containing email and password.
     * @return \Illuminate\Http\JsonResponse A JSON response containing the generated JWT token.
     *
     * @throws \Illuminate\Http\Exceptions\HttpResponseException If the credentials are invalid.
     */
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return response()->json(['token' => $token]);
    }

    /**
     * Handle user logout.
     *
     * This method invalidates the JWT token, effectively logging out the user.
     *
     * @return \Illuminate\Http\JsonResponse A JSON response indicating successful logout.
     */
    public function logout()
    {
        JWTAuth::invalidate(JWTAuth::getToken());

        return response()->json(['message' => 'Logged out successfully']);
    }
}
