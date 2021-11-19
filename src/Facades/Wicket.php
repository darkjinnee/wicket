<?php

namespace Darkjinnee\Wicket\Facades;

use Illuminate\Support\Facades\Facade;

class Wicket extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'wicket';
    }
}
