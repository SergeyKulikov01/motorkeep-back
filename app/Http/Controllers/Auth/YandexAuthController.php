<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class YandexAuthController extends Controller
{
    /**
     * Exchange a Yandex OAuth access token (obtained client-side via the
     * implicit flow) for the user's profile, then log them in.
     */
    public function callback(Request $request): JsonResponse
    {
        $request->validate([
            'access_token' => 'required|string',
        ]);

        $response = Http::withToken($request->input('access_token'), 'OAuth')->get('https://login.yandex.ru/info', ['format' => 'json']);

        if ($response->failed()) {
            Log::error('Yandex Auth', ['text' => 'Не удалось подтвердить вход через Яндекс']);
            return response()->json([
                'message' => 'Не удалось подтвердить вход через Яндекс.',
            ], 401);
        }

        $profile = $response->json();

        if (($profile['client_id'] ?? null) !== config('services.yandex.client_id')) {
            Log::error('Yandex Auth', ['text' => 'Токен выдан для другого приложения']);
            return response()->json([
                'message' => 'Токен выдан для другого приложения.',
            ], 401);
        }

        $user = User::where('yandex_id', $profile['id'])->first();

        if (! $user) {
            $user = User::where('email', $profile['default_email'])->first();
        }

        if (! $user) {
            $user = User::create([
                'name' => $profile['first_name'] ?? $profile['login'],
                'last_name' => $profile['last_name'] ?? '',
                'email' => $profile['default_email'],
                'yandex_id' => $profile['id'],
                'password' => null,
                'email_verified_at' => now(),
            ]);
        } elseif (! $user->yandex_id) {
            $user->forceFill(['yandex_id' => $profile['id']])->save();
        }

        Auth::login($user);

        $request->session()->regenerate();

        return response()->json([
            'redirect' => route('dashboard'),
        ]);
    }
}
