<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\FMSForm;
use App\Models\Athlete;
use App\Models\Movement;
use App\Models\SportMovement;
use App\Models\MovementRawEntry;

use Input;
use Validator;
use Redirect;
use Session;
use Request;

class AthleteMovementController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($athleteid)
	{
		$athlete = Athlete::find($athleteid);
		return $athlete->movements;
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	* @brief This is AthleteMovement store method, used for storing independent movement(s), that is, a movement which is not tied to an FMS form, but was just just done spontaneously as a Sport Movement under a Sport Category
	* It's purpose is to validate, store, and parse these incoming movements
	* @param $athlete_id, the id of the athlete who performed the movement(s)
	* @param $request, the chunk of data contained in the incoming post request, which includes the raw movement files and the sport movement ID
	* @return void
	*/
	 
	public function store($athlete_id, Request $request)
	{
	
		//First we read in the unique ID of the sport movement that all the incoming movements belong to
		$sport_movement_id = Request::input('sportMovementID');
		
		//We also read in the array (1 or more) movement files that have been sent 
		$movement_files = Input::file('movements');

		$file_count = count($movement_files); //how many files were sent to the back-end
		$upload_count = 0; //to keep track of how many files are successfully uploaded
		
		$sport_movement = SportMovement::findOrFail($sport_movement_id); //instantiate the model of the SportMovement that the incoming movement(s) fall under
		$athlete = Athlete::findOrFail($athlete_id);

		foreach($movement_files as $movement_file) { //loop over every movement file
		
			//Here is where some file validation code would need to be, perhaps verifying mime type or file size

			//Each incoming movement file will be stored in the database using the Movement model
			//We prepare the data for this new Movement model
			
			$new_movement_data = [];
			$new_movement_data['athlete_id'] = $athlete->id; //the movement belongs to the supplied athlete (by ID)
			$new_movement_data['sportmovement_id'] = $sport_movement->id; //specify that the new Movement object is of this type of Sport Movement
			$new_movement_data['name'] = $sport_movement->name . '_movement'; //specify that the name of the movement is of the format "{movement_name}_movement"
			$new_movement_data['fmsform_id'] = null; //These movements are not associated with an FMS Form

			$new_movement = Movement::create($new_movement_data); //create and save the Model to the database
			$new_movement->save();

			//copy the incoming movement file to local storage
		
			$destinationPath = 'uploads';		
			$filename = 'coach_' . $athlete->team->coach->name . '_team_' . $athlete->team->name . '_athlete_' . $athlete->name . '_movement_' . $sport_movement->sportcategory->name . '_movementid_' .  $new_movement->id . '_sportmovement_' . $sport_movement->id . '.txt'; //getClientOriginalName();

			$upload_success = $movement_file->move($destinationPath, $filename);
			$upload_count++;
			
			//create an entry in the database to refer back to this raw file we just stored
			
			$new_movement_raw_entry = MovementRawEntry::create(['movement_id' => $new_movement->id,
																													'filename' => $filename]);;
			$new_movement_raw_entry->save();
			
			//The following commented out code block will be used to read every line of the movement file, for parsing purposes
			
			/*
			$file_handle = fopen($movement_file, "r");
			
			while (!feof($file_handle)) {
				$line = fgets($file_handle);
				echo $line;
			}
			
			fclose($file_handle);
			*/

		}

		if($upload_count == $file_count){
			return('all movements successfully uploaded!');
		} 
		else {
			return('error uploading 1 or more of the movements.');
		}
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
