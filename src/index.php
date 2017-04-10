<?php

require "../../vendor/autoload.php";

use \Illuminate\Database\Capsule\Manager as Capsule;

$settings = getSettings();
$capsule  = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => '',
    'username'  => '',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => ''
]);

$capsule->setAsGlobal();
$capsule->bootEloquent();

Capsule::schema()->create('categories', function ($table) {
    $table->increments('id');
    $table->string('name', 100);
    $table->text('description');
    $table->timestamps();
});

Capsule::schema()->create('goods', function ($table) {
    $table->bigIncrements('id');
    $table->bigInteger('good_id');
    $table->string('name', 100);
    $table->integer('amount');
    $table->decimal('price', 5, 2);
    $table->json('options');
    $table->integer('cat_id')->unsigned();
    $table->foreign('cat_id')->references('id')->on('categories')->onDelete('CASCADE');
    $table->timestamps();
});