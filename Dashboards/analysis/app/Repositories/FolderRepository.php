<?php

namespace App\Repositories;
use App\Models\Folder;
use App\Models\Role;
use Illuminate\Database\Eloquent\Collection;
use DB;

class FolderRepository extends Repository
{
    /**
     * @var Folder
     */
    protected $model;

    /**
     * Specify Model class name
     *
     * @return Folder
     */
    function model()
    {
        return 'App\Models\Folder';
    }

    /**
     * @param $profileId
     * @param $folderId
     * @return mixed
     */
    public function getByProfile($profileId, $folderId) {
        return $this->model->where('profile_id', '=', $profileId)->find($folderId);
    }

    public function getByProfileAndSystemName($profileId) {
        return $this->model->where('profile_id', '=', $profileId)->where('system_name', 'screenings')->first();
    }

    /**
     * @param $profileIDs
     * @param $folderId
     * @return bool|int
     */
    public function deleteByProfile($profileIDs, $folderId) {
        $builder = $this->model->whereIn('profile_id', $profileIDs);

        $deleted = false;
        if (strpos($folderId, ',') !== false)
        {
            $folders = $builder->whereIn('id', explode(',', $folderId))->pluck('id')->toArray();

            if (count($folders)) {
                $deleted = $this->model->destroy($folders);
            }
        }

        // Delete a single folder.
        elseif ($builder->exists($folderId))
        {
            $deleted = $this->model->destroy($folderId);
        }

        return $deleted;
    }
}