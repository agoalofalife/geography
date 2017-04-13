<?php
namespace Tests\Unit;

use agoalofalife\CapsuleSettings;
use \Illuminate\Database\Capsule\Manager as Capsule;
use Tests\TestCase;

class CapsuleSettingsTest extends TestCase
{
    protected $capsule;

    public function setUp()
    {
        $this->capsule    =  $this->mock(Capsule::class);
    }

    public function testSettings()
    {
        $this->capsule->shouldReceive('addConnection')->once();
        $this->capsule->shouldReceive('setAsGlobal')->once();
        $this->capsule->shouldReceive('bootEloquent')->once();

        $settings = new CapsuleSettings($this->capsule);
        $settings->settings([
            'databaseType'      => '',
            'host'              => '',
            'databaseName'      => '',
            'databaseUsername'  => '',
            'databasePassword'  => ''
        ]);
    }
}