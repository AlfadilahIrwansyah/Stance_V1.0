<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use League\OAuth2\Client\Provider\Google;

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
}
