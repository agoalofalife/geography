<?php
namespace agoalofalife\database\seeds;


use GuzzleHttp\Client;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
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
        Capsule::table('country')->get()->each(function ($item) use ($client, &$response){
            $body          = $client->get('http://api.vk.com/method/database.getRegions?v=5.5&count=1000&country_id=' . $item->id)->getBody();
            $responseArray = json_decode($body, true);
            foreach ($responseArray['response']['items'] as &$iterator)
            {
                $response[] = [
                    'id'         => $iterator['id'],
                    'title'      => $iterator['title'],
                    'country_id' => $item->id
                ];
            }
        });

        Capsule::table('regions')->insert($response);
    }
}