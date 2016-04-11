<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Database model for folders.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    December 2015
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\Folder
 *
 * @property integer $id
 * @property integer $profile_id
 * @property string $name
 * @property string $system_name
 * @property string $path
 * @property integer $parent_id
 * @property-read \App\Models\Folder $parent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Folder[] $children
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movement[] $movements
 * @property-read \App\Models\Profile $profile
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Folder whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Folder whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Folder whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Folder whereSystemName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Folder wherePath($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Folder whereParentId($value)
 * @mixin \Eloquent
 */
class Folder extends Model
{
    use CamelCaseAttrs;

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * Attributes that CAN be appended to the model's array form.
     */
    public static $appendable = [];

    /**
     * Attributes that SHOULD be appended to the model's array form.
     */
    protected $appends = [];

    /**
     * Attributes which are mass-assignable.
     */
	protected $fillable = [
        'profile_id',
        'parent_id',
        'name',
        'system_name',
        'path',
    ];

    /**
     * Parent folder.
     */
	public function parent()
    {
		return $this->belongsTo('App\Models\Folder', 'parent_id');
	}

    /**
     * Child folders.
     */
	public function children()
    {
		return $this->hasMany('App\Models\Folder', 'parent_id');
	}

    /**
     * Movements in this folder.
     */
    public function movements()
    {
        return $this->hasMany('App\Models\Movement');
    }

    /**
     * Profile this movement belongs to.
     */
	public function profile()
	{
		return $this->belongsTo('App\Models\Profile');
	}
}
