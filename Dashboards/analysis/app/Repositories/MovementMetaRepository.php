<?php

namespace App\Repositories;
use App\Models\MovementMeta;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Illuminate\Database\Query\Builder;

class MovementMetaRepository extends Repository
{
    /**
     * @var MovementMeta
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return MovementMeta
     */
    function model()
    {
        return 'App\Models\MovementMeta';
    }
}