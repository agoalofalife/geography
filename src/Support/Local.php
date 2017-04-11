<?php
namespace agoalofalife\Support;


use agoalofalife\Contracts\ConfigContract;
use agoalofalife\Contracts\LocalizationContract;
use Mockery\Exception;

class Local implements LocalizationContract
{
    private $config;

    protected $mapLocal = [
        'ru' => 0,
        'ua' => 1,
        'be' => 2,
        'en' => 3,
        'es' => 4,
        'fi' => 5,
        'de' => 6,
        'it' => 7
    ];

    public function __construct(ConfigContract $config)
    {
        $this->config = $config;
    }

    public function setLocal($local)
    {
        if ( isset($this->mapLocal[$local]) )
        {
            $this->config->set('geography.locale=' . $this->mapLocal[$local]);
        } else{
            throw new Exception('not locale');
        }

    }
}