<?php
/**
 * Copyright Heddoko(TM) 2016, all rights reserved.
 *
 * @brief   Database model for movement frames.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    February 2016
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\MovementFrame
 *
 * @property integer $id
 * @property integer $movement_id
 * @property string $format_revision
 * @property string $timestamp
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementFrame whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementFrame whereMovementId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementFrame whereFormatRevision($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementFrame whereTimestamp($value)
 * @mixin \Eloquent
 */
class MovementFrame extends Model
{
    use CamelCaseAttrs;

    /**
     * Attributes that CAN be appended to the model's array form.
     */
    public static $appendable = [];

    /**
     * Attributes that SHOULD be appended to the model's array form.
     */
    protected $appends = [];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
	protected $fillable = [
        'movement_id',
        'format_revision',
        'timestamp',
    ];

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'frames';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
