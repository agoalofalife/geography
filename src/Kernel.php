<?php
namespace agoalofalife;

use Illuminate\Config\Repository;

class Kernel
{
    public function setConfig()
    {
        $configFile = require 'config.php';
        $config     = new Repository();

        $config->set('geography', $configFile);

        app()->instance('config',  $config);
    }

    public function start()
    {
        $this->setConfig();

    }
}