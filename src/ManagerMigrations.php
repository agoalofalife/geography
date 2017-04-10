<?php

namespace agoalofalife;

use agoalofalife\Migrations\CountryMigration;

class ManagerMigrations
{
    protected $migrations = [
        CountryMigration::class
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

}