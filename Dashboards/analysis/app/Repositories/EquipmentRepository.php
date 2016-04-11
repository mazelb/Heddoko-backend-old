<?php

namespace App\Repositories;
use App\Models\Equipment;
use App\Models\Status;
use Illuminate\Database\Eloquent\Collection;
use DB;

class EquipmentRepository extends Repository
{
    /**
     * @var Equipment
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return Equipment
     */
    function model()
    {
        return 'App\Models\Equipment';
    }

    /**
     * Get search for equipment position
     *
     * @param  string $search
     * @return Equipment
     */
    private function searchQuery($search, $status = 0)
    {
        $query = $this->model->with('status', 'material')->orderBy('id', 'desc');

        switch ($status)
        {
            case 0:
                // Retrieve all equipment.
                break;
            default:
                $query->where('status_id', $status);
        }

        $searchVar = strip_tags(trim($search));

        if(strlen($searchVar) > 0) {
            $query->where('serial_no', 'LIKE', '%'. $searchVar .'%')
                ->orWhere('physical_location', 'LIKE', '%'. $searchVar .'%');
        }

        return $query;
    }

    /**
     * Get search count for anatomical position
     *
     * @param  string $search
     * @return Collection
     */
    public function searchCount($search, $status = 0)
    {
        $query = $this->searchQuery($search, $status);

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
    public function search($search, $status = 0, $take = 100, $skip = 0)
    {
        $query = $this->searchQuery($search, $status);

        return $query->skip($skip)->take($take)->get();
    }

    public function setUnavailableStatus($id, $complexEquipmentId) {
        $model = $this->model->findOrFail($id);
        $model->complex_equipment_id = $complexEquipmentId;
        $model->status_id = Status::getByName('unavailable')->id;
        $model->save();
    }

    public function setAvailableStatus($id, $complexEquipmentId) {
        $model = $this->model->findOrFail($id);
        $model->complex_equipment_id = $complexEquipmentId;
        $model->status_id = Status::getByName('available')->id;
        $model->save();
    }
}