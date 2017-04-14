<?php
namespace Tests\Commands;

use agoalofalife\Commands\InstallCommand;
use Symfony\Component\Console\Application;
use Tests\TestCase;

class InstallCommandTest extends TestCase
{
    protected $app;
    protected $command;
    public function setUp()
    {
        parent::setUp();
        $this->app      = new Application();
        $this->command  = new InstallCommand();
    }

    public function testNameCommand()
    {
        $this->app->add( $this->command );
        $this->assertTrue($this->app->has('install'));
    }

}