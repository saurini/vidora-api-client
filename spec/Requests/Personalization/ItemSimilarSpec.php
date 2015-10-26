<?php namespace spec\DiscoveryDN\VidoraApiClient\Requests\Personalization;

use DiscoveryDN\VidoraApiClient\Requests\Personalization\ItemSimilarsRequest;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

use DiscoveryDN\VidoraApiClient\Client;
use Carbon\Carbon;

class ItemSimilarsRequestSpec extends ObjectBehavior
{
    function let()
    {
        $client = new Client('VidoraTest.7baffc459cd6047b7a059f697681c04e', '08F9113D69E5E913705147D7C882202621B00C79BECF57B434');
        $params = [
            'api_key'  => "VidoraTest.7baffc459cd6047b7a059f697681c04e",
            'expires'  => (new Carbon('2016-01-01T00:00'))->format('Y-m-d\TH:i'),
            'category' => "comedy",
            'limit'    => "10"
        ];

        $this->beConstructedWith($client, 123, 68913, $params);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('DiscoveryDN\VidoraApiClient\Requests\Personalization\ItemSimilarsRequest');
    }

    function it_can_add_params()
    {
        $testArray = [
            'api_key'  => "VidoraTest.7baffc459cd6047b7a059f697681c04e",
            'expires'  => (new Carbon('2016-01-01T00:00'))->format('Y-m-d\TH:i'),
            'category' => "comedy",
            'limit'    => "10"
        ];
        $this->addParams($testArray);

        foreach ($testArray as $k => $v) {
            $this->getParams()->shouldHaveKeyWithValue($k, $v);
        }
    }

    function it_can_add_a_client()
    {
        $client = new Client('VidoraTest.7baffc459cd6047b7a059f697681c04e', '08F9113D69E5E913705147D7C882202621B00C79BECF57B434');
        $this->getClientSecret()->shouldReturn('08F9113D69E5E913705147D7C882202621B00C79BECF57B434');
    }

    function it_can_set_its_path()
    {
        $this->setPath('/foo/bar');
        $this->getPath()->shouldReturn('/foo/bar');
    }

    function it_can_sort_params_properly()
    {
        $valid = 'api_key=VidoraTest.7baffc459cd6047b7a059f697681c04e&category=comedy&expires=2016-01-01T00:00&limit=10';

        $this->getSortedParamsAsQueryString()->shouldEqual($valid);
    }

    function it_can_generate_a_correct_signature()
    {
        $validSignature = 'qs4q30Fiop2u7hb9dATz9OG34VRTNMQA%2BOV7SP2eBQA';

        $this->setPath('/v1/users/123/recommendations');
        $this->addParams([
            'api_key'  => "VidoraTest.7baffc459cd6047b7a059f697681c04e",
            'expires'  => (new Carbon('2016-01-01T00:00'))->format('Y-m-d\TH:i'),
            'category' => "comedy",
            'limit'    => "10"
        ]);

        $this->generateSignature()->shouldEqual($validSignature);
    }

    function it_can_sort_the_params_as_a_query_string()
    {
        $testArray = [
            'limit'    => "10",
            'api_key'  => "VidoraTest.7baffc459cd6047b7a059f697681c04e",
            'category' => "comedy",
            'expires'  => (new Carbon('2016-01-01T00:00'))->format('Y-m-d\TH:i'),
        ];
        $this->addParams($testArray);
        $this->getSortedParamsAsQueryString()->shouldReturn('api_key=VidoraTest.7baffc459cd6047b7a059f697681c04e&category=comedy&expires=2016-01-01T00:00&limit=10');
    }

    function it_can_get_a_signed_url()
    {
        $this->getSignedUrl()->shouldStartWith('https://api.vidora.com/v1/users/123/items/68913/similars?api_key=VidoraTest.7baffc459cd6047b7a059f697681c04e&category=comedy&expires=2016-01-01T00:00&limit=10&signature=');
    }

    public static function createRecommendation()
    {
        $client = new Client('VidoraTest.7baffc459cd6047b7a059f697681c04e', '08F9113D69E5E913705147D7C882202621B00C79BECF57B434');

        return new Self($client);
    }
}
