<?php

namespace agoalofalife;

use \Illuminate\Database\Capsule\Manager as Capsule;

class CapsuleSettings
{
    protected $capsule;

    public function __construct( Capsule $capsule )
    {
        $this->capsule = $capsule;
    }

    public function settings( array $settings )
    {
        $this->capsule->addConnection([
            'driver'    => $settings['databaseType'],
            'host'      => $settings['host'],
            'database'  => $settings['databaseName'],
            'username'  => $settings['databaseUsername'],
            'password'  => $settings['databasePassword'],
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => ''
        ]);

        $this->capsule->setAsGlobal();
        $this->capsule->bootEloquent();

    }
}