<?php

namespace agoalofalife\Services;


use GuzzleHttp\Client;

class CityCollector
{
    protected $city;

    public function __construct( Client $client )
    {
        $this->client = $client;
    }

    public function query($idCountry)
    {
        $body = $this->client->get('http://api.vk.com/method/database.getRegions?v=5.5&need_all=1&offset=0&count=1000&country_id=' . $idCountry)->getBody();
        $this->country = json_decode($body, true);
    }

    public function getData()
    {
        return $this->city;
    }
}