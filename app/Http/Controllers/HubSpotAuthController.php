<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Auth;

class HubSpotAuthController extends Controller
{

	use \App\Traits\HubSpotTrait;

	public function authTrigger()
	{
		$scopes = ['crm.lists.read'];
		$query = [
			'client_id'     => env('HS_CLIENT_ID'),
			'redirect_uri'  => env('APP_URL') . '/submitauth',
			'scope'         => implode(" ", $scopes),
		];

		$url = env('HS_AUTH_URL') . "?" . http_build_query($query);
		return redirect()->to($url);
	}

	public function authResponse(Request $request)
	{
		if (!$request->input('code')) {
			// TODO: do something with the failure
			return response("FAILED - HSA", 401);
		}

		$client = new Client(['base_uri'  => 'https://api.hubapi.com/oauth/v1/']);
		$token_query  = [
			'grant_type'    => 'authorization_code',
			'client_id'     => env('HS_CLIENT_ID'),
			'client_secret' => env('HS_CLIENT_SECRET'),
			'redirect_uri'  => env('APP_URL') . '/submitauth',
			'code'          => $request->input('code'),
		];

		try {
			$token_response = $client->request('POST', 'token', [
				'query'   => $token_query,
				'headers' => ['Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8']
			]);
		} catch (\Exception $e) {
			\Log::info($e->getMessage());
			die;
		}

		$token_response = json_decode($token_response->getBody(), true);
		$token_meta_response = $client->request('GET', 'access-tokens/' . $token_response['access_token']);
		$token_meta_response = json_decode($token_meta_response->getBody(), true);

		$portal = new \App\Models\Portal();

		$portal->user_id = Auth::user()->id;
		$portal->team_id = session('alias');
		$portal->hub__id = $token_meta_response['hub_id'];
		$portal->hub__user_email = $token_meta_response['user'];
		$portal->hub__domain = $token_meta_response['hub_domain'];
		$portal->token_expires = \Carbon\Carbon::now()->addSecond($token_response['expires_in']);
		$portal->refresh_token = $token_response['refresh_token'];
		$portal->access_token = $token_response['access_token'];

		$portal->save();

		session()->put('portal', $portal);

		return redirect()->to('/hs/lists');
	}

	public function tables()
	{
		// TODO: Implement token refresh if expired. Currently refreshes on every call
		$token = $this->refreshAccessToken();

		$client = new Client();

		$response = $client->request('GET', 'https://api.hubapi.com/hubdb/api/v2/tables', [
			'query'   => NULL,
			'headers' => [
				'Authorization' => 'Bearer ' . $token,
				'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8'
			]
		]);
		$response = json_decode($response->getBody(), true);

		return response()->json($response);
	}

	public function lists()
	{

		$token = $this->refreshAccessToken();

		$client = new Client();

		$response = $client->request('GET', 'https://api.hubapi.com/contacts/v1/lists', [
			'query'   => NULL,
			'headers' => [
				'Authorization' => 'Bearer ' . $token,
				'Content-Type' => 'application/x-www-form-urlencoded;charset=utf-8'
			]
		]);
		$response = json_decode($response->getBody(), true);

		return response()->json($response);

	}
}
