<?php namespace Discoverydn\VidoraApiClient\Requests\Behavioral;

use DiscoveryDN\VidoraApiClient\Requests\Request;
use DiscoveryDN\VidoraApiClient\Client;
use DiscoveryDN\VidoraApiClient\Events\Event;

use Carbon\Carbon;

class BehavioralRequest extends Request
{
    const method = 'POST';
    const types = [
        'play',
        'playhead_update',
        'share',
        'like',
        'purchase',
        'click',
        'shown',
        'sent',
    ];

    public $events = [];

    public function __construct(Client $client, $userId, $itemId, $type, Array $params = [])
    {
        $this->setClient($client);
        $this->setPath('/v1/validate');

        if (! in_array($type, self::types)) {
            throw new \Exception('Invalid type selected. It must be one of: ' . implode(', ', self::types));
        }

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

        return $this;
    }
}