<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Database model for profiles.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    November 2015
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\TaggableTrait as Taggable;
use App\Traits\HasAvatarTrait as HasAvatar;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\Profile
 *
 * @property integer $id
 * @property integer $main_tag_id
 * @property string $first_name
 * @property string $last_name
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\ProfileMeta $meta
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $managers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Screening[] $screenings
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movement[] $movements
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Folder[] $folders
 * @property-read \App\Models\Tag $mainTag
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $taggables
 * @property-read mixed $tags
 * @property-read \App\Models\Image $avatar
 * @property-read mixed $avatar_src
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereMainTagId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Profile whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Profile extends Model
{
    use Taggable, HasAvatar, CamelCaseAttrs;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta.data' => 'array',
    ];

    /**
     * Attributes which are mass-assignable.
     */
	protected $fillable = ['firstName', 'lastName', 'mainTagId'];

    /**
     * Attributes that SHOULD be appended to the model's array form.
     */
    protected $appends = [];

    /**
     * Attributes that CAN be appended to the model's array form.
     */
    public static $appendable = ['avatarSrc', 'mainTag', 'tags'];

    /**
     * Attributes which should be hidden from the models' array form.
     */
    protected $hidden = ['avatar', 'main_tag_id', 'pivot', 'taggables'];

    /**
     * Profile's additional details.
     */
    public function meta() {
        return $this->hasOne('App\Models\ProfileMeta');
    }

    /**
     * Groups profile belongs to.
     */
    public function groups() {
        return $this->belongsToMany('App\Models\Group');
    }

    /**
     * Managers who manage this profile.
     */
    public function managers() {
        return $this->belongsToMany('App\Models\User', 'manager_profile', 'profile_id', 'manager_id');
    }

    /**
     * Screenings belonging to this profile.
     */
    public function screenings() {
        return $this->hasMany('App\Models\Screening');
    }

    /**
     * Movements belonging to this profile.
     */
    public function movements() {
        return $this->hasMany('App\Models\Movement');
    }

    /**
     * Folders belonging to this profile.
     */
    public function folders() {
        return $this->hasMany('App\Models\Folder');
    }

    /**
     * Primary tag belonging to this profile.
     */
    public function mainTag() {
        return $this->belongsTo('App\Models\Tag', 'main_tag_id');
    }
}
