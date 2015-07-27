<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AnatomicalPosition;
use App\Models\Sensor;
use App\Models\SensorType;
use App\Models\Suit;

use DB;
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

    public function search()
    {
        // Retrieve search parameters.
        $page = (int) Request::input('page', 1);
        $perPage = (int) Request::input('per_page', 5);
        $perPage = max(0, min(100, $perPage));

        // Build the database query.
//        $query = Suit::with('sensors.type', 'sensors.anatomicalPosition')
//                    ->leftJoin('sensors', 'suits.id', '=', 'sensors.suit_id')
//                    ->orderBy('suits.updated_at', 'desc');
        $query = DB::table('suits')
                    ->leftJoin('sensors', 'suits.id', '=', 'sensors.suit_id')
                    ->distinct()
                    ->select('suits.id')
                    ->orderBy('suits.updated_at', 'desc');

        // Filter by search term.
        $search = strip_tags(trim(Request::input('q')));
        if (strlen($search))
        {
            $query->where('sensors.name', 'LIKE', '%'. $search .'%')
                ->orWhere('sensors.serial_no', 'LIKE', '%'. $search .'%')
                ->orWhere('sensors.physical_location', 'LIKE', '%'. $search .'%');
        }

        // Retrieve suits by page.
        $total = $query->count('suits.id');
        $offset = ($page - 1) * $perPage;
        $IDs = $query->skip($offset)->take($perPage)->lists('id');
        $suits = Suit::with('sensors.type', 'sensors.anatomicalPosition')->whereIn('id', $IDs)->get();

        return [
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'results' => $suits
        ];
    }

}
