<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FMSForm extends Model {

    protected $table = 'fmsforms';
    protected $fillable = ['movement_id', 'deepsquatrawscore', 'deepsquatfinalscore', 'deepsquatcomment', 'Rhurdlerawscore', 'Lhurdlerawscore', 'hurdlefinalscore', 'hurdlecomment'];

}
