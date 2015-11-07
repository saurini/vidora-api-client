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
}
