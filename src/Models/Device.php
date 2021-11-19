<?php

namespace Darkjinnee\Wicket\Models;

use Darkjinnee\Wicket\Contracts\Device as DeviceContract;
use Darkjinnee\Wicket\Wicket;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Device
 * @package Darkjinnee\Wicket\Models
 * @method static where(string $string, string $userAgent)
 * @method static find(int $id)
 */
class Device extends Model implements DeviceContract
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'devices';

    /**
     * @var string[]
     */
    protected $fillable = [
        'token_id',
        'user_agent',
        'ip_address',
        'last_at'
    ];

    /**
     * @param string $userAgent
     * @return Collection
     */
    public static function findByUserAgent(string $userAgent): Collection
    {
        return static::where('user_agent', $userAgent)->get();
    }

    /**
     * @param string $ipAddress
     * @return Collection
     */
    public static function findByIpAddress(string $ipAddress): Collection
    {
        return static::where('ip_address', $ipAddress)->get();
    }

    /**
     * @param int $id
     * @return Model
     */
    public static function findById(int $id): Model
    {
        return static::find($id);
    }

    /**
     * @param int $id
     * @return Model
     */
    public static function findByTokenId(int $id): Model
    {
        return static::where('token_id', $id)->first();
    }

    /**
     * @return BelongsTo
     */
    public function token(): BelongsTo
    {
        return $this->belongsTo(PersonalAccessToken::class);
    }

    /**
     * @return MorphTo
     */
    public function user(): MorphTo
    {
        return $this->morphTo('model');
    }

    /**
     * @return void
     */
    public function agentUpdate(): void
    {
        $this->update(Wicket::agent());
    }
}
