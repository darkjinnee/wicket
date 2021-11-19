<?php

namespace Darkjinnee\Wicket\Traits;

use Darkjinnee\Wicket\Models\Ability;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Trait HasAbility
 * @package Darkjinnee\Wicket\Traits
 */
trait HasAbility
{
    /**
     * @param array $abilityIds
     */
    public function attachAbilities(array $abilityIds = [])
    {
        $this->abilities()->attach($abilityIds);
    }

    /**
     * @return MorphToMany
     */
    public function abilities(): MorphToMany
    {
        return $this->morphToMany(Ability::class, 'model', 'models_has_abilities');
    }

    /**
     * @param array $abilityIds
     * @return int
     */
    public function detachAbilities(array $abilityIds = []): int
    {
        return $this->abilities()->detach($abilityIds);
    }

    /**
     * @param array $abilityIds
     * @return array
     */
    public function syncAbilities(array $abilityIds = []): array
    {
        return $this->abilities()->sync($abilityIds);
    }
}
