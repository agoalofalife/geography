<?php
namespace agoalofalife\database\migrations;

use agoalofalife\Contracts\Checker;
use agoalofalife\Contracts\ContractMigration;
use \Illuminate\Database\Capsule\Manager as Capsule;

class CountryMigration implements ContractMigration, Checker
{
    public function execute()
    {
        Capsule::schema()->create('country', function ($table) {
            $table->increments('id');
            $table->string('title', 100);
            $table->string('code')->nullable()->comments('unique value');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function check(callable $callback)
    {
        if ( Capsule::schema()->hasTable('country') === false )
        {
            call_user_func($callback, $this);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Capsule::schema()->dropIfExists('country');
    }
}