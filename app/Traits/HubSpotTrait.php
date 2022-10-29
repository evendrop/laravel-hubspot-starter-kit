<?php 

namespace App\Traits;

use App\Models\Team;
use App\Models\Portal;
use GuzzleHttp\Client;

trait HubSpotTrait {

    public function refreshAccessToken() {

        $team = Team::whereId(session('alias'))->firstOrFail();
        $portal = Portal::whereTeamId($team->id)->whereId(session('portal')['id'])->firstOrFail();
        
        $query = [
            'grant_type'    => 'refresh_token',
            'client_id'     => env('HS_CLIENT_ID'),
            'client_secret' => env('HS_CLIENT_SECRET'),
            'refresh_token' => $portal->refresh_token
        ];

        $client = new Client();

        try{
            $token_response = $client->request('POST', 'https://api.hubapi.com/oauth/v1/token', [
                'query'   => $query,
                'headers' => ['Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8']
            ]);
            $token_response = json_decode($token_response->getBody(), true);
        } catch (\Exception $e) {
            \Log::info($e->getMessage());
            die;
        }

        $portal->token_expires = \Carbon\Carbon::now()->addSecond($token_response['expires_in']);
        $portal->access_token = $token_response['access_token'];

        $portal->save();

        return $token_response['access_token'];
    }

}