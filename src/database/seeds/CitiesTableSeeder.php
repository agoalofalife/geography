<?php

namespace agoalofalife\database\seeds;
use \Illuminate\Database\Capsule\Manager as Capsule;
use GuzzleHttp\Client;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @param Client $client
     * @return void
     */
    public function run(Client $client)
    {
        $response = [];
        Capsule::table('regions')->get()->each(function ($item) use ($client, &$response){
            $url           = 'http://api.vk.com/method/database.getCities?v=5.5&country_id='
                              . $item->country_id .'&region_id='
                              . $item->id . '&need_all1=1';

            $body          = $client->get($url)->getBody();
            $responseArray = json_decode($body, true);
            foreach ($responseArray['response']['items'] as &$iterator)
            {
                $response[] = [
                    'id'         => $iterator['id'],
                    'title'      => $iterator['title'],
                    'area'       => isset($iterator['area']) ? $iterator['area'] : '',
                    'region_id'  => $item->id
                ];

            }
        });

        Capsule::table('cities')->insert($response);
    }
}