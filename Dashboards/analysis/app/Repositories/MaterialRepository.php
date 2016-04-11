<?php

namespace App\Repositories;
use App\Models\Material;
use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use DB;

class MaterialRepository extends Repository
{
    /**
     * @var Material
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return Material
     */
    function model()
    {
        return 'App\Models\Material';
    }

    /**
     * Get search for material
     *
     * @param  string $search
     * @return Material
     */
    private function searchQuery($search)
    {
        $query = $this->model->with('materialType')->orderBy('id', 'desc');

        $searchVar = strip_tags(trim($search));

        if(strlen($searchVar) > 0) {
            $query->where(function($query) use ($searchVar) {
                $query->where('name', 'LIKE', '%'. $searchVar .'%')
                    ->orWhere('part_no', 'LIKE', '%'. $searchVar .'%');
            });
        }

        return $query;
    }

    /**
     * Get search count for material
     *
     * @param  string $search
     * @return Collection
     */
    public function searchCount($search)
    {
        $query = $this->searchQuery($search);

        return $query->count('id');
    }

    /**
     * Get search for material
     *
     * @param  string $search
     * @param  int $take
     * @param  int $skip
     * @return Collection
     */
    public function search($search, $take = 100, $skip = 0)
    {
        $query = $this->searchQuery($search);

        return $query->skip($skip)->take($take)->get();
    }
}