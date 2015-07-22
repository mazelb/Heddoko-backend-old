<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AnatomicalPosition;
use App\Models\Sensor;
use App\Models\SensorType;
use App\Models\Suit;
use Request;
use Input;

class SuitController extends Controller {

	/**
	 * Display a listing of the suits.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Suit::with('sensors.type', 'sensors.anatomicalPosition')->get();
	}

	/**
	 * Store a newly created suit in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{

		$new_suit = new Suit();
		
		//loop over every sensor to be added to this suit
		
		/*for each sensor in request.sensors as newsensor
		{
			Sensor::create(['suit_id'				  => $new_suit->id,
							'sensor_type_id'		  => newsensor.type,
							'anatomical_position_id'  => newsensor.anatomical_position
							'part_no'				  => newsensor.part_no
							'serial_no' 			  => newsensor.serial_no
							'physical_location' 	  => newsensor.physical_location]);	
		}*/
		
		//save the new suit
		$new_suit->save();
		
		return $this->index();
	}


	/**
	 * Update the specified suit in storage.
	 *
	 * @param  int  $suit_id
	 * @return Response
	 */
	public function update($suit_id)
	{

		$suit_of_interest = Suit::find($suit_id);
		
		/*$input = Request::all();
		
		$FMSFormFields = array(
			'deepsquat', 
			'deepsquatcomments', 
			'Lhurdle', 
			'Rhurdle', 
			'hurdlecomments', 
			'Llunge',
			'Rlunge',
			'lungecomments',
			'Lshoulder',
			'Rshoulder',
			'shouldercomments',
			'Limpingement',
			'Rimpingement',
			'impingementcomments',
			'Lactive',
			'Ractive',
			'activecomments',
			'trunk', 
			'trunkcomments',
			'press',
			'presscomments',
			'Lrotary',
			'Rrotary',
			'rotarycomments',
			'posterior',
			'posteriorcomments');

		foreach ($FMSFormFields as $field) {
			$FMS_form_to_be_updated->$field = Request::get($field);
		}

		$FMS_form_to_be_updated->save();

		return Athlete::find($athlete_id)->fmsforms;*/
	}

	/**
	 * Remove the specified suit from storage.
	 *
	 * @param  int  $suit_id
	 * @return Response
	 */
	public function destroy($suit_id)
	{
		$suit_of_interest = Suit::find($suit_id);

		$suit_of_interest->delete();
		
		return $this->index();
	}

}
