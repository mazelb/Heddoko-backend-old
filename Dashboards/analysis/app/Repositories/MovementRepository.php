<?php

namespace App\Repositories;
use App\Models\Movement;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Illuminate\Database\Query\Builder;

class MovementRepository extends Repository
{
    /**
     * @var Movement
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return Movement
     */
    function model()
    {
        return 'App\Models\Movement';
    }

    /**
     * @param null $profileId
     * @param null $profileIDs
     * @return Builder
     */
    private function queryByProfile($profileId = null, $profileIDs = null) {
        if($profileId) {
            $query = $this->model->where('profile_id', '=', $profileId);
        } else {
            $query =  $this->model->whereIn('profile_id', $profileIDs);
        }

        return $query;
    }

    /**
     * @param $id
     * @param $profileIDs
     * @param array $embed
     * @return mixed
     */
    public function getById($id, $profileIDs, array $embed = null) {
        $query = $this->queryByProfile(null, $profileIDs);

        if($embed) {
            $query = $query->with($embed);
        }

        return $query->find($id);
    }

    /**
     * @param null $profileId
     * @param null $profileIDs
     * @return int
     */
    public function countByProfile($profileId = null, $profileIDs = null) {
       $query = $this->queryByProfile($profileId, $profileIDs);
        return $query->count();
    }

    /**
     * @param null $profileId
     * @param null $profileIDs
     * @param string $orderBy
     * @param string $orderDir
     * @param int $take
     * @param int $skip
     * @return array|static[]
     */
    public function getByProfile($profileId = null, $profileIDs = null, $orderBy = 'created_at', $orderDir = 'desc', $take = 20, $skip = 0) {
        $query = $this->queryByProfile($profileId, $profileIDs);

        return $query->orderBy($orderBy, $orderDir)->skip($skip)->take($take)->get();
    }

    public function destroy($id, $profileIDs) {

        $query = $this->model->whereIn('profile_id', $profileIDs);

        // Delete an array of movements.
        $deleted = false;
        if (strpos($id, ',') !== false)
        {
            $movements = $query->whereIn('id', explode(',', $id))->lists('id')->toArray();

            if (count($movements)) {
                $deleted = $this->model->destroy($movements);
            }
        }

        // Delete a single movement.
        elseif ($query->exists($id))
        {
            $deleted = $this->model->destroy($id);
        }

        return $deleted;
    }

}