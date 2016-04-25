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
 * @property integer prototype
 * @property integer condition
 * @property integer numbers
 * @property integer heats_shrink
 * @property integer ship
 * @property integer verified_by
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \App\Models\Status $status
 * @property-read \App\Models\Material $material
 * @property-read \App\Models\AnatomicalPosition $anatomicalPosition
 * @property-read \App\Models\ComplexEquipment $complexEquipment
 * @property-read \App\Models\User $verifiedBy
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
    const PROTOTYPE_YES = 1;
    const PROTOTYPE_NO = 2;

    const CONDITIONAL_NEW = 1;
    const CONDITIONAL_USED = 2;

    const NUMBERS_YES = 1;
    const NUMBERS_NO = 2;

    const HEATS_SHRINK_YES = 1;
    const HEATS_SHRINK_NO = 2;

    const SHIP_YES = 1;
    const SHIP_NO = 2;
    const SHIP_GONE = 3;

    public static function AllPrototypes() {
        $result = [[
            "id" => self::PROTOTYPE_YES,
            "name" => "Yes"
        ], [
            "id" => self::PROTOTYPE_NO,
            "name" => "No"
        ]];

        return $result;
    }

    public static function AllConditionals() {
        $result = [[
            "id" => self::CONDITIONAL_NEW,
            "name" => "New"
        ], [
            "id" => self::CONDITIONAL_USED,
            "name" => "Used"
        ]];

        return $result;
    }

    public static function AllNumbers() {
        $result = [[
            "id" => self::NUMBERS_YES,
            "name" => "Yes"
        ], [
            "id" => self::NUMBERS_NO,
            "name" => "No"
        ]];

        return $result;
    }

    public static function AllHeatsShrink() {
        $result = [[
            "id" => self::HEATS_SHRINK_YES,
            "name" => "Yes"
        ], [
            "id" => self::HEATS_SHRINK_NO,
            "name" => "No"
        ]];

        return $result;
    }

    public static function AllShips() {
        $result = [[
            "id" => self::SHIP_YES,
            "name" => "Yes"
        ], [
            "id" => self::SHIP_NO,
            "name" => "No"
        ], [
            "id" => self::SHIP_GONE,
            "name" => "Gone"
        ]];

        return $result;
    }

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
        'physical_location',
        'notes',
        'prototype',
        'condition',
        'numbers',
        'heats_shrink',
        'ship',
        'verified_by'
    ];

    /**
     * User.
     */
    public function verifiedBy()
    {
        return $this->belongsTo('App\Models\User');
    }

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
