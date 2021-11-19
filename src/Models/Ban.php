<?php

namespace Darkjinnee\Wicket\Models;

use Darkjinnee\Wicket\Contracts\Ban as BanContract;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Ban
 * @package Darkjinnee\Wicket\Models
 * @method static where(string $string, string $operator, string $untilTo)
 * @method static find(int $id)
 */
class Ban extends Model implements BanContract
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'bans';

    /**
     * @var string[]
     */
    protected $fillable = [
        'cause',
        'until_to'
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'until_to',
    ];

    /**
     * @param string $operator
     * @param string $untilTo
     * @return Collection
     */
    public static function findByUntilTo(string $operator, string $untilTo): Collection
    {
        return static::where('until_to', $operator, $untilTo)->get();
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
     * @return MorphTo
     */
    public function user(): MorphTo
    {
        return $this->morphTo('model');
    }
}
