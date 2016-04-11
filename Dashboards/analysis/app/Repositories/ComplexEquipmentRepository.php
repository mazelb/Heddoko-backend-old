<?php

namespace App\Repositories;
use App\Models\ComplexEquipment;
use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use DB;

class ComplexEquipmentRepository extends Repository
{
    /**
     * @var ComplexEquipment
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return ComplexEquipment
     */
    function model()
    {
        return 'App\Models\ComplexEquipment';
    }

    /**
     * Get search for anatomical position
     *
     * @param  string $search
     * @return ComplexEquipment
     */
    private function searchQuery($search)
    {
        $query = DB::table('complex_equipment')
            ->select('complex_equipment.id')
            ->leftJoin('equipment', 'complex_equipment.id', '=', 'equipment.complex_equipment_id')
            ->orderBy('complex_equipment.id', 'desc')
            ->distinct();

        $searchVar = strip_tags(trim($search));

        if(strlen($searchVar) > 0) {
            $query->where('equipment.serial_no', 'LIKE', '%'. $searchVar .'%')
                ->orWhere('equipment.physical_location', 'LIKE', '%'. $searchVar .'%');
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

        return $query->count('complex_equipment.id');
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

        $ids = $query->skip($skip)->take($take)->lists('id');

        return $this->model->with('equipment.material')->whereIn('id', $ids)->orderBy('id', 'desc')->get();
    }
}