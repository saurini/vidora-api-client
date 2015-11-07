<?php namespace DiscoveryDN\VidoraApiClient\Events;

class Event {

    const required = [
        'user_id',
        'content_id',
        'type'
    ];

    private $data = [];

    public function __construct(Array $data = [])
    {
        $this->addData($data);
    }

    public function addData(Array $data)
    {
        $this->data = array_merge($this->data, $data);

        return $this;
    }

    public function __toString()
    {
        if (count(array_intersect(self::required, ($this->data))) != count(self::required)) {
            return '';
        }

        return json_encode($this->data, JSON_FORCE_OBJECT);
    }
}