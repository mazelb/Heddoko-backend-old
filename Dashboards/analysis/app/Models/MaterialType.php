<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\MaterialType
 *
 * @property integer $id
 * @property string $identifier
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Material[] $materials
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MaterialType whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\MaterialType whereIdentifier($value)
 * @mixin \Eloquent
 */
class MaterialType extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'material_types';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['identifier'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;

    /**
     * Related materials
     */
    public function materials()
    {
        return $this->hasMany('App\Models\Material');
    }
}
