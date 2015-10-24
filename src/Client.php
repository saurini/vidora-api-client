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

    public function fetch(Request $request)
    {
        $result = $this->httpClient->request($request->getMethod(), $request->getSignedUrl());
        return $result->getBody() . ''; // cast to a string
    }
}