<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Database model for groups.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    November 2015
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Traits\TaggableTrait as Taggable;
use App\Traits\HasAvatarTrait as HasAvatar;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\Group
 *
 * @property integer $id
 * @property integer $main_tag_id
 * @property string $name
 * @property string $meta
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $managers
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $profiles
 * @property-read \App\Models\Tag $mainTag
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Tag[] $taggables
 * @property-read mixed $tags
 * @property-read \App\Models\Image $avatar
 * @property-read mixed $avatar_src
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereMainTagId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereMeta($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Group whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Group extends Model
{
    use Taggable, HasAvatar, CamelCaseAttrs;

    /**
     * Attributes which are mass-assignable.
     */
    protected $fillable = ['name', 'meta'];

    /**
     * Attributes that SHOULD be appended to the model's array form.
     */
    protected $appends = [];

    /**
     * Attributes that CAN be appended to the model's array form.
     */
    public static $appendable = ['avatarSrc', 'tags'];

    /**
     * Attributes which should be hidden from the models' array form.
     */
    protected $hidden = ['avatar', 'pivot', 'taggables'];

    /**
     * Managers of this group.
     */
    public function managers() {
        return $this->belongsToMany('App\Models\User', 'group_manager', 'group_id', 'manager_id');
    }

    /**
     * Profiles beloning to this group.
     */
    public function profiles() {
        return $this->belongsToMany('App\Models\Profile');
    }

    /**
     * Primary tag belonging to this profile.
     */
    public function mainTag() {
        return $this->belongsTo('App\Models\Tag', 'main_tag_id');
    }
}
