<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\MaterialType;


class MaterialTypeController extends Controller
{
	/**
	 * Display a listing of the material types.
	 *
	 * @return Response
	 */
	public function index()
	{
		$material_types = MaterialTypes::all();

		return [
			'total' => count($material_types),
            'page' => 1,
            'per_page' => count($material_types),
            'results' => $material_types
		];
	}
}
