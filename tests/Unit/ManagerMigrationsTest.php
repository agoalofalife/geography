<?php
namespace Tests\Unit;

use agoalofalife\database\migrations\CitiesMigration;
use agoalofalife\database\migrations\CountryMigration;
use agoalofalife\database\migrations\RegionsMigration;
use agoalofalife\ManagerMigrations;
use Tests\TestCase;

class ManagerMigrationsTest extends TestCase
{
    public function testBuilder()
    {
        $country = $this->mock(CountryMigration::class);
        $country->shouldReceive('check')->once();


        $regions = $this->mock(RegionsMigration::class);
        $regions->shouldReceive('check')->once();

        $cities = $this->mock(CitiesMigration::class);
        $cities->shouldReceive('check')->once();
        (new ManagerMigrations([$country, $regions, $cities]))->builder();
    }
}