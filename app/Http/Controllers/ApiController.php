<?php

namespace App\Http\Controllers;

use App\Http\Middleware\Reservation;
use App\Models\User;
use App\Mail\ResetPassword;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     *Création d'un utilisateur.
     */
    public function register(Request $request)
    {
        $validateData = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validateData->fails()) {
            return response()->json(['error' => $validateData->errors()], 400);
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


        $tokenResult = $user->createToken('authapi');
        $token = $tokenResult->accessToken;
 
        return response()->json(['token' => $token, 'message' => 'Utilisateur créé']);
    }
    /**
     * connection.
     */
    public function login(Request $request)
    {
        $data = $request->only('email', 'password');
        if (Auth::attempt($data)) {
            $user = Auth::user();
            $token = $user->createToken('authapi')->accessToken;
            return response()->json(['message' => 'Authorised', 'token' => $token]);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }

    /**
     * Afficher l'ensemble des utilisateurs.
     */
    public function users()
    {
        $users = User::all();

        return response()->json($users);
    }
    /////mot de passe oublier

    public function forgot_password(Request $request)
    {
        try {
            Log::info('Request received for password reset', ['email' => $request->email]);

            $request->validate([
                'email' => 'required|email',
            ]);

            Log::info('Email validation passed', ['email' => $request->email]);

            $user = User::where('email', $request->email)->first();

            if (!$user) {
                Log::warning('Email not found', ['email' => $request->email]);
                return response()->json([
                    'message' => 'Email not found',
                ], 404);
            }

            Log::info('User found', ['email' => $user->email]);

            $token = Str::random(60);
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                ['token' => $token, 'created_at' => now()]
            );

            Log::info('Password reset token generated and saved', ['email' => $user->email, 'token' => $token]);

            Mail::to($user->email)->send(new ResetPassword($token));

            Log::info('Password reset email sent', ['email' => $user->email]);

            return response()->json(['message' => 'Password reset email sent'], 200);
        } catch (\Exception $e) {
            Log::error('An error occurred during password reset', ['error' => $e->getMessage()]);
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    ///reinitialisation du mot de passe
    public function reset_password(Request $request)
    {
        try {
            $request->validate([
                'token' => 'required|string',
                'password' => 'required|string|confirmed|min:8',
            ]);

            $tokenData = DB::table('password_reset_tokens')->where('token', $request->token)->first();

            if (!$tokenData) {
                return response()->json(['message' => 'Invalid token'], 400);
            }

            $user = User::where('email', $tokenData->email)->first();
            if (!$user) {
                return response()->json(['message' => 'User not found'], 404);
            }

            $user->password = bcrypt($request->password);
            $user->save();

            DB::table('password_reset_tokens')->where('email', $user->email)->delete();

            return response()->json(['message' => 'Password reset successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
    ///deconnection
    public function logout(Request $request)
    {
        $user = $request->user();
        if ($user) {
            $user->tokens()->delete();
            return response()->json(['message' => 'User logged out']);
        }
    }
}
