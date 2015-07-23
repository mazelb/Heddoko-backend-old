<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'sensors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['suit_id', 'anatomical_position_id', 'sensor_type_id', 'part_no', 'serial_no', 'physical_location', 'name'];
	
	protected $hidden = ['suit_id', 'anatomical_position_id', 'sensor_type_id'];

	public function type()
	{
		return $this->belongsTo('App\Models\SensorType', 'sensor_type_id');
	}
	
	public function anatomicalPosition()
	{
		return $this->belongsTo('App\Models\AnatomicalPosition', 'anatomical_position_id');
	}
	
}
