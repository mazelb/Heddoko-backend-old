<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AnatomicalPosition;


class AnatomicalPositionController extends Controller {

	/**
	 * Display a listing of the sensor types.
	 *
	 * @return Response
	 */
	public function index()
	{
		return AnatomicalPosition::all();
	}

}
