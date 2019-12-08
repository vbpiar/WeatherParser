<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ParseService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'parser';
    }
}