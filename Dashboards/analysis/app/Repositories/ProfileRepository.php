<?php

namespace App\Repositories;
use App\Models\Profile;
use Illuminate\Database\Eloquent\Collection;
use DB;

class ProfileRepository extends Repository
{
    /**
     * @var Profile
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return Profile
     */
    function model()
    {
        return 'App\Models\Profile';
    }

    /**
     * @param $userID
     * @param $profileID
     * @return mixed
     */
    public function getByUser($userID, $profileID, array $embed = null) {
        $model = $this->modelEmbed($embed);
        $query = $model->with(array('managers' => function($query) use($userID) {
            $query->where('manager_id', '=', $userID);
        }));

        return $query->find($profileID);
    }

    /**
     * @param $userID
     * @param array|null $embed
     * @return Collection|static[]
     */
    public function getByUserAll($userID, array $embed = null) {
        $model = $this->modelEmbed($embed);
        $query = $model->with(array('managers' => function($query) use($userID) {
            $query->where('manager_id', '=', $userID);
        }));

        return $query->get();
    }

    /**
     * @param $userID
     * @param $groupId
     * @param array $embed
     * @return mixed
     */
    public function getByGroups($userID, $groupId, array $embed = null) {
        $model = $this->modelEmbed($embed);

        $query = $model->with(array(
            'managers' => function($query) use($userID) {
                $query->where('manager_id', '=', $userID);
            },
            'groups' => function($query) use($groupId) {
                $query->where('group_id', '=', $groupId);
            })
        );

        return $query->get();
    }
}