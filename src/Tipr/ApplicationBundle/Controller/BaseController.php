<?php

namespace Tipr\ApplicationBundle\Controller;

use Httpful\Request as Api;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GuzzleHttp\Client;

class BaseController extends Controller
{
    private $api_base_url = 'https://apisandbox.ingdirect.es';
    private $api_key = 'IEjdcD3VfCF63pRDE4DrviMi9zA30GI8';

    public function api_get($resource, $cookie)
    {
        $url = $this->api_base_url . $resource . '?apikey=' . $this->api_key;
        $client = new Client();
        $response = $client->get($url, [
            'headers' => ['Cookie' => $cookie]
        ]);

        return json_decode($response->getBody(), true);
    }

}
