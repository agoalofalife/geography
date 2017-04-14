<?php


namespace agoalofalife\database\migrations;
use agoalofalife\Contracts\Checker;
use agoalofalife\Contracts\ContractMigration;
use \Illuminate\Database\Capsule\Manager as Capsule;

class CitiesMigration implements ContractMigration, Checker
{
    public function execute()
    {
        Capsule::schema()->create('cities', function ($table) {
            $table->increments('id');
            $table->integer('region_id')->unsigned()->index()->nullable();
            $table->foreign('region_id')->references('id')->on('regions')->onDelete('cascade');
            $table->string('title', 100);
            $table->string('area', 100);
            $table->text('description')->nullable();
            $table->string('code')->nullable()->comments('unique value');
            $table->timestamps();
        });
    }

    public function check(callable $callback)
    {
        if ( Capsule::schema()->hasTable('cities') === false )
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
        Capsule::schema()->dropIfExists('cities');
    }
}