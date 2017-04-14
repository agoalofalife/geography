<?php
namespace Tests\Commands;


use agoalofalife\Commands\MigrateLaravelCommand;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutput;

use Tests\TestCase;


class MigrateLaravelCommandTest extends TestCase
{
    protected $app;
    protected $command;
    public function setUp()
    {
        parent::setUp();
        $this->app      = new Application();
        $this->command  = new MigrateLaravelCommand(new OutputFormatterStyle('black', 'yellow', array('bold', 'blink')) , new ProgressBar(new ConsoleOutput(), 7));
    }

    public function testRun()
    {
        $command     =  $this->mock(
            MigrateLaravelCommand::class,
                  [
                      new OutputFormatterStyle('black', 'yellow', array('bold', 'blink')) ,
                      new ProgressBar(new ConsoleOutput(), 7)
                  ]);

        $command->shouldReceive('setApplication')->times(2);
        $command->shouldReceive('isEnabled')->once();
        $this->app->add($command);
    }

    public function testExistNameCommand()
    {
        $this->app->add( $this->command );
        $this->assertTrue($this->app->has('migrate:laravel'));
    }

}