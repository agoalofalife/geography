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

    public function settings( array $settings ) : void
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
    }

    /**
     * Just check is exist connection with database
     */
    public function checkConnection() : void
    {
        try{
            is_a($this->capsule->getConnection()->getPdo(), \PDO::class );
        } catch (\Exception $exception)
        {
           dd($exception->getMessage());
        }
    }
}