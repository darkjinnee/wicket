<?php

namespace Darkjinnee\Wicket\Models;

use Darkjinnee\Wicket\Contracts\PersonalAccessToken as PersonalAccessTokenContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\PersonalAccessToken as SanctumPersonalAccessToken;

/**
 * Class PersonalAccessToken
 * @package Darkjinnee\Wicket\Models
 */
class PersonalAccessToken extends SanctumPersonalAccessToken implements PersonalAccessTokenContract
{
    use HasFactory;

    /**
     * @return HasOne
     */
    public function device(): HasOne
    {
        return $this->hasOne(Device::class, 'token_id');
    }
}
