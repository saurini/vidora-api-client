<?php namespace Discoverydn\VidoraApiClient\Requests\Behavioral;

use DiscoveryDN\VidoraApiClient\Requests\Request;
use DiscoveryDN\VidoraApiClient\Client;
use DiscoveryDN\VidoraApiClient\Events\Event;

use Carbon\Carbon;

class BehavioralRequest extends Request
{
    const METHOD = 'POST';

    public $events = [];

    public function __construct(Client $client, $userId, Array $params = [])
    {
        $this->setClient($client);
        $this->setPath('/v1/validate');

        // Add a default params
        $this->addParams([
            'api_key' => $client->getApiKey(),
            'expires' => (new Carbon(null, 'UTC'))->addHours(1)->format('Y-m-d\TH:i'),
        ]);

        // Params added here will override the defaults
        $this->addParams($params);
    }

    public function addEvent(Event $event)
    {
        $this->events[] = $event;
        $this->setBody(json_encode($this->events));
        return $this;
    }
}