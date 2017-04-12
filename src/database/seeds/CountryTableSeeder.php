<?php
namespace agoalofalife\database\seeds;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Seeder;


class CountryTableSeeder extends Seeder
{
    /**
     * Auto generated seed file.
     *
     * @return void
     */
    public function run()
    {
          $body      = file_get_contents('http://api.vk.com/method/database.getCountries?v=5.5&need_all=1&count=1000&lang='. config('geography.locale') . '&code=' .  config('geography.country'));
          $response  = json_decode($body, true);

          Capsule::table( config('geography.nameTable.country') )->insert( $response['response']['items'] );
    }
}
