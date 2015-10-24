# Vidora API Client

Vidora is an AI-driven recommendaiton service that allows you to surface content via their API. The intention of this library is to make getting data from Vidora as simple as possible.

## Installation

#### Git

git clone git@github.com:discoverydn/vidora-api-client.git

#### Composer

composer require discoverydn/vidora-api-client dev-master && composer dumpautoload

## Usage

There are two main components: the client and the request. The client uses the request to fetch data from the API.

example:

    $vidoraClient = new \Discoverydn\Vidora\Client('api-key', 'api-secret');
    
    $request = new \Discoverydn\Vidora\Requests\UserRecommendation($vidoraClient, 'user-id', ['param1' => 'value1', 'param2' => 'value2']);

    $data = $vidoraClient->fetch($request); // {"items": [ {...

## Todos

* Add the rest of the requests
* Add error handling


