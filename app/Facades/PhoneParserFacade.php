<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PhoneParserFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'phoneparser';
    }
}
