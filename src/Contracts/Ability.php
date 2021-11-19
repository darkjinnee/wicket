<?php

namespace Darkjinnee\Wicket\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Interface Ability
 * @package Darkjinnee\Wicket\Contracts
 */
interface Ability
{
    /**
     * @param string $mask
     * @return Model
     */
    public static function findByMask(string $mask): Model;

    /**
     * @param int $id
     * @return Model
     */
    public static function findById(int $id): Model;

    /**
     * @return MorphToMany
     */
    public function abilityGroups(): MorphToMany;

    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany;
}
