<?php
namespace agoalofalife\Migrations;

use agoalofalife\Contracts\Checker;
use agoalofalife\Contracts\ContractMigration;
use \Illuminate\Database\Capsule\Manager as Capsule;

class CountryMigration implements ContractMigration, Checker
{
    public function execute()
    {
        Capsule::schema()->create('country', function ($table) {
            $table->increments('id');
            $table->increments('code')->comments('unique value');
            $table->string('name', 100);
            $table->text('description');
            $table->timestamps();
        });
    }

    public function check()
    {

    }
}