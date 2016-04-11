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
 * App\Models\MovementMarker
 *
 * @property integer $id
 * @property integer $movement_id
 * @property integer $start_frame
 * @property integer $end_frame
 * @property string $comment
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMarker whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMarker whereMovementId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMarker whereStartFrame($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMarker whereEndFrame($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MovementMarker whereComment($value)
 * @mixin \Eloquent
 */
class MovementMarker extends Model
{
    use CamelCaseAttrs;

    //
}
