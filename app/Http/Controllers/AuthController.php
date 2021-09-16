<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * register user resource in API.
     *
     * @param Request $request
     * @return Response
     */
    public function InscrisUtilisateur(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $utilisateur = new User;

        $utilisateur->name = $request->name;
        $utilisateur->email = $request->email;
        $utilisateur->password = bcrypt($request->password);
        $utilisateur->save();

        return response()->json([
            'data' => $utilisateur
        ], 201);
    }

    /**
     * connexion user resource in API.
     *
     * @param Request $request
     * @return Response
     */
    public function connexion(Request $request)
    {
        try {
            $request->validate([
                'email' => 'email|required',
                'password' => 'required'
            ]);

            $credentials = request(['email', 'password']);

            if (!Auth::attempt($credentials)) {
                return response()->json([
                    'status_code' => 500,
                    'message' => 'non authoriser'
                ]);
            }

            $user = User::where('email', $request->email)->first();

            $tokenResult = $user->createToken('authToken')->plainTextToken;

            return response()->json(['data' => [
                'status_code' => 200,
                'access_token' => $tokenResult,
                'token_type' => 'Bearer',
            ]]);

        } catch (Exception $error) {
            return response()->json([
                'status_code' => 500,
                'message' => 'Error in Login',
                'error' => $error,
            ]);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response()->json(null,204);
    }
}
