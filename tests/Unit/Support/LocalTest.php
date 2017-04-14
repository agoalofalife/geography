<?php
namespace Tests\Support;


use agoalofalife\Kernel;
use agoalofalife\Support\Local;
use Tests\TestCase;

class LocalTest extends TestCase
{
    protected $map =  [
        'ru' => 0,
        'ua' => 1,
        'be' => 2,
        'en' => 3,
        'es' => 4,
        'fi' => 5,
        'de' => 6,
        'it' => 7
    ];

    public function testSetLocal()
    {
        (new Kernel())->start();

        $random = array_rand($this->map);
        ( new Local())->setLocal( $random );
        $this->assertEquals(config('geography.locale'), $this->map[$random]);
    }

}