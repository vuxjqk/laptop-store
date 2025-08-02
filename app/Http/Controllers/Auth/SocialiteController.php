<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        $socialUser = Socialite::driver($provider)->user();

        $path = null;
        if ($socialUser->getAvatar()) {
            $response = Http::get($socialUser->getAvatar());

            if ($response->successful()) {
                $extension = pathinfo($socialUser->getAvatar(), PATHINFO_EXTENSION);
                $filename = 'avatar_' . $socialUser->getId() . '_' . time() . '.' . ($extension ?: 'jpg');

                Storage::disk('public')->put('avatars/' . $filename, $response->body());
                $path = 'avatars/' . $filename;
            }
        }

        $user = User::updateOrCreate(
            [
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
            ],
            [
                'name' => $socialUser->getName(),
                'avatar' => $path,
                'email_verified_at' => now(),
            ]
        );

        Auth::login($user);
        return redirect()->route('dashboard');
    }
}
