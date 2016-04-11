<?php

namespace App\Repositories;
use App\Models\MovementFrame;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Illuminate\Database\Query\Builder;

class MovementFrameRepository extends Repository
{
    /**
     * @var MovementFrame
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return MovementFrame
     */
    function model()
    {
        return 'App\Models\MovementFrame';
    }

    /**
     * @param $movementId
     * @param array|null $embed
     * @return Builder
     */
    private function queryByMovement($movementId, array $embed = null) {
        $model = $this->modelEmbed($embed);
        return $model->where('movement_id', '=', $movementId);
    }

    public function getById($id, $movementId, array $embed = null) {
        return $this->queryByMovement($movementId, $embed)->find($id);
    }

    public function countByMovement($movementId) {
        $query = $this->queryByMovement($movementId);
        return $query->count();
    }

    public function getByMovement($movementId, $orderBy = 'timestamp', $orderDir = 'asc', $take = null, $offset = 0,  array $embed = null) {
        $query = $this->queryByMovement($movementId, $embed);
        return $query->orderBy($orderBy, $orderDir)->skip($offset)->take($take);
    }
    
    public function destroy($movementId, $frameId) {
        $deleted = false;
        $query = $this->queryByMovement($movementId);
        if (strpos($frameId, ',') !== false)
        {
            $frames = $query->whereIn('id', explode(',', $frameId))->lists('id')->toArray();

            if (count($frames)) {
                $deleted = $this->model->destroy($frames);
            }
        }

        // Delete a single frame.
        elseif ($query->exists($frameId))
        {
            $deleted = $this->model->destroy($frameId);
        }

        return $deleted;
    }
}