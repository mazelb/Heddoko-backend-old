<?php

namespace App\Repositories;
use App\Models\AccessToken;
use Illuminate\Database\Eloquent\Collection;
use DB;

class AccessTokenRepository extends Repository
{
    /**
     * @var AccessToken
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return AccessToken
     */
    function model()
    {
        return 'App\Models\AccessToken';
    }

    public function getByToken($token) {
        return $this->model->where('access_token', '=', $token)->first();
    }
}