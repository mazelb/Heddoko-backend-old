<?php

namespace App\Repositories;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use DB;

class UserRepository extends Repository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return User
     */
    function model()
    {
        return 'App\Models\User';
    }


    public function count($search = null) {
        $query = $this->model;

        if($search) {
            $query->where('name', 'like', '%'. $search .'%');
        }

        return $query->count();
    }

    public function get($search = null, $orderBy = 'username', $orderDir = 'desc', $take = 20, $skip = 0) {
        $query = $this->model;

        if($search) {
            $query->where('username', 'like', '%'. $search .'%');
        }

        return $query->orderBy($orderBy, $orderDir)->skip($skip)->take($take)->get();
    }
}