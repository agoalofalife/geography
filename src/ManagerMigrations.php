<?php

namespace agoalofalife;

class ManagerMigrations
{
    protected $migrations;

    public function __construct(array $migrations)
    {
        $this->migrations = $migrations;
    }
    public function builder() : void
    {
        foreach ($this->migrations as $migration)
        {
            $migration->check(function ($object){
               $object->execute();
           });
        }
    }
}