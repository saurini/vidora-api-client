<?php namespace DiscoveryDN\VidoraApiClient\Requests;

use DiscoveryDN\VidoraApiClient\Client;

abstract class Request
{
    const API_BASE = 'api.vidora.com';

    private $client;
    private $method;
    private $path;
    private $body = '';
    private $params = [];

    public function addParams(Array $params)
    {
        $this->params = array_merge($this->params, $params);

        ksort($this->params);
    }

    public function addData(Array $data)
    {
        // Todo: do things
    }

    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    public function setPath($path)
    {
        $path = '/' . trim($path, '/');
        $this->path = $path;
    }

    public function setMethod($method)
    {
        $this->method = strtoupper($method);
    }

    public function setBody($body)
    {
        $this->body = $body;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getBody()
    {
        if (empty($this->body)) {
            return '';
        }

        return $this->body;
    }

    public function getClientSecret()
    {
        return $this->client->getApiSecret();
    }

    public function generateSignature()
    {
        $arrayToSign = [
            $this->getClientSecret(),
            $this->getMethod(),
            $this->getPath(),
            $this->getSortedParamsAsQueryString(),
            $this->getBody(),
        ];

        // Convert array to a string
        $stringToSign = implode("\n", $arrayToSign);

        // Sign the string and return it
        return urlencode(
            rtrim(
                substr(
                    base64_encode(
                        hash('sha256', $stringToSign, true)
                    ), 0, 43
                ), "="
            )
        );
    }

    public function getSortedParamsAsQueryString($includeQ = false)
    {
        ksort($this->params);

        $queryArray = [];
        foreach ($this->params as $k => $v) {
            $queryArray[] = "{$k}={$v}";
        }

        $q = $includeQ ? '?' : '';

        return $q . implode('&', $queryArray);
    }

    public function getUrl($https = true)
    {
        $scheme = $https ? 'https' : 'http';
        $queryString = '';
        if (! empty($this->params)) {
            $queryString = $this->getSortedParamsAsQueryString(true);
        }

        return $scheme . '://' . self::API_BASE . $this->path . $queryString;
    }

    public function getSignedUrl($https= true)
    {
        return $this->getUrl($https) . '&signature=' . $this->generateSignature();
    }
}