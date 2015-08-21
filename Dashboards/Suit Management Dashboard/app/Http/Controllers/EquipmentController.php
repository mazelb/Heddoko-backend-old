<?php namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Status;
use Request;

class EquipmentController extends Controller {

	/**
	 * Display a listing of equipment.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Build the database query.
        $query = Equipment::with('status', 'material')
            ->where('status_id', Status::getByName('available')->id)
            ->orderBy('id', 'desc');

        // Filter by search term.
        $search_term = strip_tags(trim(Request::input('search_term')));
        if (strlen($search_term))
        {
            $query->where('serial_no', 'LIKE', '%'. $search_term .'%')
                    ->orWhere('physical_location', 'LIKE', '%'. $search_term .'%');
        }

        // Retrieve search parameters.
        $total = $query->count('id');
        $page = (int) Request::input('page', 1);
        $perPage = (int) Request::input('per_page', 100);
        $perPage = max(1, min(100, $perPage));
        $offset = ($page - 1) * $perPage;
        $results = $query->skip($offset)->take($perPage)->get();

        return [
            'total' => $total,
            'page' => $page,
            'per_page' => $perPage,
            'results' => $results
        ];
	}
	
		/**
	 * Store a newly created suit-equipment in storage.
	 *
	 * @return Response: The updated list of suit-equipments
	 */
	public function store()
	{
		Equipment::create(Request::input('new_equipment_data', array()));
		
		return $this->index();
	}

}
