<?php

namespace spec\DiscoveryDN\VidoraApiClient\Events;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class EventSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('DiscoveryDN\VidoraApiClient\Events\Event');
    }

    function it_can_be_printed()
    {
        $this->addData(['user_id' => 12345, 'content_id' => 23456, 'type' => 'click']);

        $this->toString()->shouldReturn('{"user_id":12345,"content_id":23456,"type":"click"}');
    }
}
