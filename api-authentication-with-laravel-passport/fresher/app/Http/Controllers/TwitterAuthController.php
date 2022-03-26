<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as Guzzle;
use Illuminate\Http\Request;

class TwitterAuthController extends Controller
{
    protected $client;

    public function __construct(Guzzle $client)
    {
        $this->client = $client;
    }

    public function redirect()
    {
        $query = http_build_query([
            'client_id' => '3',
            'redirect_uri' => 'http://fresher.app:8000/auth/twitter/callback',
            'response_type' => 'code',
            'scope' => 'view-tweets post-tweets',
        ]);

        return redirect('http://fresh.app:8000/oauth/authorize?' . $query);
    }

    public function callback(Request $request)
    {
        $response = $this->client->post('http://fresh.app/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'client_id' => '3',
                'client_secret' => 'FBbFFOfDWLxbPDwQ7PFGY0KBQ13iHHkBHTUjgncg',
                'redirect_uri' => 'http://fresher.app:8000/auth/twitter/callback',
                'code' => $request->code,
            ],
        ]);

        $response = json_decode($response->getBody());

        $request->user()->token()->delete();

        $request->user()->token()->create([
            'access_token' => $response->access_token,
            'refresh_token' => $response->refresh_token,
            'expires_in' => $response->expires_in,
        ]);

        return redirect('/home');
    }

    public function refresh(Request $request)
    {
        $response = $this->client->post('http://fresh.app/oauth/token', [
            'form_params' => [
                'grant_type' => 'refresh_token',
                'refresh_token' => $request->user()->token->refresh_token,
                'client_id' => '3',
                'client_secret' => 'FBbFFOfDWLxbPDwQ7PFGY0KBQ13iHHkBHTUjgncg',
                'scope' => 'view-tweets post-tweets',
            ],
        ]);

        $response = json_decode($response->getBody());

        $request->user()->token()->update([
            'access_token' => $response->access_token,
            'expires_in' => $response->expires_in,
            'refresh_token' => $response->refresh_token,
        ]);

        return redirect()->back();
    }
}
