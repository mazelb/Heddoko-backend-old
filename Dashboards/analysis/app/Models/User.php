<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Database model for users.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    November 2015
 */
namespace App\Models;

use DB;

use App\Traits\HasAvatarTrait as HasAvatar;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * App\Models\User
 *
 * @property integer $id
 * @property string $email
 * @property string $username
 * @property string $password
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $country
 * @property string $config
 * @property string $remember_token
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Profile[] $profiles
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Group[] $groups
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Role[] $roles
 * @property-read \App\Models\Image $avatar
 * @property-read mixed $avatar_src
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUsername($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereFirstName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereLastName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCountry($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereConfig($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword, HasAvatar, CamelCaseAttrs;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'first_name',
        'last_name',
        'phone',
        'config',
    ];

    /**
     * Attributes which should be appended to the model's array form.
     */
    protected $appends = ['avatar_src'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'pivot'
    ];

    /**
     * Profiles managed by this user.
     */
    public function profiles() {
        return $this->belongsToMany('App\Models\Profile', 'manager_profile', 'manager_id', 'profile_id');
    }

    /**
     * Groups managed by this user.
     */
    public function groups() {
        return $this->belongsToMany('App\Models\Group', 'group_manager', 'manager_id', 'group_id');
    }

    /**
     * Roles taken on by this user.
     */
    public function roles() {
        return $this->belongsToMany('App\Models\Role');
    }

    /**
     * Gets the IDs of profiles managed by this user. This is necessary for retrieving secondary
     * relations as we cannot use Laravel's "Has-Many-Through" relation here.
     *
     * @return array
     */
    public function getProfileIDs()
    {
        // Profile IDs.
        $profiles = DB::table('profiles')
            ->select('profiles.id')
            ->join('manager_profile', 'profiles.id', '=', 'manager_profile.profile_id')
            ->where('manager_profile.manager_id', '=', $this->id)
            ->get();

        // Mapper to convert objects to IDs.
        $mapper = function($profile) {
            return $profile->id;
        };

        return array_map($mapper, $profiles);
    }
}
