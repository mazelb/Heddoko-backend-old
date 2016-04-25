<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 */
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Equipment;
use Illuminate\Http\Response;


class ShipController extends Controller
{
	/**
	 *
	 * @return Response
	 */
	public function index()
	{
		$prototypes = Equipment::AllShips();

		return [
			'total' => count($prototypes),
            'page' => 1,
            'per_page' => count($prototypes),
            'results' => $prototypes
		];
	}
}
