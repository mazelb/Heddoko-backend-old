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

class ProfileMeta extends Model
{
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
     * Attributes which are mass-assignable.
     */
	protected $fillable = [
        'height',
        'mass',
        'dob',
        'gender',
        'phone',
        'email',
        'medical_history',
        'injuries',
        'notes',
        'meta'
    ];
}
