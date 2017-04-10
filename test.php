<?php
require_once './vendor/autoload.php';

use agoalofalife\CapsuleSettings;
use agoalofalife\database\seeds\CountryTableSeeder;
use agoalofalife\database\seeds\RegionsTableSeeder;
use agoalofalife\Migrations\CountryMigration;
use agoalofalife\Migrations\RegionsMigration;
use GuzzleHttp\Client;
use Illuminate\Database\Capsule\Manager;


$settings = [
    'databaseType'       => 'mysql',
    'host'               => 'localhost',
    'databaseName'       => 'ls3',
    'databaseUsername'   => 'root',
    'databasePassword'   => 'y2uDk7L3IP'
];
(new CapsuleSettings(new Manager()))->settings( $settings );
//(new CountryMigration())->check(function($self){
//    $self->execute();
//});
//
//(new CountryTableSeeder())->run(new Client());


//(new RegionsMigration())->check(function($self){
//    $self->execute();
//});
//(new RegionsTableSeeder())->run(new Client());