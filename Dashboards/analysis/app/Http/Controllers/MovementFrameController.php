<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles http requests for movement frames.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    February 2016
 */
namespace App\Http\Controllers;

use App\Repositories\MovementFrameRepository;
use App\Repositories\MovementRepository;
use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Movement;
use App\Models\MovementFrame;
use App\Http\Controllers\Controller;

class MovementFrameController extends Controller
{
    /**
     * The request
     *
     * @var Request
     */
    protected $request;
    /**
     * @var MovementFrameRepository
     */
    private $movementFrames;
    /**
     * @var MovementRepository
     */
    private $movements;

    /**
     * @param \Illuminate\Http\Request $request
     * @param MovementFrameRepository $movementFrames
     * @param MovementRepository $movements
     */
    public function __construct(Request $request,
                                MovementFrameRepository $movementFrames,
                                MovementRepository $movements)
    {
        $this->request = $request;
        $this->movementFrames = $movementFrames;
        $this->movements = $movements;
    }

    /**
     * Display a listing of the resource.
     *
     * @param int $movementId
     * @return \Illuminate\Http\Response
     */
    public function index($movementId)
    {
        $movement = $this->getMovement($movementId);
        if (!$movement) {
            return response('Movement Not Found.', 404);
        }

        // Retrieve list of relations and attributes to append to results.
        $embed = $this->getEmbedArrays(
            $this->request->get('embed'),
            MovementFrame::$appendable
        );

        $offset = 0;
        if ($this->request->has('offset')) {
            $offset = (int) $this->request->input('offset');
        }

        $limit = null;
        if ($this->request->has('limit')) {
            $limit = (int) $this->request->input('limit');
        }

        $orderDir = $this->request->input('orderDir', 'asc');
        $orderDir = in_array($orderDir, ['asc', 'desc']) ? $orderDir : 'asc';


        $count = $this->movementFrames->countByMovement($movementId);
        $frames = $this->movementFrames->getByMovement($movementId, 'timestamp', $orderDir, $limit, $offset, $embed);

        return [
            'total' => $count,
            'offset' => $offset,
            'limit' => $limit,
            'frames' => $frames
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param int $movementId
     * @return \Illuminate\Http\Response
     */
    public function store($movementId)
    {
        // Performance check.
        if (!$movement = $this->getMovement($movementId)) {
            return response('Movement Not Found.', 404);
        }

        // TODO
        return response('In Development.', 501);
    }

    /**
     * Display the specified resource.
     *
     * @param int $movementId
     * @param int $frameId
     * @return \Illuminate\Http\Response
     */
    public function show($movementId, $frameId)
    {
        $movement = $this->getMovement($movementId);
        if (!$movement) {
            return response('Movement Not Found.', 404);
        }

        // Retrieve list of relations and attributes to append to results.
        $embed = $this->getEmbedArrays(
            $this->request->get('embed'),
            MovementFrame::$appendable
        );

        // Retrieve movement frame.
        $frame = $this->movementFrames->getById($frameId, $movementId, $embed);
        if (!$frame) {
            return response('Frame Not Found.', 404);
        }

        return $frame;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $movementId
     * @param int $frameId
     * @return \Illuminate\Http\Response
     */
    public function update($movementId, $frameId)
    {
        // TODO
        return response('In Development.', 501);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $movementId
     * @param int $frameId
     * @return \Illuminate\Http\Response
     */
    public function destroy($movementId, $frameId)
    {
        // Performance check.
        $movement = $this->getMovement($movementId);
        if (!$movement) {
            return response('Movement Not Found.', 404);
        }

        $deleted = $this->movementFrames->destroy($movementId, $frameId);

        return $deleted ? response('', 204) : response('', 500);
    }

    /**
     * Shortcut to retrieve the specified movement.
     *
     * @param int $movementId
     * @return \App\Models\Movement
     */
    private function getMovement($movementId) {
        return $this->movements->getById($movementId, Auth::user()->getProfileIDs());
    }
}
