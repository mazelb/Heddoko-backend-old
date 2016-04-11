<?php

namespace App\Repositories;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use DB;
use Illuminate\Database\Query\Builder;

class TagRepository extends Repository
{
    /**
     * @var Tag
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return Tag
     */
    function model()
    {
        return 'App\Models\Tag';
    }

    public function get($search = null, $orderBy = 'title', $orderDir = 'desc', $take = 20, $skip = 0) {
        $query = $this->model;

        if($search) {
            $query->where('title', 'like', '%'. $search .'%');
        }

        return $query->orderBy($orderBy, $orderDir)->skip($skip)->take($take)->get();
    }

    public function getByTitle($title) {
        return $this->model->where('title', '=', $title)->first();
    }
}