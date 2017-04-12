<?php
require_once './vendor/autoload.php';

use agoalofalife\CapsuleSettings;
use agoalofalife\database\seeds\CitiesTableSeeder;
use agoalofalife\database\seeds\CountryTableSeeder;
use agoalofalife\database\seeds\RegionsTableSeeder;
use agoalofalife\Kernel;
use agoalofalife\Migrations\CitiesMigration;
use agoalofalife\Migrations\CountryMigration;
use agoalofalife\Migrations\RegionsMigration;
use GuzzleHttp\Client;
use Illuminate\Database\Capsule\Manager;


$settings = [
    'databaseType'       => 'mysql',
    'host'               => 'localhost',
    'databaseName'       => 'db',
    'databaseUsername'   => 'root',
    'databasePassword'   => 'y2uDk7L3IP'
];
(new Kernel())->start();



(new CapsuleSettings(new Manager()))->settings( $settings );


//(new CountryMigration())->check(function($self){
//    $self->execute();
//});
//(new CountryTableSeeder())->run(new Client());



//(new RegionsMigration())->check(function($self){
//    $self->execute();
//});
//(new RegionsTableSeeder())->run(new Client());

//(new CitiesMigration())->check(function($self){
//    $self->execute();
//});

(new CitiesTableSeeder())->run(new Client());