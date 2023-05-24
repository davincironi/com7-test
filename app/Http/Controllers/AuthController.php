<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\JsonResponse;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;

class Authcontroller extends Controller
{
    public function login()
    {
        $credentials = request()->only(['email', 'password']);
        if (!auth()->validate($credentials)) {
            abort(401);
        } else {
            $user = User::where('email', $credentials['email'])->first();
            $user->tokens()->delete();
            $token = $user->createToken('postman', ['admin']);
            return response()->json(['token' => $token->plainTextToken]);
        }
    }

    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }
        try {
            $userSocial = Socialite::driver($provider)->stateless()->user();
        } catch (ClientException $exception) {
            return response()->json(['error' => 'Invalid credentials provided.'], 422);
        }

        $user = User::firstOrCreate(
            [
                'email' => $userSocial->getEmail()
            ],
            [
                'email_verified_at' => now(),
                'name' => $userSocial->getName(),
                'provider' => $provider,
                'provider_id' => $userSocial->getId(),
                'status' => true,
            ]
        );
        $token = $user->createToken('token-name')->plainTextToken;
        return response()->json(['token' => $token]);
        // return response()->json($user, 200, ['Access-Token' => $token]);
    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return response()->json(['error' => 'Please login using facebook or google'], 422);
        }
    }

}
