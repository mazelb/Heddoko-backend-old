<?php

namespace App\Repositories;
use App\Models\ProfileMeta;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Illuminate\Database\Query\Builder;

class ProfileMetaRepository extends Repository
{
    /**
     * @var ProfileMeta
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return ProfileMeta
     */
    function model()
    {
        return 'App\Models\ProfileMeta';
    }
}