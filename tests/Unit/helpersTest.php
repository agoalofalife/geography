<?php

namespace Tests\Unit;

use Illuminate\Config\Repository;
use Illuminate\Container\Container;
use Illuminate\Support\Collection;
use Tests\TestCase;

class helpersTest extends TestCase
{
    public function testHelpersApp()
    {
       $this->assertTrue(function_exists('app'));
       $this->assertInstanceOf(Container::class, app());
    }

    public function testHelpersConfig()
    {
        $this->assertTrue(function_exists('config'));
        app()->instance('config', new Repository());
        $this->assertInstanceOf(Repository::class, config());
    }

    public function testHelpersCollect()
    {
        $this->assertTrue(function_exists('collect'));
        $this->assertInstanceOf(Collection::class, collect());
    }
}