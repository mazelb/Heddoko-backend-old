<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportMovement extends Model {
    
	protected $table = 'sportmovements';
	protected $fillable = ['sport_id', 'name'];
	
	public function movements()
	{
		return $this->hasMany('App\Models\Movement');
	}
	
	public function sportcategory()
	{
		return $this->belongsTo('App\Models\SportCategory', 'sport_id');
	}
}
