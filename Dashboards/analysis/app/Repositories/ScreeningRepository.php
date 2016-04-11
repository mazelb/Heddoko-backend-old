<?php

namespace App\Repositories;
use App\Models\Screening;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Illuminate\Database\Query\Builder;

class ScreeningRepository extends Repository
{
    /**
     * @var Screening
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return Screening
     */
    function model()
    {
        return 'App\Models\Screening';
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

        $deleted = false;
        if (strpos($id, ',') !== false)
        {
            $screenings = $query->whereIn('id', explode(',', $id))->pluck('id')->toArray();

            if (count($screenings)) {
                $deleted = $this->model->destroy($screenings);
            }
        }

        // Delete a single screening.
        elseif ($query->exists($id))
        {
            $deleted = $this->model->destroy($id);
        }

        return $deleted;
    }
}