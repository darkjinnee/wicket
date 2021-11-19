<?php

namespace Darkjinnee\Wicket\Models;

use Darkjinnee\Wicket\Contracts\Ability as AbilityContract;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Ability
 * @package Darkjinnee\Wicket\Models
 * @method static where(string $string, string $mask)
 * @method static find(int $id)
 */
class Ability extends Model implements AbilityContract
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'abilities';

    /**
     * @var string[]
     */
    protected $fillable = [
        'mask'
    ];

    /**
     * @param string $mask
     * @return Model
     */
    public static function findByMask(string $mask): Model
    {
        return static::where('mask', $mask)->first();
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
     * @return MorphToMany
     */
    public function abilityGroups(): MorphToMany
    {
        return $this->morphedByMany(AbilityGroup::class, 'model', 'models_has_abilities');
    }

    /**
     * @return MorphToMany
     */
    public function users(): MorphToMany
    {
        $userModel = config('wicket.classes.user_model');
        return $this->morphedByMany($userModel, 'model', 'models_has_abilities');
    }
}
