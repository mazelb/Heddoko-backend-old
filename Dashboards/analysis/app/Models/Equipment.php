<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Equipment
 *
 * @property integer $id
 * @property integer $status_id
 * @property integer $material_id
 * @property integer $anatomical_position_id
 * @property integer $complex_equipment_id
 * @property string $mac_address
 * @property string $serial_no
 * @property string $physical_location
 * @property string $notes
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Material $material
 * @property-read \App\Models\AnatomicalPosition $anatomicalPosition
 * @property-read \App\Models\ComplexEquipment $complexEquipment
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereStatusId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereMaterialId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereAnatomicalPositionId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereComplexEquipmentId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereMacAddress($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereSerialNo($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment wherePhysicalLocation($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereNotes($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Equipment whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Equipment extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'equipment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status_id',
        'material_id',
        'anatomical_position_id',
        'complex_equipment_id',
        'mac_address',
        'serial_no',
        'physical_location'
    ];

    /**
     * Status of equipment.
     */
	public function status()
	{
		return $this->belongsTo('App\Models\Status');
	}

    /**
     * Material of this equipment.
     */
    public function material()
    {
        return $this->belongsTo('App\Models\Material');
    }

    /**
     * Anatomical position of this equipemnt.
     */
    public function anatomicalPosition()
    {
        return $this->belongsTo('App\Models\AnatomicalPosition');
    }

    /**
     * Complex equipment this belongs to.
     */
    public function complexEquipment()
    {
        return $this->belongsTo('App\Models\ComplexEquipment');
    }
}
