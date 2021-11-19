<?php

namespace Darkjinnee\Wicket\Contracts;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Interface AbilityGroup
 * @package Darkjinnee\Wicket\Contracts
 */
interface AbilityGroup
{
    /**
     * @param string $name
     * @return Model
     */
    public static function findByName(string $name): Model;

    /**
     * @param int $id
     * @return Model
     */
    public static function findById(int $id): Model;

    /**
     * @return MorphToMany
     */
    public function abilities(): MorphToMany;

    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany;
}
