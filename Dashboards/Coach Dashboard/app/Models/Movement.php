<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movement extends Model {
    
	protected $fillable = ['athlete_id', 'name', 'sportmovement_id', 'fmsform_id'];
	
	public function frames()
    {
			return $this->hasMany('App\Models\Frame');
    }

    public function movementrawentries()
    {
			return $this->hasOne('App\Models\MovementRawEntry');
    }
		public function sportmovement()
    {
			return $this->belongsTo('App\Models\SportMovement');
    }
		
		public function athlete()
    {
			return $this->belongsTo('App\Models\Athlete');
    }
}
