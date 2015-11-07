<?php namespace spec\DiscoveryDN\VidoraApiClient;

use DiscoveryDN\VidoraApiClient\Requests\Behavioral\BehavioralRequest;
use DiscoveryDN\VidoraApiClient\Requests\Personalization\ItemSimilarsRequest;
use DiscoveryDN\VidoraApiClient\Client;

use Carbon\Carbon;
use Dotenv\Dotenv;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ClientSpec extends ObjectBehavior
{
    function let()
    {
        $apiKey = 'VidoraTest.7baffc459cd6047b7a059f697681c04e';
        $apiSecret = '08F9113D69E5E913705147D7C882202621B00C79BECF57B434';
        $this->beConstructedWith($apiKey, $apiSecret);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DiscoveryDN\VidoraApiClient\Client');
    }

    function it_can_fetch_data_from_vidora()
    {
        /*
         * Get API details from .env file
         * Keys are VIDORA_KEY and VIDORA_SECRET
         */
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();

        $client = new Client(getenv('VIDORA_KEY'), getenv('VIDORA_SECRET'));

        $params = [
            'category' => getenv('VIDORA_GET_TEST_CATEGORY'),
            'limit'    => 12
        ];
        $request = new ItemSimilarsRequest($client, getenv('VIDORA_TEST_USER_ID'), getenv('VIDORA_TEST_ITEM_ID'), $params);

        $this->get($request)->shouldStartWith('{"items":');
    }

    function it_throws_an_exception_if_the_method_is_wrong()
    {
        /*
         * Get API details from .env file
         * Keys are VIDORA_KEY and VIDORA_SECRET
         */
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();

        $client = new Client(getenv('VIDORA_KEY'), getenv('VIDORA_SECRET'));

        $params = [
            'category' => getenv('VIDORA_GET_TEST_CATEGORY'),
            'limit'    => 12
        ];
        $request = new ItemSimilarsRequest($client, getenv('VIDORA_TEST_USER_ID'), getenv('VIDORA_TEST_ITEM_ID'), $params);

        $this->shouldThrow('\Exception')->duringPost($request);
    }

    function it_throws_an_exception_body_is_missing()
    {
        /*
         * Get API details from .env file
         * Keys are VIDORA_KEY and VIDORA_SECRET
         */
        $dotenv = new Dotenv(__DIR__ . '/../');
        $dotenv->load();

        $client = new Client(getenv('VIDORA_KEY'), getenv('VIDORA_SECRET'));

        $params = [
            'category' => getenv('VIDORA_GET_TEST_CATEGORY'),
            'limit'    => 12
        ];
        $request = new BehavioralRequest($client, getenv('VIDORA_TEST_USER_ID'));

        $this->shouldThrow('\Exception')->duringPost($request);
    }
}
