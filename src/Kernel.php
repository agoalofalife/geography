<?php
namespace agoalofalife;

use Illuminate\Config\Repository;
use Illuminate\Database\Schema\Blueprint;

class Kernel
{
    protected $bootstrapping = [
        'config' => Repository::class
    ];

    private function bootstrapping()
    {
        foreach ($this->bootstrapping as $abstract => $concrete)
        {
            app()->instance($abstract, new $concrete());
        }
    }

    private function setConfig()
    {
        $configFile = require 'config.php';
        app('config')->set('geography', $configFile);

    }

    public function start()
    {
        $this->bootstrapping();
        $this->setConfig();
    }
}