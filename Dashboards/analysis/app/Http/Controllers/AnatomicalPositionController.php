<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles http requests for anatomical positions.
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AnatomicalPosition;
use App\Repositories\AnatomicalPositionRepository;


class AnatomicalPositionController extends Controller
{

    /**
     * The anatomic repository instance.
     *
     * @var AnatomicalPositionRepository
     */
    protected $anatomicalPositions;
	/**
	 * @var Request
	 */
	protected  $request;

	/**
	 * Create a new controller instance.
	 *
	 * @param Request $request
	 * @param  AnatomicalPositionRepository $anatomicalPositions
	 */
    public function __construct(Request $request, AnatomicalPositionRepository $anatomicalPositions)
    {
		$this->request = $request;
        $this->anatomicalPositions = $anatomicalPositions;
    }

	/**
	 * Display a listing of anatomical positions.
	 *
	 * @return Response
	 */
	public function index()
	{
		$searchTerm = strip_tags(trim($this->request->input('search_term')));
		$page = (int) $this->request->input('page', 1);
		$perPage = (int) $this->request->input('per_page', 100);
		$perPage = max(1, min(100, $perPage));
		$offset = ($page - 1) * $perPage;


		$total = $this->anatomicalPositions->searchCount($searchTerm);
        $results =  $this->anatomicalPositions->search($searchTerm, $perPage, $offset);

		// Add an "updated_id" attribute, so we can modify it later if needed.
		// We need to do this because the ID attribute is non-incrementing and user editable,
		// which means we need some way to reference this model while updating it other than
		// by ID.
		if (count($results)) {
			foreach ($results as $anatomical_position) {
				$anatomical_position['updated_id'] = $anatomical_position['id'];
			}
		}

        return [
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'results' => $results
        ];
	}

	/**
	 * @return Response
	 */
	public function store()
	{
		$this->validate($this->request, [
			'new_anatomical_position_data.id' => 'int|unique:anatomical_positions,id',
			'new_anatomical_position_data.name' => 'string|min:1|max:255|unique:anatomical_positions,name'
		]);


		$data = $this->request->input('new_anatomical_position_data', array());
		$this->anatomicalPositions->create($data);

		return $this->index();
	}

	/**
	 * Update the specified anatomical position in storage.
	 *
	 * @param  int  $id
	 * @return Response: The updated list of anatomical positions
	 */
	public function update($id)
	{
		$this->validate($this->request, [
			'updated_anatomical_position.id' => 'int|exists:anatomical_positions,id',
			'updated_anatomical_position.name' => 'string|min:1|max:255|unique:anatomical_positions,name,' . $id . ',id'
		]);
		// Retrieve the anatomical position model.
		$model = $this->anatomicalPositions->find($id);

		// Retrieve the updated data for this model.
		$updated_model = $this->request->input('updated_anatomical_position', []);

		// Update the ID.
		if (isset($updated_model['updated_id'])) {
			$updated_model['id'] = $updated_model['updated_id'];
		}

        $this->anatomicalPositions->update(array_except($updated_model, ['updated_id', '$$hashKey']), $id);

		return $this->index();
	}

	/**
	 * Remove the specified anatomical position from storage.
	 *
	 * @param  int  $id
	 * @return Response: The updated list of anatomical positions.
	 */
	public function destroy($id)
	{
		$this->anatomicalPositions->delete($id);

        return $this->index();
	}
}
