<?php namespace DiscoveryDN\VidoraApiClient\Requests\Personalization;

use DiscoveryDN\VidoraApiClient\Requests\Request;
use DiscoveryDN\VidoraApiClient\Client;

use Carbon\Carbon;

class UIGroupRankingsRequest extends Request
{
    public function __construct(Client $client, $userId, $groupId, Array $params = [])
    {
        $this->setClient($client);
        $this->setPath('/v1/users/' . $userId . '/groups/' . $groupId . '/items');
        $this->setMethod('GET');

        // Add a default params
        $this->addParams([
            'api_key' => $client->getApiKey(),
            'expires' => (new Carbon(null, 'UTC'))->addHours(1)->format('Y-m-d\TH:i'),
        ]);

        // Params added here will override the defaults
        $this->addParams($params);
    }
}