<?php
namespace agoalofalife;

use Illuminate\Config\Repository;

class Kernel
{
    protected $bootstrapping = [
        'config' => Repository::class,
    ];

    private function bootstrapping() : void
    {
        foreach ($this->bootstrapping as $abstract => $concrete)
        {
            app()->instance($abstract, new $concrete());
        }
    }

    private function setConfig() : void
    {
        $configFile = require 'config.php';
        app('config')->set('geography', $configFile);
    }

    public function start() : void
    {
        $this->bootstrapping();
        $this->setConfig();
    }
}