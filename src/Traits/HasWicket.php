<?php

namespace Darkjinnee\Wicket\Traits;

use Illuminate\Support\Collection;

/**
 * Trait HasWicket
 * @package Darkjinnee\Wicket\Traits
 */
trait HasWicket
{
    use HasAbility, HasAbilityGroup, HasDevices, HasBan;

    /**
     * @return string[]
     */
    public function abilityMasks(): array
    {
        $conf = config('wicket');
        $username = $conf['auth_fields']['username'];
        $isDeveloper = in_array($this[$username], $conf['developers']);
        if ($isDeveloper) return ['*'];

        $masksConf = $conf['masks'];
        $masks = $this->masks()->merge($masksConf);

        return $masks->all();
    }

    /**
     * @return Collection
     */
    public function masks(): Collection
    {
        $masks = collect();
        $masks->push($this->abilities->pluck('mask'));
        $this->abilityGroups->each(function ($item) use ($masks) {
            $masks->push($item->abilities->pluck('mask'));
        });

        $masks = $masks->flatten();
        $duplicatesKeys = $masks->duplicates()->keys();

        return $masks->except($duplicatesKeys)->values();
    }
}
