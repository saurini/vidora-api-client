<?php namespace DiscoveryDN\VidoraApiClient;

use DiscoveryDN\VidoraApiClient\Requests\Request;

use GuzzleHttp\Client as HttpClient;
use Carbon;

class Client
{
    const API_BASE = 'api.vidora.com';

    private $apiKey;
    private $apiSecret;
    private $httpClient;

    public function __construct($apiKey, $apiSecret)
    {
        $this->apiKey = $apiKey;
        $this->apiSecret = $apiSecret;
        $this->httpClient = new HttpClient();
    }

    public function getApiKey()
    {
        return $this->apiKey;
    }

    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    public function get(Request $request)
    {
        if ($request->getMethod() != 'GET') {
            throw new \Exception('Invalid method for this request. You must use GET.');
        }

        $result = $this->httpClient->request('GET', $request->getSignedUrl());
        return $result->getBody() . ''; // cast to a string
    }

    public function post(Request $request)
    {
        if ($request->getMethod() != 'POST') {
            throw new \Exception('Invalid method for this request. You must use POST.');
        }

        if (empty($request->getBody())) {
           throw new \Exception('Missing body. There is nothing to POST.');
        }

        $result = $this->httpClient->request('POST', $request->getSignedUrl(), [
            'body' => $request->getBody()
        ]);
    }
}