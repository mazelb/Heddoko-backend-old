<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SensorType extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sensor_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name'];
	
	public $incrementing = false;
	public $timestamps = false;

}
