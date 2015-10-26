<?php namespace spec\DiscoveryDN\VidoraApiClient;

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
            'category' => getenv('VIDORA_FETCH_TEST_CATEGORY'),
            'limit'    => 12
        ];
        $request = new ItemSimilarsRequest($client, getenv('VIDORA_TEST_USER_ID'), getenv('VIDORA_TEST_ITEM_ID'), $params);

        $this->fetch($request)->shouldStartWith('{"items":');
    }
}
