<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles http requests for equipment statuses.
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Status;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class UsersController extends Controller
{
	/**
	 *
	 */
	const SEARCH_LIMIT = 100;

	/**
	 *
	 */
	const ORDER_DIR = 'asc';

	/**
	 * The user repository instance.
	 *
	 * @var UserRepository
	 */
	protected $users;


	/**
	 * The request instance.
	 *
	 * @var Request
	 */
	protected $request;

	/**
	 * @param \Illuminate\Http\Request $request
	 * @param  UserRepository  $users
	 */
	public function __construct(Request $request, UserRepository $users)
	{
		$this->request = $request;
		$this->users = $users;
	}

	/**
	 * @return Response
	 */
	public function index()
	{
		$searchTerm = null;
		if ($this->request->has('query')) {
			$searchTerm = trim($this->request->get('query'));
		}

		$offset = max(0, $this->request->get('offset', 0));
		$limit = min(static::SEARCH_LIMIT, $this->request->get('limit', 20));
		$orderDir = $this->request->get('orderDir', static::ORDER_DIR);
		$orderDir = in_array($orderDir, ['asc', 'desc']) ? $orderDir : static::ORDER_DIR;


		$count = $this->users->count($searchTerm);
		$results = $this->users->get($searchTerm, 'username', $orderDir, $limit, $offset);
		return [
			'total' => $count,
			'offset' => $offset,
			'limit' => $limit,
			'results' => $results
		];
	}
}
