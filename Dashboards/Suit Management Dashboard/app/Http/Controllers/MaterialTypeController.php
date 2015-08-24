<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Models\MaterialType;
use App\Http\Controllers\Controller;


class MaterialTypeController extends Controller
{
	/**
	 * Display a listing of the material types.
	 *
	 * @return Response
	 */
	public function index()
	{
		$material_types = MaterialType::all();

		return [
			'total' => count($material_types),
            'page' => 1,
            'per_page' => count($material_types),
            'results' => $material_types
		];
	}
}
