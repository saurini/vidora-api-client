<?php namespace spec\DiscoveryDN\VidoraApiClient\Requests\Behavioral;

use DiscoveryDn\VidoraApiClient\Client;
use DiscoveryDn\VidoraApiClient\Events\Event;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BehavioralRequestSpec extends ObjectBehavior
{
    function let()
    {
        $apiKey = 'VidoraTest.7baffc459cd6047b7a059f697681c04e';
        $apiSecret = '08F9113D69E5E913705147D7C882202621B00C79BECF57B434';
        $this->beConstructedWith(new Client($apiKey, $apiSecret), 12345);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DiscoveryDN\VidoraApiClient\Requests\Behavioral\BehavioralRequest');
    }

    function it_can_add_one_event()
    {
        $event = new Event(['user_id' => 12345, 'content_id' => 23456, 'type' => 'click']);

        $this->addEvent($event)->shouldReturn($this);
        $this->events->shouldHaveCount(1);
    }

    function it_can_add_many_events()
    {
        $event1 = new Event(['user_id' => 12345, 'content_id' => 23456, 'type' => 'click']);
        $event2 = new Event(['user_id' => 13244, 'content_id' => 24523, 'type' => 'click']);
        $event3 = new Event(['user_id' => 62422, 'content_id' => 24524, 'type' => 'click']);
        $event4 = new Event(['user_id' => 24524, 'content_id' => 23433, 'type' => 'click']);

        $this->addEvent($event1)->addEvent($event2)->addEvent($event3)->addEvent($event4)->shouldReturn($this);
        $this->events->shouldHaveCount(4);
    }


}
