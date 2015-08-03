<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Status;
use Request;

class EquipmentController extends Controller {

	/**
	 * Display a listing of the sensor types.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Equipment::with('status')
		->where('status_id', Status::getByName('available')->id)
		->get();
		
		/*if (Request::has('already_selected')) {
			$query->whereNotIn('id', Request::input('already_selected'));
		}*/
		
		return $query->get();
	}
	
		/**
	 * Store a newly created suit-equipment in storage.
	 *
	 * @return Response: The updated list of suit-equipments
	 */
	public function store()
	{
		Equipment::create(Request::input('new_equipment_data', array()));
		
		return $this->index();
	}

}
