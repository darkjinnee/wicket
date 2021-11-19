<?php

namespace Darkjinnee\Wicket;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Request;

/**
 * Class Wicket
 * @package Darkjinnee\Wicket
 */
class Wicket
{
    /**
     * @return array
     */
    static function agent(): array
    {
        return [
            'user_agent' => Request::userAgent() ?: null,
            'ip_address' => Request::ip(),
            'last_at' => Carbon::now()
        ];
    }
}
