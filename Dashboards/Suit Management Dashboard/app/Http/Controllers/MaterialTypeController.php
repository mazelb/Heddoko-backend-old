<?php namespace App\Http\Controllers;

use Request;

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
		$material_types = MaterialType::orderBy('id', 'desc')->get();

		return [
			'total' => count($material_types),
            'page' => 1,
            'per_page' => count($material_types),
            'results' => $material_types
		];
	}

	/**
	 * Store a newly created material type in storage.
	 *
	 * @return Response: The updated list of material types
	 */
	public function store()
	{
		MaterialType::create(Request::input('new_material_type_data', array()));

		return $this->index();
	}
}
