<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SportCategory extends Model {
    
	protected $table = 'sportcategories';
	protected $fillable = ['name'];
	
	public function sportmovements()
    {
        return $this->hasMany('App\Models\SportMovement', 'sport_id');
    }
}
