<?php

namespace App\Repositories;
use App\Models\AnatomicalPosition;
use Illuminate\Database\Eloquent\Collection;

class AnatomicalPositionRepository extends Repository
{
    /**
     * @var AnatomicalPosition
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    function model()
    {
        return 'App\Models\AnatomicalPosition';
    }

    /**
     * Get search for anatomical position
     *
     * @param  string $search
     * @return AnatomicalPosition
     */
    private function searchQuery($search)
    {

        $query = $this->model->orderBy('id', 'desc');

        $searchVar = strip_tags(trim($search));

        if(strlen($searchVar) > 0) {
            $query->where('name', 'LIKE', '%'. $searchVar .'%');
        }

        return $query;
    }

    /**
     * Get search count for anatomical position
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
     * Get search for anatomical position
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