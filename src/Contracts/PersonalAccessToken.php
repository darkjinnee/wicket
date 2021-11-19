<?php

namespace Darkjinnee\Wicket\Contracts;

use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * Interface PersonalAccessToken
 * @package Darkjinnee\Wicket\Contracts
 */
interface PersonalAccessToken
{
    /**
     * @return HasOne
     */
    public function device(): HasOne;
}
