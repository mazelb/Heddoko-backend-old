<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Athlete extends Model {
    
	protected $table = 'athletes';
	protected $fillable = ['team_id', 'name', 'age'];
	
	public function fmsforms()
    {
        return $this->hasMany('App\Models\FMSForm');
    }
	
	public function movements()
    {
        return $this->hasMany('App\Models\Movement');
    }
}
