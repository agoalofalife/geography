<?php

namespace agoalofalife;

use agoalofalife\Migrations\CitiesMigration;
use agoalofalife\Migrations\CountryMigration;
use agoalofalife\Migrations\RegionsMigration;


class ManagerMigrations
{
    protected $migrations = [
        CountryMigration::class,
        RegionsMigration::class,
        CitiesMigration::class
    ];

    public function builder()
    {
        foreach ($this->migrations as $migration)
        {
           $current =  new $migration();

           $current->check(function ($object){
               $object->execute();
           });
        }
    }

    public function destroyer()
    {
        foreach ($this->migrations as $migration)
        {
            $current =  new $migration();
            $current->down();
        }
    }
}