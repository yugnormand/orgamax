<?php

namespace Todocoding\Orgamax\Facades;

use Illuminate\Support\Facades\Facade;

class Orgamax extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'orgamax';
    }
}
