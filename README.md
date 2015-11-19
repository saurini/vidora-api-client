# Vidora API Client

Vidora is an AI-driven recommendaiton service that allows you to surface content via their API. The intention of this library is to make getting data from Vidora as simple as possible.

## Installation

#### Git

git clone git@github.com:discoverydn/vidora-api-client.git

#### Composer

composer require discoverydn/vidora-api-client dev-master && composer dumpautoload

## Usage

There are two main components: the client and the request. The client uses the request to fetch data from the API. The Vidora API has two main types of requests: Behavioral, which POSTs data and Personalization which GETs data.

example:

    $vidoraClient = new \Discoverydn\VidoraApiClient\Client('api-key', 'api-secret');
    
    $request = new \Discoverydn\VidoraApiClient\Requests\Personalization\UserRecommendationsRequest($vidoraClient, 'user-id', ['param1' => 'value1', 'param2' => 'value2']);

    $data = $vidoraClient->fetch($request); // {"items": [ {...

#### Testing

In order to fully test the code, you'll need to add a .env file with the following:

    VIDORA_KEY=<your-api-key>
    VIDORA_SECRET=<your-api-secret>
    VIDORA_TEST_FETCH_CATEGORY=<your-test-category>
    VIDORA_TEST_USER_ID=<your-test-user-id>
    VIDORA_TEST_ITEM_ID=<your-test-item-id>