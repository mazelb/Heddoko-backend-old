<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   The profile meta holds additional information about a profile.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    December 2015
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CamelCaseTrait as CamelCaseAttrs;

/**
 * App\Models\ProfileMeta
 *
 * @property integer $id
 * @property integer $profile_id
 * @property float $height
 * @property float $mass
 * @property string $dob
 * @property boolean $gender
 * @property string $phone
 * @property string $email
 * @property string $data
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileMeta whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileMeta whereProfileId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileMeta whereHeight($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileMeta whereMass($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileMeta whereDob($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileMeta whereGender($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileMeta wherePhone($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileMeta whereEmail($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ProfileMeta whereData($value)
 * @mixin \Eloquent
 */
class ProfileMeta extends Model
{
    use CamelCaseAttrs;

    /**
     * Gender not specified.
     */
    CONST GENDER_NOT_SPECIFIED = 0;

    /**
     * Gender option: female.
     */
    CONST GENDER_FEMALE = 1;

    /**
     * Gender option: male
     */
    CONST GENDER_MALE = 2;

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'data' => 'array',
    ];

    /**
     * Name of associated database table.
     */
    protected $table = 'profile_meta';

    /**
     * Indicates if the model should be timestamped.
     */
    public $timestamps = false;

    /**
     * Attributes which should be hidden from the models' array form.
     */
    protected $hidden = ['id', 'profile_id'];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    // protected $dates = ['dob'];

    /**
     * Attributes which are mass-assignable.
     */
	protected $fillable = [
        'height',
        'mass',
        'dob',
        'gender',
        'phone',
        'email',
        'data'
    ];

    /**
     * Accessor for $this->gender.
     *
     * @param int $gender
     * @return string
     */
    public function getGenderAttribute($gender)
    {
        $string = '';

        switch ($gender)
        {
            case static::GENDER_FEMALE:
                $string = 'female';
                break;

            case static::GENDER_MALE:
                $string = 'male';
                break;
        }

        return $string;
    }

    /**
     * Mutator for $this->gender.
     *
     * @param string|int $gender
     * @return void
     */
    public function setGenderAttribute($gender)
    {
        // Set the right gender constant.
        if (!is_integer($gender))
        {
            switch ($gender)
            {
                case 'female':
                    $gender = static::GENDER_FEMALE;
                    break;

                case 'male':
                    $gender = static::GENDER_MALE;
                    break;

                default:
                    $gender = static::GENDER_NOT_SPECIFIED;
            }
        }

        $this->attributes['gender'] = $gender;
    }
}
