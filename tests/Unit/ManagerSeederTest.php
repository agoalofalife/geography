<?php
namespace Tests\Unit;

use agoalofalife\database\seeds\CitiesTableSeeder;
use agoalofalife\database\seeds\CountryTableSeeder;
use agoalofalife\database\seeds\RegionsTableSeeder;
use agoalofalife\ManagerSeeder;
use Tests\TestCase;

class ManagerSeederTest extends TestCase
{
    public function testRun()
    {
        $country  = $this->mock(CountryTableSeeder::class);
        $regions  = $this->mock(RegionsTableSeeder::class);
        $cities   = $this->mock(CitiesTableSeeder::class);

        $country->shouldReceive('run')->once();
        $regions->shouldReceive('run')->once();
        $cities->shouldReceive('run')->once();

        (new ManagerSeeder([ $country, $regions, $cities ]))->run();
    }
}