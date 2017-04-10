<?php
namespace agoalofalife\database\seeds;
use \Illuminate\Database\Capsule\Manager as Capsule;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;


class CountryTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @param Client $client
     * @return void
     */
    public function run(Client $client)
    {
        $body     = $client->get('http://api.vk.com/method/database.getCountries?v=5.5&need_all=1')->getBody();
        $response = json_decode($body, true);

        Capsule::table('country')->insert($response['response']['items']);
    }
}
