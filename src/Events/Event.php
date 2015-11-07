<?php namespace DiscoveryDN\VidoraApiClient\Events;

class Event {

    const REQUIRED = [
        'user_id',
        'content_id',
        'type'
    ];

    const TYPES = [
        'play',
        'playhead_update',
        'share',
        'like',
        'purchase',
        'click',
        'shown',
        'sent',
    ];

    private $data = [];

    public function __construct(Array $data = [])
    {
        $this->addData($data);
    }

    public function addData(Array $data)
    {
        if (array_key_exists('type', $data) && ! in_array($data['type'], self::TYPES)) {
            throw new \Exception('Type not supported. It must be one of: ' . implode(', ', self::TYPES));
        }

        $this->data = array_merge($this->data, $data);

        return $this;
    }

    public function toString()
    {
        return $this . '';
    }

    public function __toString()
    {
        if (count(array_intersect(self::REQUIRED, array_keys($this->data))) != count(self::REQUIRED)) {
            return '';
        }

        return json_encode($this->data, JSON_FORCE_OBJECT);
    }
}