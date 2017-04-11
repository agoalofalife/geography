<?php

namespace agoalofalife\Support;

use agoalofalife\Contracts\ConfigContract;

class Config implements ConfigContract
{
    protected $container;

    public function __construct()
    {
        foreach (require __DIR__ . '/../config.php' as $key => $item)
        {
            putenv($key . '=' . $item);
        }

    }

    public function get($key)
    {
       return  getenv($key);
    }

    public function set($value)
    {
        return putenv($value);
    }
}