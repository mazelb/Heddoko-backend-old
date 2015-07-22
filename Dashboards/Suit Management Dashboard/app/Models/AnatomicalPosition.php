<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnatomicalPosition extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'anatomical_positions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'name'];
	
	public $incrementing = false;
	public $timestamps = false;

}
