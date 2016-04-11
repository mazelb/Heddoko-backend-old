<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles http requests for material types.
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\MaterialType;
use App\Http\Controllers\Controller;
use App\Repositories\MaterialTypeRepository;

class MaterialTypeController extends Controller
{

	/**
	 * The equipment repository instance.
	 *
	 * @var MaterialTypeRepository
	 */
	protected $materialTypes;
	/**
	 * @var Request
	 */
	protected  $request;

    /**
     * Create a new controller instance.
     *
     * @param Request $request
     * @param  MaterialTypeRepository $materialTypes
     */
	public function __construct(Request $request, MaterialTypeRepository $materialTypes)
	{
        $this->request = $request;
		$this->materialTypes = $materialTypes;
	}

	/**
	 * Display a listing of the material types.
	 *
	 * @return Response
	 */
	public function index()
	{
		$material_types = $this->materialTypes->all();

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
		$this->validate($this->request, [
			'new_material_type_data.identifier' => 'string|min:1|max:255|unique:material_types,identifier'
		]);

        $data = $this->request->input('new_material_type_data', array());
		$this->materialTypes->create(array_only($data, ['identifier']));

		return $this->index();
	}

	/**
	 * Update the specified material type in storage.
	 *
	 * @param  int  $id
	 * @return Response: The updated list of material types
	 */
	public function update($id)
	{
        $this->validate($this->request, [
            'updated_material_type.id' => 'int|exists:material_types,id',
            'updated_material_type.identifier' => 'string|min:1|max:255|unique:material_types,identifier,' . $id . ',id'
        ]);
        
        $data = $this->request->input('updated_material_type', []);

        $this->materialTypes->update(array_only($data, ['identifier']), $id);

		return $this->index();
	}

	/**
	 * Remove the specified material type from storage.
	 *
	 * @param  int  $id
	 * @return Response: The updated list of material types.
	 */
	public function destroy($id)
	{
		$this->materialTypes->delete($id);

        return $this->index();
	}
}
