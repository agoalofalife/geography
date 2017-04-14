<?php
namespace agoalofalife\Support;

use agoalofalife\Contracts\LocalizationContract;
use Mockery\Exception;

class Local implements LocalizationContract
{
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

    public function setLocal(string $local)
    {
        if ( isset($this->mapLocal[$local]) )
        {
            config(['geography.locale' => $this->mapLocal[$local]]);
        } else{
            throw new Exception('not locale');
        }

    }
}