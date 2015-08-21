<?php namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Material;


class MaterialController extends Controller {

	/**
	 * Display a listing of materials.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Build the database query.
        $query = Material::with('material_type')
            ->orderBy('id', 'desc');

        // Filter by search term.
        $search_term = strip_tags(trim(Request::input('search_term')));
        if (strlen($search_term))
        {
            $query->where(function($query) use ($search_term) {
                $query->where('name', 'LIKE', '%'. $search_term .'%')
                    ->orWhere('part_no', 'LIKE', '%'. $search_term .'%');
            });
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

}
