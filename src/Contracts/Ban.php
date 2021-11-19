<?php

namespace Darkjinnee\Wicket\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Interface Ban
 * @package Darkjinnee\Wicket\Contracts
 */
interface Ban
{
    /**
     * @param string $operator
     * @param string $untilTo
     * @return Collection
     */
    public static function findByUntilTo(string $operator, string $untilTo): Collection;

    /**
     * @param int $id
     * @return Model
     */
    public static function findById(int $id): Model;

    /**
     * @return MorphTo
     */
    public function user(): MorphTo;
}
