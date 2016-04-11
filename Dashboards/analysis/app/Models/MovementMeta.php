<?php
/**
 * Copyright Heddoko(TM) 2016, all rights reserved.
 *
 * @author  Francis Amankrah (frank@heddoko.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\MovementMeta
 *
 * @property integer $id
 * @property integer $movement_id
 * @property integer $start_frame
 * @property integer $end_frame
 * @property boolean $score
 * @property boolean $score_min
 * @property boolean $score_max
 * @property string $notes
 * @property string $data
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMeta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMeta whereMovementId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMeta whereStartFrame($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMeta whereEndFrame($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMeta whereScore($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMeta whereScoreMin($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMeta whereScoreMax($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMeta whereNotes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMeta whereData($value)
 * @mixin \Eloquent
 */
class MovementMeta extends Model
{
    use CamelCaseAttrs;

    /**
     * Table name.
     */
    protected $table = 'movement_meta';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * Attributes which are mass-assignable.
     */
	protected $fillable = [
        'movement_id',
        'start_keyframe',
        'end_keyframe',
        'score',
        'score_max',
        'notes',
        'virtual_path',
        'filename',
        'params',
    ];

    /**
     * Attributes that should be cast when assigned.
     */
    protected $casts = [
        'score' => 'integer',
        'score_max' => 'integer',
        'params' => 'array',
    ];
}
