<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Status;


class StatusController extends Controller
{
	/**
	 * Display a listing of statuses.
	 *
	 * @return Response
	 */
	public function index()
	{
		$statuses = Status::all();

		return [
			'total' => count($statuses),
            'page' => 1,
            'per_page' => count($statuses),
            'results' => $statuses
		];
	}
}
