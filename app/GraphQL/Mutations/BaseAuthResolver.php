<?php

namespace App\GraphQL\Mutations;

use Illuminate\Http\Request;
use Laravel\Passport\Client;
use Nuwave\Lighthouse\Exceptions\AuthenticationException;

class BaseAuthResolver
{
    /**
     * @param array $args
     * @param string $grantType
     * @return mixed
     */
    public function buildCredentials(array $args, $grantType, $scope = '*')
    {
        $credentials = collect($args)->get('input');
        $client = $this->getPassportClient($credentials['client_name']);
        $credentials['grant_type'] = $grantType;
        $credentials['client_id'] = $client->id;
        $credentials['client_secret'] = $client->secret;
        $credentials['scope'] = $scope;

        return $credentials;
    }


    private function getPassportClient($clientName)
    {
        return Client::whereName($clientName)->first();
    }


    public function makeRequest(array $credentials)
    {
        $request = Request::create('oauth/token', 'POST', $credentials, [], [], [
            'HTTP_Accept' => 'application/json'
        ]);
        $response = app()->handle($request);
        $decodedResponse = json_decode($response->getContent(), true);
        if ($response->getStatusCode() != 200) {
            throw new AuthenticationException($decodedResponse['message']);
        }
        return $decodedResponse;
    }
}
