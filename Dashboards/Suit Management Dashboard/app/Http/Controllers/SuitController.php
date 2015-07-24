<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnatomicalPosition;
use App\Models\Sensor;
use App\Models\SensorType;
use App\Models\Suit;

use Input;
use Request;

class SuitController extends Controller {

	/**
	 * Display a listing of the suits.
	 *
	 * @return Response: The updated list of suits
	 */
	public function index()
	{
		return Suit::with('sensors.type', 'sensors.anatomicalPosition')
					->orderBy('updated_at', 'desc') //sort by most recently updated
					->get();
	}

	/**
	 * Store a newly created suit in storage.
	 *
	 * @return Response: The updated list of suits
	 */
	public function store()
	{
		$new_suit = Suit::create();
		
		$new_sensors = Request::input('new_suit_sensors');
		
		foreach ($new_sensors as $new_sensor)
		{
			Sensor::create(['suit_id'	  => $new_suit->id,
				'sensor_type_id'		  => $new_sensor['type']['id'],
				'anatomical_position_id'  => $new_sensor['anatomical_position']['id'],
				'part_no'				  => $new_sensor['part_no'],
				'serial_no' 			  => $new_sensor['serial_no'],
				'name'					  => $new_sensor['name'],
				'physical_location' 	  => $new_sensor['physical_location']]);
		}
		
		return $this->index();
	}

	/**
	 * Update the specified suit in storage.
	 *
	 * @param  int  $suit_id
	 * @return Response: The updated list of suits
	 */
	public function update($suit_id)
	{
		$suit_of_interest = Suit::find($suit_id);
		
		foreach ($suit_of_interest->sensors as $existing_sensor)
		{
			$existing_sensor->delete();
		}
		
		$new_sensors = Request::input('updated_suit_sensors', array());
		
		foreach ($new_sensors as $new_sensor)
		{
			Sensor::create(['suit_id'	  => $suit_of_interest->id,
				'sensor_type_id'		  => $new_sensor['type']['id'],
				'anatomical_position_id'  => $new_sensor['anatomical_position']['id'],
				'part_no'				  => $new_sensor['part_no'],
				'serial_no' 			  => $new_sensor['serial_no'],
				'name'					  => $new_sensor['name'],
				'physical_location' 	  => $new_sensor['physical_location']]);
		}
		
		return $this->index();
	}

	/**
	 * Remove the specified suit from storage.
	 *
	 * @param  int  $suit_id
	 * @return Response: The updated list of suits
	 */
	public function destroy($suit_id)
	{
		$suit_of_interest = Suit::find($suit_id);

		$suit_of_interest->delete();
		
		return $this->index();
	}

}
