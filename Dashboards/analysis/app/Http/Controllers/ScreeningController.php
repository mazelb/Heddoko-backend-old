<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles screening-related http requests.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    December 2015
 */
namespace App\Http\Controllers;

use App\Repositories\FolderRepository;
use App\Repositories\MovementRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\ScreeningRepository;
use Auth;

use App\Http\Requests;
use App\Models\Folder;
use App\Models\Profile;
use App\Models\Movement;
use App\Models\MovementMeta;
use App\Models\Screening;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class ScreeningController extends Controller
{
    CONST SEARCH_LIMIT = 20;

    /**
     * The request
     *
     * @var Request
     */
    protected $request;
    /**
     * @var ScreeningRepository
     */
    private $screenings;
    /**
     * @var ProfileRepository
     */
    private $profiles;
    /**
     * @var FolderRepository
     */
    private $folders;
    /**
     * @var MovementRepository
     */
    private $movements;

    /**
     *
     *
     * @param \Illuminate\Http\Request $request
     * @param ProfileRepository $profiles
     * @param FolderRepository $folders
     * @param ScreeningRepository $screenings
     * @param MovementRepository $movements
     */
    public function __construct(Request $request,
                                ProfileRepository $profiles,
                                FolderRepository $folders,
                                ScreeningRepository $screenings,
                                MovementRepository $movements)
    {
        $this->request = $request;
        $this->screenings = $screenings;
        $this->profiles = $profiles;
        $this->folders = $folders;
        $this->movements = $movements;
    }

    /**
     * Displays a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        // Profile-based query builder.
        $profileId = null;
        $profileIDs = null;

        if ($this->request->has('profileId'))
        {
            $profileId = (int) $this->request->input('profileId');

            $profile = $this->profiles->getByUser(Auth::id(), $profileId);

            if (!$profile) {
                return response('Profile Not Found.', 400);
            }
        }

        // General query builder. We will limit the accessible scope to the profiles managed
        // by the authenticated user.
        else
        {
            $profileIDs = Auth::user()->getProfileIDs();
        }

        // Retrieve other search parameters. We\ll also make sure we have positive values
        // for "limit" and "offset".
        $limit = max(0, min(static::SEARCH_LIMIT, $this->request->input('limit', 20)));
        $offset = max(0, $this->request->input('offset', 0));
        $orderBy = snake_case($this->request->get('orderBy', 'createdAt'));
        $orderBy = in_array($orderBy, ['title', 'created_at', 'updated_at']) ? $orderBy : 'created_at';
        $orderDir = $this->request->get('orderDir', 'desc');
        $orderDir = in_array($orderDir, ['asc', 'desc']) ? $orderDir : 'desc';

        // Add search query.
        // TODO...

        $count = $this->screenings->countByProfile($profileId, $profileIDs);
        $results = $this->screenings->getByProfile($profileId, $profileIDs, $orderBy, $orderDir, $limit, $offset);

        return [
            'total' => $count,
            'offset' => $offset,
            'limit' => $limit,
            'results' => $results
        ];
    }

    /**
     * Creates a new screening.
     *
     * @return Response
     */
    public function store()
    {
        // Performance check.
        $profileId = (int) $this->request->input('profileId');
        if (!$profileId) {
            return response('Invalid Profile ID.', 400);
        }

        $profile = $this->profiles->getByUser(Auth::id(), $profileId);
        if (!$profile) {
            return response('Profile Not Found.', 400);
        }

        // Validate incoming data.
        $this->validate($this->request, [
            'title' => 'string|min:1|max:255',
            'score'  => 'int|between:-100,100',
            'scoreMin'  => 'int|between:-100,100',
            'scoreMax'  => 'int|between:-100,100',
            'notes'  => 'string',
            'meta'  => '',
        ]);

        // Retrieve screening details.
        $details = $this->request->only([
            'title',
            'score',
            'scoreMin',
            'scoreMax',
            'notes'
        ]);
        if (strlen(trim($details['title'])) < 1) {
            $details['title'] = 'Functional Movement Test - '. date('M j, Y');
        }

        // Add some defaults.
        $details['meta'] = [
            'isComplete' => false
        ];
        $details['profile_id'] = $profile->id;
        // Create a record for the screening.
        $screening = $this->screenings->create($details);

        if (!$screening) {
            return response('An Error Occurred.', 500);
        }
        // We'll also create a folder to organize the screening movements, if one doesn't already
        // exist.
        $screeningsFolder = $this->folders->getByProfileAndSystemName($profileId);
        if (!$screeningsFolder)
        {
            $screeningsFolder = $this->folders->create([
                'name' => 'Movement Tests',
                'system_name' => 'screenings',
                'path' => '/',
                'profile_id' => $profile->id
            ]);
        }

        $folder = $this->folders->create([
            'parent_id' => $screeningsFolder->id,
            'name' => $screening->title .' - '. date('M j, Y'),
            'system_name' => 'screenings.'. $screening->id,
            'path' => '/'. $screeningsFolder->name,
            'profile_id' => $profile->id
        ]);

        // Add movement data, if any.
        if ($this->request->has('movements'))
        {
            $movements = (array) $this->request->input('movements');

            foreach ($movements as $data)
            {
                $movement = new Movement(array_only($data, ['title']));
                $movement->profileId = $screening->profileId;
                $movement->folderId = $folder->id;
                $movement->screeningId = $screening->id;

                // Update metadata.
                $movement->save();
                $meta = isset($data['meta']) ? (array) $data['meta'] : [];
                $meta['scoreMin'] = $screening->scoreMin;
                $meta['scoreMax'] = $screening->scoreMax;
                $movement->meta()->create($meta);
            }
        }

        // Retrieve list of relations and attributes to append to results.
        $embed = $this->getEmbedArrays(
            $this->request->get('embed'),
            Screening::$appendable
        );

        // Return updated model.
        $updated = $this->screenings->find($screening->id, $embed['relations']);

        return $updated;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Performance check.
        $id = (int) $id;
        if ($id < 1) {
            return response('Invalid Screening ID.', 400);
        }

        $embed = $this->getEmbedArrays(
            $this->request->get('embed'),
            Screening::$appendable
        );

        $screening = $this->screenings->getById($id, Auth::user()->getProfileIDs(), $embed['relations']);

        if (!$screening) {
            return response('Screening Not Found.', 404);
        }

        return $screening;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // Performance check.
        $screening = $this->screenings->getById($id, Auth::user()->getProfileIDs());
        if (!$screening) {
            return response('Screening Not Found.', 400);
        }

        // Validate incoming data.
        $this->validate($this->request, [
            'title' => 'string|min:1|max:255',
            'score'  => 'int|between:-100,100',
            'scoreMin'  => 'int|between:-100,100',
            'scoreMax'  => 'int|between:-100,100',
            'notes'  => 'string|max:65,535',
            'meta'  => 'json',
            'movement.title' => '',
        ]);

        // Update primary screening details.
        foreach (['title', 'score', 'scoreMin', 'scoreMax', 'notes'] as $attribute) {
            if ($this->request->has($attribute)) {
                $screening->$attribute = $this->request->input($attribute);
            }
        }

        // Save screening.
        if (!$screening->save()) {
            return response('Could not save screening data.', 500);
        }

        // Retrieve list of relations and attributes to append to results.
        $embed = $this->getEmbedArrays(
            $this->request->get('embed'),
            Screening::$appendable
        );

        // Return updated model.
        $updated = $this->screenings->find($screening->id, $embed['relations']);

        return $updated;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = $this->screenings->destroy($id, Auth::user()->getProfileIDs());

        return $deleted ? response('', 204) : response('', 500);
    }
}
