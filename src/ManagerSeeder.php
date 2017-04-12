<?php

namespace agoalofalife;


use agoalofalife\database\seeds\CitiesTableSeeder;
use agoalofalife\database\seeds\CountryTableSeeder;
use agoalofalife\database\seeds\RegionsTableSeeder;

class ManagerSeeder
{
    protected $seeders = [
        CountryTableSeeder::class,
        RegionsTableSeeder::class,
        CitiesTableSeeder::class
    ];

    public function run()
    {
        foreach ($this->seeders as $seeder)
        {
            (new $seeder)->run();
        }
    }
}