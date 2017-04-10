<?php

namespace agoalofalife\Contracts;


interface Checker
{
    public function check(callable $callback);
}