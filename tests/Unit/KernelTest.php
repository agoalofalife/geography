<?php
namespace Tests\Unit;


use agoalofalife\Kernel;
use Illuminate\Config\Repository;
use Tests\TestCase;

class KernelTest extends TestCase
{
    public function testStart()
    {
        (new Kernel())->start();
        $this->assertInstanceOf(Repository::class, app('config'));
        $this->assertInternalType('array',  config('geography'));
    }
}