<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Material;


class MaterialController extends Controller {

	/**
	 * Display a listing of the sensor types.
	 *
	 * @return Response
	 */
	public function index()
	{
		return Material::all();
	}

}
