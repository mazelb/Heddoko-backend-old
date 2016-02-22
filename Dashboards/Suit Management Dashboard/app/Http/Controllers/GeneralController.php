<?php
/**
 * Copyright Heddoko(TM) 2016, all rights reserved.
 *
 * @brief   Handles genereal requests
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    February 2016
 */
namespace App\Http\Controllers;

use Log;
use Session;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\ClientException;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    /**
     *
     */
    public function getDashboard() {

        // If we don't have an access token, we can take care of that right away.
        if (!Session::has('access-token')) {
            return $this->authenticate();
        }

        return view('dashboard', [
            'version' => '0.3',
            'accessToken' => Session::get('access-token'),
            'refreshToken' => Session::get('refresh-token'),
        ]);
    }

    /**
     *
     */
    public function authenticate()
    {
        return redirect(config('services.heddoko.endpoint') . '/oauth2/authorize?client_id=' .
                config('services.heddoko.id') . '&response_type=code&redirect_uri=' .
                htmlentities(route('oauth.token')));
    }

    /**
     *
     */
    public function getAccessToken(Request $request)
    {
        // Exchange authorization code with an access token.
        if ($request->has('code'))
        {
            try
            {
                $client = new Client();
                $response = $client->post(config('services.heddoko.endpoint') . '/oauth2/token', [
                    'json' => [
                        'client_id' => config('services.heddoko.id'),
                        'client_secret' => config('services.heddoko.secret'),
                        'grant_type' => 'authorization_code',
                        'code' => $request->get('code'),
                        'redirect_uri' => route('oauth.token')
                    ]
                ]);
            }

            catch (ClientException $e) {
                if ($response = json_decode($e->getResponse()->getBody()->getContents())) {
                    Log::error($response->error_description);
                }

                abort(500, 'An Error Occurred.');
            }

            // Retrieve tokens.
            try
            {
                $data = json_decode($response->getBody()->getContents());
                Session::put('access-token', $data->access_token);
                Session::put('refresh-token', $data->refresh_token);
            }

            catch (\Exception $e) {
                Log::error('Could not extract tokens from response: ' . $e->getMessage());
                abort(500, 'An Error Occurred.');
            }
        }

        else {
            abort(400, 'An Error Occurred.');
        }

        return redirect(route('dashboard'));
    }
}
