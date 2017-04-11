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
        $response  = [];
        $offset    = 0;
        $arrCities = [];
        Capsule::table('regions')->get()->each(function ($item) use ($client, &$response, $offset, &$arrCities){

//            $body          = $client->get($url)->getBody();
//            $responseArray = json_decode($body, true);
//            file_get_contents($methodUrl, false, $streamContext);
            do {
                $url           = 'http://api.vk.com/method/database.getCities?v=5.5&country_id='
                                  . $item->country_id .'&region_id='
                                  . $item->id . '&need_all=1&count=1000&offset='
                                  . $offset;

                $body          = $client->get($url)->getBody();
                $responseArray = json_decode($body, true);
                $response      = array_merge( $response,$responseArray['response']['items'] );
                $offset        += 1000;

            } while( ( count($responseArray['response']['items'])  > 0) );

                foreach ($response as &$iterator)
                {
                    $arrCities[] = [
                        'id'         => $iterator['id'],
                        'title'      => $iterator['title'],
                        'area'       => isset($iterator['area']) ? $iterator['area'] : '',
                        'region_id'  => $item->id
                    ];
                }


            Capsule::table('cities')->insert($arrCities);
            $arrCities = [];
            $response  = [];
        });

//        var_dump($arrCities);

    }
}