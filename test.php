<?php

require_once './vendor/autoload.php';

(new \agoalofalife\Services\CountryCollector(new \GuzzleHttp\Client()))->query();