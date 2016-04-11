<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles http requests for movement data.
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\TaggableTrait as Taggable;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\Movement
 *
 * @property integer $id
 * @property integer $complex_equipment_id
 * @property integer $profile_id
 * @property integer $submitted_by
 * @property integer $screening_id
 * @property integer $folder_id
 * @property string $title
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MovementEvent[] $events
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MovementFrame[] $frames
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\MovementMarker[] $markers
 * @property-read \App\Models\MovementMeta $meta
 * @property-read \App\Models\Profile $profile
 * @property-read \App\Models\Screening $screening
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $taggables
 * @property-read mixed $tags
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movement whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movement whereComplexEquipmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movement whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movement whereSubmittedBy($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movement whereScreeningId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movement whereFolderId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movement whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movement whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Movement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Movement extends Model
{
    use CamelCaseAttrs, Taggable;

    /**
     * Attributes which are mass-assignable.
     */
	protected $fillable = [
        'profile_id',
        'submitted_by',
        'screening_id',
        'folder_id',
        'title',
    ];

    /**
     * Attributes which should be hidden from the models' array form.
     */
    protected $hidden = ['taggables'];

    /**
     * Attributes that CAN be appended to the model's array form.
     */
    public static $appendable = ['tags'];

    /**
     * Attributes that SHOULD be appended to the model's array form.
     */
    protected $appends = [];

    /**
     * Events belonging to this movement.
     */
	public function events()
    {
		return $this->hasMany('App\Models\MovementEvent');
	}

    /**
     * Frames which make up this movement.
     */
	public function frames()
    {
		return $this->hasMany('App\Models\MovementFrame');
	}

    /**
     * Movement markers belonging to this movement.
     */
	public function markers()
    {
		return $this->hasMany('App\Models\MovementMarker');
	}

    /**
     * Extra details about this movement.
     */
	public function meta()
	{
		return $this->hasOne('App\Models\MovementMeta');
	}

    /**
     * Profile this movement belongs to.
     */
	public function profile()
	{
		return $this->belongsTo('App\Models\Profile');
	}

    /**
     * Screening this movement belongs to.
     */
	public function screening()
	{
		return $this->belongsTo('App\Models\Screening');
	}
}
