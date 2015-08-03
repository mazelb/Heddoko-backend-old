<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnatomicalPosition;
use App\Models\Equipment;
use App\Models\Sensor;
use App\Models\SensorType;
use App\Models\SuitEquipment;
use App\Models\Status;

use Input;
use Request;

class SuitEquipmentController extends Controller {

	/**
	 * Display a listing of the suit-equipments.
	 *
	 * @return Response: The updated list of suits
	 */
	public function index()
	{
		return SuitEquipment::with('equipment')->get();
	}

	/**
	 * Store a newly created suit-equipment in storage.
	 *
	 * @return Response: The updated list of suit-equipments
	 */
	public function store()
	{
		$new_suit_equipment = SuitEquipment::create();
		
		$new_suit_equipment_list_ids = Request::input('new_suit_equipment_list');
		
		foreach ($new_suit_equipment_list_ids as $new_suit_equipment_item_id)
		{
			$equipment_model = Equipment::findOrFail($new_suit_equipment_item_id);
			$equipment_model->suits_equipment_id = $new_suit_equipment->id;
			$equipment_model->status_id = Status::getByName('unavailable')->id;
			$equipment_model->save();
		}
		
		return $this->index();
	}

	/**
	 * Update the specified suit in storage.
	 *
	 * @param  int  $suit_id
	 * @return Response: The updated list of suits
	 */
	public function update($suit_equipment_id)
	{	
		$suit_equipment_of_interest = SuitEquipment::find($suit_equipment_id); //retrieve the suit model
		
		foreach ($suit_equipment_of_interest->equipment as $existing_equipment) //unlink each piece of equipment from the suit
		{
			$existing_equipment->status_id = Status::getByName('available')->id;
			$existing_equipment->suits_equipment_id = null;
			$existing_equipment->save();
		}
		
		$new_equipment = Request::input('updated_suit_equipment', array()); //retrieve the updated list of equipment that belongs to the suit
		
		foreach ($new_equipment as $new_equipment_unit) //attach each updated piece of equipment to the suit
		{
			$existing_equipment = Equipment::findOrFail($new_equipment_unit['id']);
			$existing_equipment->suits_equipment_id = $suit_equipment_of_interest->id;
			$existing_equipment->status_id = Status::getByName('unavailable')->id;
			$existing_equipment->save();	
		}
		
		return $this->index();
	}

	/**
	 * Remove the specified suit from storage.
	 *
	 * @param  int  $suit_id
	 * @return Response: The updated list of suits
	 */
	public function destroy($suit_equipment_id)
	{
		$suit_equipment_of_interest = SuitEquipment::find($suit_equipment_id);
		
		foreach ($suit_equipment_of_interest->equipment as $suit_equipment)
		{
			$suit_equipment->suits_equipment_id = null;
			$suit_equipment->status_id = Status::getByName('available')->id;
			$suit_equipment->save();
		}
		
		$suit_equipment_of_interest->delete();
		
		return $this->index();
	}

}
