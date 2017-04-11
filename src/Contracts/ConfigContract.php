<?php
namespace agoalofalife\Contracts;


interface ConfigContract
{
    public function get($value);
    public function set($value);

}