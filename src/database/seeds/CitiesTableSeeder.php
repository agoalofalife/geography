<?php

namespace agoalofalife\database\seeds;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Seeder;

class CitiesTableSeeder extends Seeder
{
    /**
     * @param $regions
     * @param $what
     * @return null | int
     */
    public function findRegionId($regions, $what)
    {
        return isset($regions[trim($what)]) ? $regions[trim($what)] : null;
    }

    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        Capsule::transaction(function ()  {
            $response  = [];
            $offset    = 0;
            $arrCities = [];
            $regions   =  Capsule::table(config('geography.nameTable.regions'))->get()->pluck('id', 'title')->toArray();
            $country   =  Capsule::table(config('geography.nameTable.country'))->get();

            foreach ($country as $concreteCountry)
            {
                do {
                    $body = file_get_contents('http://api.vk.com/method/database.getCities?v=5.5&country_id=' . $concreteCountry->id . '&need_all=1&count=1000&offset=' . $offset);
                    $responseArray = json_decode($body, true);

                    foreach ($responseArray['response']['items'] as $city)
                    {
                            $arrCities[] = [
                                'id'         => $city['id'],
                                'title'      => $city['title'],
                                'area'       => isset($city['area']) ? $city['area'] : '',
                                'region_id'  => isset($city['region']) ? $this->findRegionId($regions, $city['region']) : null
                            ];
                    }

                    $response      = array_merge($response, $responseArray['response']['items']);
                    $offset += 1000;

                    Capsule::table('cities')->insert($arrCities);
                    $arrCities = [];
                } while( ( count($responseArray['response']['items'])  > 0) );

            }

        });

//        Capsule::table($this->dependentTable)->get()->each(function ($item) use ( &$response, $offset, &$arrCities){
//
//            do {
//                $url           = 'http://api.vk.com/method/database.getCities?v=5.5&country_id='
//                                  . $item->country_id .'&region_id='
//                                  . $item->id . '&need_all=1&count=1000&offset='
//                                  . $offset;
//
//                $body          = file_get_contents($url);
//                $responseArray = json_decode($body, true);
//                $response      = array_merge( $response,$responseArray['response']['items'] );
//                $offset        += 1000;
//
//            } while( ( count($responseArray['response']['items'])  > 0) );
//
//                foreach ($response as &$iterator)
//                {
//                    $arrCities[] = [
//                        'id'         => $iterator['id'],
//                        'title'      => $iterator['title'],
//                        'area'       => isset($iterator['area']) ? $iterator['area'] : '',
//                        'region_id'  => $item->id
//                    ];
//                }
//
//
//            Capsule::table('cities')->insert($arrCities);
//            $arrCities = [];
//            $response  = [];
//        });
    }
}