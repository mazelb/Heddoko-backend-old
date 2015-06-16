<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Athlete;
use App\Models\FMSForm;
use Request;

class AthleteFMSFormController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($athleteid)
	{
		$athlete = Athlete::find($athleteid);
		return $athlete->fmsforms;
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
	public function store($athleteid)
	{

		$input = Request::all();
		
		$input['athlete_id']  = $athleteid;

		$newForm = FMSForm::create($input);
		
		$newForm->save();
		
		return Athlete::find($athleteid)->fmsforms;
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
	public function destroy($athleteid, $fmsformid)
	{
		$FMSFormInQuestion = FMSForm::find($fmsformid);
		$FMSFormInQuestion->delete();
		
		$athlete =  Athlete::find($athleteid);
		return $athlete->fmsforms;
	}

}
