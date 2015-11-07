<?php namespace spec\DiscoveryDN\VidoraApiClient\Requests\Behavioral;

use DiscoveryDn\VidoraApiClient\Client;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class BehavioralRequestSpec extends ObjectBehavior
{
    function let()
    {
        $apiKey = 'VidoraTest.7baffc459cd6047b7a059f697681c04e';
        $apiSecret = '08F9113D69E5E913705147D7C882202621B00C79BECF57B434';
        $this->beConstructedWith(new Client($apiKey, $apiSecret), 12345, 678910, 'click');
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DiscoveryDN\VidoraApiClient\Requests\Behavioral\BehavioralRequest');
    }
}
