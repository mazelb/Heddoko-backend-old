<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {
    
	protected $table = 'teams';
	protected $fillable = ['coach_id', 'name'];
	
	public function athletes()
    {
        return $this->hasMany('App\Models\Athlete');
    }
}
