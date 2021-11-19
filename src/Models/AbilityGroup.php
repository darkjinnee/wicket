<?php

namespace Darkjinnee\Wicket\Models;

use Darkjinnee\Wicket\Contracts\AbilityGroup as AbilityGroupContract;
use Darkjinnee\Wicket\Traits\HasAbility;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class AbilityGroup
 * @package Darkjinnee\Wicket\Models
 * @method static where(string $string, string $name)
 * @method static find(int $id)
 */
class AbilityGroup extends Model implements AbilityGroupContract
{
    use HasAbility, HasFactory;

    /**
     * @var string
     */
    protected $table = 'ability_groups';

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * @param string $name
     * @return Model
     */
    public static function findByName(string $name): Model
    {
        return static::where('name', $name)->first();
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
    public function users(): MorphToMany
    {
        $userModel = config('wicket.classes.user_model');
        return $this->morphedByMany($userModel, 'model', 'models_has_ability_groups');
    }
}
