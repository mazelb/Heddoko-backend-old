<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ComplexEquipment
 *
 * @property integer $id
 * @property integer $status_id
 * @property string $mac_address
 * @property string $serial_no
 * @property string $physical_location
 * @property string $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Status $status
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Equipment[] $equipment
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Movement[] $movements
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ComplexEquipment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ComplexEquipment whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ComplexEquipment whereMacAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ComplexEquipment whereSerialNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ComplexEquipment wherePhysicalLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ComplexEquipment whereNotes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ComplexEquipment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\ComplexEquipment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ComplexEquipment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'complex_equipment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status_id', 'mac_address', 'serial_no', 'physical_location'];

    /**
     * Status of complex equipment.
     */
	public function status()
	{
		return $this->belongsTo('App\Models\Status');
	}

    /**
     * Equipment which make up this complex equipment.
     */
	public function equipment()
	{
		return $this->hasMany('App\Models\Equipment', 'complex_equipment_id');
	}

    /**
     * Movements recorded with this complex equipment.
     */
	public function movements()
	{
		return $this->hasMany('App\Models\Movement', 'complex_equipment_id');
	}
}
