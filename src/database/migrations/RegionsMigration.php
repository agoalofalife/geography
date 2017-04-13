<?php
namespace agoalofalife\database\migrations;
use agoalofalife\Contracts\Checker;
use agoalofalife\Contracts\ContractMigration;
use \Illuminate\Database\Capsule\Manager as Capsule;

class RegionsMigration implements ContractMigration, Checker
{
    public function execute()
    {
        Capsule::schema()->create('regions', function ($table) {
            $table->increments('id');
            $table->integer('country_id')->unsigned()->index();
            $table->foreign('country_id')->references('id')->on('country')->onDelete('cascade');
            $table->string('title', 100);
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    public function check(callable $callback)
    {
        if ( Capsule::schema()->hasTable('regions') === false )
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
        Capsule::schema()->dropIfExists('regions');
    }
}