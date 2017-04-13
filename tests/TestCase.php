<?php
namespace Tests;

use Mockery;

abstract class TestCase extends \PHPUnit\Framework\TestCase
{
    protected $container;
    protected function setUp()
    {
        parent::setUp();
    }
    protected function tearDown()
    {
        parent::tearDown();
        Mockery::close();
    }

    /**
     * @param string $class
     *
     * @return \Mockery\Mock|mixed
     */
    protected function mock($class)
    {
        return Mockery::mock($class);
    }
}