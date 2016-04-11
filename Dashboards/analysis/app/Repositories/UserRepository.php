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
}