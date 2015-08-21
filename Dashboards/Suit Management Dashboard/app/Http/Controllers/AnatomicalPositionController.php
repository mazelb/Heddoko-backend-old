<?php namespace App\Http\Controllers;

use Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\AnatomicalPosition;


class AnatomicalPositionController extends Controller {

	/**
	 * Display a listing of anatomical positions.
	 *
	 * @return Response
	 */
	public function index()
	{
        // Build the database query.
        $query = AnatomicalPosition::orderBy('id', 'desc');

        // Filter by search term.
        $search_term = strip_tags(trim(Request::input('search_term')));
        if (strlen($search_term))
        {
            $query->where('name', 'LIKE', '%'. $search_term .'%');
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
