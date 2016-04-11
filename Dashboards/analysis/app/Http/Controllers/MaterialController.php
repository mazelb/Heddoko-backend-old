<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles http requests for materials.
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Material;
use App\Repositories\MaterialRepository;


class MaterialController extends Controller
{
	/**
	 * The anatomic repository instance.
	 *
	 * @var MaterialRepository
	 */
	protected $materials;
    /**
     * @var Request
     */
    protected  $request;

    /**
     * Create a new controller instance.
     *
     * @param  MaterialRepository $materials
     */
	public function __construct(Request $request,
                                MaterialRepository $materials)
	{
        $this->request = $request;
		$this->materials = $materials;
	}
	
	/**
	 * Display a listing of materials.
	 *
	 * @return Response
	 */
	public function index()
	{
		$search_term = strip_tags(trim($this->request->input('search_term')));
		$page = (int) $this->request->input('page', 1);
		$perPage = (int) $this->request->input('per_page', 100);
		$perPage = max(1, min(100, $perPage));
		$offset = ($page - 1) * $perPage;


        $total = $this->materials->searchCount($search_term);

        $results = $this->materials->search($search_term, $perPage, $offset);

        return [
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'results' => $results
        ];
	}

	/**
	 * Store a newly created material in storage.
	 *
	 * @return Response: The updated list of materials
	 */
	public function store()
	{
        $this->validate($this->request, [
            'new_material_data.name' => 'string|min:1|max:255|unique:materials,name',
            'new_material_data.material_type_id' => 'int|exists:material_types,id',
            'new_material_data.part_no' => 'string|min:1|max:255'
        ]);

		$data = $this->request->input('new_material_data', array());
		$this->materials->create(array_only($data, ['name', 'part_no', 'material_type_id']));

		return $this->index();
	}

	/**
	 * Update the specified material in storage.
	 *
	 * @param  int  $id
	 * @return Response: The updated list of materials
	 */
	public function update($id)
	{
        $this->validate($this->request, [
            'updated_material.id' => 'int|exists:materials,id',
            'updated_material.name' => 'string|min:1|max:255|unique:materials,name,' . $id . ',id',
            'updated_material.material_type_id' => 'int|exists:material_types,id',
            'updated_material.part_no' => 'string|min:1|max:255'
        ]);

		$data = $this->request->input('updated_material', []);
		$this->materials->update(array_only($data, ['name', 'part_no', 'material_type_id']), $id);

		return $this->index();
	}

	/**
	 * Remove the specified material from storage.
	 *
	 * @param  int  $id
	 * @return Response: The updated list of materials.
	 */
	public function destroy($id)
	{
		$this->materials->delete($id);

        return $this->index();
	}
}
