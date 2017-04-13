<?php

namespace agoalofalife;

class ManagerSeeder
{
    protected $seeders;

    public function __construct(array $seeders)
    {
        $this->seeders = $seeders;
    }

    public function run()
    {
        foreach ($this->seeders as $seeder)
        {
            (new $seeder)->run();
        }
    }
}