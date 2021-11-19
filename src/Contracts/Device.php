<?php

namespace Darkjinnee\Wicket\Contracts;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Interface Device
 * @package Darkjinnee\Wicket\Contracts
 */
interface Device
{
    /**
     * @param string $userAgent
     * @return Collection
     */
    public static function findByUserAgent(string $userAgent): Collection;

    /**
     * @param string $ipAddress
     * @return Collection
     */
    public static function findByIpAddress(string $ipAddress): Collection;

    /**
     * @param int $id
     * @return Model
     */
    public static function findById(int $id): Model;

    /**
     * @param int $id
     * @return Model
     */
    public static function findByTokenId(int $id): Model;

    /**
     * @return BelongsTo
     */
    public function token(): BelongsTo;

    /**
     * @return MorphTo
     */
    public function user(): MorphTo;

    /**
     * @return void
     */
    public function agentUpdate(): void;
}
