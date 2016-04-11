<?php
/**
 * Copyright Heddoko(TM) 2016, all rights reserved.
 *
 * @brief   Database model for movement frames.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    February 2016
 */
namespace App\Models;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MovementEvent
 *
 * @property integer $id
 * @property integer $movement_id
 * @property integer $start_frame
 * @property integer $end_frame
 * @property string $type
 * @property string $data
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementEvent whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementEvent whereMovementId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementEvent whereStartFrame($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementEvent whereEndFrame($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementEvent whereType($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementEvent whereData($value)
 * @mixin \Eloquent
 */
class MovementEvent extends Model
{
    use CamelCaseAttrs;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;
}
