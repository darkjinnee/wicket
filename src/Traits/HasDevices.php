<?php

namespace Darkjinnee\Wicket\Traits;

use Darkjinnee\Wicket\Models\Device;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait HasDevices
 * @package Darkjinnee\Wicket\Traits
 */
trait HasDevices
{
    /**
     * @param int $tokenId
     * @param array $agent
     * @return Model
     */
    public function createDevice(int $tokenId, array $agent): Model
    {
        return $this->devices()->create([
            'token_id' => $tokenId,
            'user_agent' => $agent['user_agent'],
            'ip_address' => $agent['ip_address'],
            'last_at' => $agent['last_at']
        ]);
    }

    /**
     * @return MorphMany
     */
    public function devices(): MorphMany
    {
        return $this->morphMany(Device::class, 'model');
    }

    /**
     * @return Model
     */
    public function currentDevice(): Model
    {
        return $this->currentAccessToken()->device;
    }
}
