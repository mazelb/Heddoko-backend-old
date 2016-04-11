<?php

namespace App\Repositories;
use App\Models\Group;
use Illuminate\Database\Eloquent\Collection;
use DB;

class GroupRepository extends Repository
{
    /**
     * @var Group
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return Group
     */
    function model()
    {
        return 'App\Models\Group';
    }

    /**
     * @param $userId
     * @param array|null $embed
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    private function byManager($userId, array $embed = null) {
        $model = $this->modelEmbed($embed);

        $query = $model->with(array('managers' => function($query) use($userId) {
            $query->where('manager_id', '=', $userId);
        }));

        return $query;
    }

    /**
     * @param $userId
     * @param array $embed
     * @return mixed
     */
    public function getByManager($userId, array $embed = null) {
        $query = $this->byManager($userId, $embed);

        return $query->get();
    }

    /**
     * @param $id
     * @param array|null $userId
     * @param array $embed
     * @return mixed
     */
    public function findByManager($id, $userId, array $embed = null) {
        $query = $this->byManager($userId, $embed);

        return $query->find($id);
    }
}