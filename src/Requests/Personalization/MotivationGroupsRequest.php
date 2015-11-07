<?php namespace Discoverydn\VidoraApiClient\Requests\Personalization;

use DiscoveryDN\VidoraApiClient\Requests\Request;
use DiscoveryDN\VidoraApiClient\Client;

use Carbon\Carbon;

class MotivationGroup extends Request
{
    public function __construct(Client $client, $userId)
    {
        $this->setClient($client);
        $this->setPath('/v1/users/' . $userId . '/motivation_groups');

        // Add a default params
        $this->addParams([
            'api_key' => $client->getApiKey(),
            'expires' => (new Carbon(null, 'UTC'))->addHours(1)->format('Y-m-d\TH:i'),
        ]);
    }
}