<?php
namespace agoalofalife\database\seeds;

use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Seeder;

class RegionsTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
        $response = [];

        Capsule::table( config('geography.nameTable.country') )->get()->each(function ($item) use ( &$response )
        {
            $body = file_get_contents('https://api.vk.com/method/database.getRegions?v=5.5&count=1000&country_id=' . $item->id .
                '&access_token=' . config('geography.access_token'));
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

        Capsule::table(config('geography.nameTable.regions'))->insert($response);
    }
}
