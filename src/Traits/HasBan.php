<?php

namespace Darkjinnee\Wicket\Traits;

use Darkjinnee\Wicket\Models\Ban;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait HasBan
 * @package Darkjinnee\Wicket\Traits
 */
trait HasBan
{
    /**
     * @param array $ban
     * @return Model
     */
    public function createBan(array $ban = []): Model
    {
        return $this->bans()->create($ban);
    }

    /**
     * @return MorphMany
     */
    public function bans(): MorphMany
    {
        return $this->morphMany(Ban::class, 'model');
    }

    /**
     * @return bool
     */
    public function isBanned(): bool
    {
        return !$this->currentBans()->isEmpty();
    }

    /**
     * @return Collection
     */
    public function currentBans(): Collection
    {
        return $this->bans()
            ->where('until_to', '>', Carbon::now())
            ->get();
    }
}
