<?php

namespace Darkjinnee\Wicket\Traits;

use Darkjinnee\Wicket\Models\AbilityGroup;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Trait HasAbilityGroup
 * @package Darkjinnee\Wicket\Traits
 */
trait HasAbilityGroup
{
    /**
     * @param array $abilityGroupIds
     */
    public function attachAbilityGroups(array $abilityGroupIds = [])
    {
        $this->abilityGroups()->attach($abilityGroupIds);
    }

    /**
     * @return MorphToMany
     */
    public function abilityGroups(): MorphToMany
    {
        return $this->morphToMany(AbilityGroup::class, 'model', 'models_has_ability_groups');
    }

    /**
     * @param array $abilityGroupIds
     * @return int
     */
    public function detachAbilityGroups(array $abilityGroupIds = []): int
    {
        return $this->abilityGroups()->detach($abilityGroupIds);
    }

    /**
     * @param array $abilityGroupIds
     * @return array
     */
    public function syncAbilityGroups(array $abilityGroupIds = []): array
    {
        return $this->abilityGroups()->sync($abilityGroupIds);
    }
}
