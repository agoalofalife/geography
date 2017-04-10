<?php
namespace agoalofalife\Migrations;
use \Illuminate\Database\Capsule\Manager as Capsule;

class RegionsMigration
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
}