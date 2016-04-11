<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Database model for screenings.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    November 2015
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\Screening
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $title
 * @property boolean $score
 * @property boolean $score_min
 * @property boolean $score_max
 * @property string $notes
 * @property string $meta
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Profile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movement[] $movements
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereScore($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereScoreMin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereScoreMax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereNotes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereMeta($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Screening whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Screening extends Model
{
    use CamelCaseAttrs;

    /**
     * Attributes that CAN be appended to the model's array form.
     *
     * @var array
     */
    public static $appendable = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'title' => 'string',
        'score' => 'integer',
        'scoreMin' => 'integer',
        'scoreMax' => 'integer',
        'notes' => 'string',
        'meta' => 'array',
    ];

    /**
     * Attributes which are mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
        'profile_id',
        'title',
        'score',
        'scoreMin',
        'scoreMax',
        'notes',
        'meta',
    ];

    /**
     * Profile to which this movement set belongs to.
     */
    public function profile() {
        return $this->belongsTo('App\Models\Profile');
    }

    /**
     * Movements that are a part of this set.
     */
    public function movements() {
        return $this->hasMany('App\Models\Movement');
    }
}
