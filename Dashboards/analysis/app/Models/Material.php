<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Models;

use App\Models\MaterialType;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Material
 *
 * @property integer $id
 * @property integer $material_type_id
 * @property string $name
 * @property string $part_no
 * @property-read \App\Models\MaterialType $materialType
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Material whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Material whereMaterialTypeId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Material whereName($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Material wherePartNo($value)
 * @mixin \Eloquent
 */
class Material extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'materials';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['material_type_id', 'name', 'part_no'];

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
	public $timestamps = false;

    /**
     * Related material types
     */
    public function materialType()
    {
        return $this->belongsTo('App\Models\MaterialType');
    }
}
