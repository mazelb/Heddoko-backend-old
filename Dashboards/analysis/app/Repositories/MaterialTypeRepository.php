<?php

namespace App\Repositories;
use App\Models\MaterialType;
use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use DB;

class MaterialTypeRepository extends Repository
{
    /**
     * @var MaterialType
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return MaterialType
     */
    function model()
    {
        return 'App\Models\MaterialType';
    }

    public function all($columns = array('*')) {
        return $this->model->orderBy('id', 'desc')->get();
    }
}