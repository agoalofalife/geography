<?php
namespace agoalofalife\Services;

use agoalofalife\Contracts\ContractDataCollector;
use GuzzleHttp\Client;

class CountryCollector implements ContractDataCollector
{
    protected $country;

    public function __construct( Client $client )
    {
        $this->client = $client;
    }

    public function query()
    {
        $body = $this->client->get('http://api.vk.com/method/database.getCountries?v=5.5&need_all=1')->getBody();
        $this->country = json_decode($body, true);
    }

    public function getData()
    {
        return $this->country;
    }
}