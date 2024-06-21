<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Google;
use Illuminate\Support\Facades\Log;
class GoogleController extends Controller
{
    function refreshToken()
    {
        $provider = new Google([
            'clientId' => env('GOOGLE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_CLIENT_SECRET'),
            'redirectUri' => env('GOOGLE_REDIRECT_URI'),
        ]);

        $refreshToken = session('refreshToken'); // or fetch from database

        $newToken = $provider->getAccessToken('refresh_token', [
            'refresh_token' => $refreshToken,
        ]);

        // Update session or database with new token details
        session(['accessToken' => $newToken->getToken()]);
        session(['refreshToken' => $newToken->getRefreshToken()]);
        session(['tokenExpires' => $newToken->getExpires()]);

        // Optionally, update the .env file if you must (not recommended for production)
        file_put_contents(app()->environmentFilePath(), str_replace(
            'GOOGLE_ACCESS_TOKEN=' . env('GOOGLE_ACCESS_TOKEN'),
            'GOOGLE_ACCESS_TOKEN=' . $newToken->getToken(),
            file_get_contents(app()->environmentFilePath())
        )
        );

        return $newToken;
    }

    public function redirectToGoogle()
    {
        $provider = new Google([
            'clientId' => env('GOOGLE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_CLIENT_SECRET'),
            'redirectUri' => env('GOOGLE_REDIRECT_URI'),
        ]);

        $authorizationUrl = $provider->getAuthorizationUrl();
        session(['oauth2state' => $provider->getState()]);

        return redirect()->away($authorizationUrl);
    }

    public function handleGoogleCallback(Request $request)
    {
        if (!$request->input('state') || $request->input('state') !== session('oauth2state')) {
            session()->forget('oauth2state');
            return redirect()->route('auth.google');
        }

        $provider = new Google([
            'clientId' => env('GOOGLE_CLIENT_ID'),
            'clientSecret' => env('GOOGLE_CLIENT_SECRET'),
            'redirectUri' => env('GOOGLE_REDIRECT_URI'),
        ]);

        $token = $provider->getAccessToken('authorization_code', [
            'code' => $request->input('code')
        ]);

        // Store the token details in the session or database
        session(['accessToken' => $token->getToken()]);
        session(['refreshToken' => $token->getRefreshToken()]);
        session(['tokenExpires' => $token->getExpires()]);

        // Optionally, update the .env file (not recommended for production)
        file_put_contents(app()->environmentFilePath(), str_replace(
            'GOOGLE_ACCESS_TOKEN=' . env('GOOGLE_ACCESS_TOKEN'),
            'GOOGLE_ACCESS_TOKEN=' . $token->getToken(),
            file_get_contents(app()->environmentFilePath())
        )
        );

        return redirect()->route('home'); // Redirect to home or any other route
    }
    Log::info('')
}
