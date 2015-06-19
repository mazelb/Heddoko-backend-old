<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Team;
use App\Models\Athlete;
use Illuminate\Http\Request;

class TeamAthleteController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($teamid)
	{
		$team = Team::find($teamid);
		return $team->athletes;
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
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store($team_id, Request $request)
	{
	
		$activeTeam = Team::find($team_id);

		$newAthleteData = [];
		$newAthleteData['team_id'] = $activeTeam->id;
		$newAthleteData['name'] = $request->input('name');
		
		$newAthlete = Athlete::create($newAthleteData);
		$newAthlete->save();		
		
		return $activeTeam->athletes;
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
