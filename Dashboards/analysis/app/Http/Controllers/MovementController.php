<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles http requests for movement data.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    November 2015
 */
namespace App\Http\Controllers;

use App\Repositories\MovementMetaRepository;
use App\Repositories\MovementRepository;
use App\Repositories\ProfileRepository;
use App\Repositories\ScreeningRepository;
use DB;
use Auth;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Profile;
use App\Models\Movement;
use App\Models\Screening;
use App\Models\MovementMeta;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class MovementController extends Controller
{
    CONST SEARCH_LIMIT = 50;

    /**
     * The request
     *
     * @var Request
     */
    protected $request;
    /**
     * @var MovementRepository
     */
    private $movements;
    /**
     * @var ProfileRepository
     */
    private $profiles;
    /**
     * @var MovementMetaRepository
     */
    private $movementMetas;
    /**
     * @var ScreeningRepository
     */
    private $screenings;

    /**
     * @param \Illuminate\Http\Request $request
     * @param MovementRepository $movements
     * @param ProfileRepository $profiles
     * @param MovementMetaRepository $movementMetas
     * @param ScreeningRepository $screenings
     */
    public function __construct(Request $request,
                                MovementRepository $movements,
                                ProfileRepository $profiles,
                                MovementMetaRepository $movementMetas,
                                ScreeningRepository $screenings)
    {
        $this->request = $request;
        $this->movements = $movements;
        $this->profiles = $profiles;
        $this->movementMetas = $movementMetas;
        $this->screenings = $screenings;
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
        $profileIds = null;

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
            $profileIds = Auth::user()->getProfileIDs();
        }

        // Search parameters.
        $limit = max(0, min(static::SEARCH_LIMIT, $this->request->input('limit', 20)));
        $offset = max(0, $this->request->input('offset', 0));
        $orderBy = snake_case($this->request->get('orderBy', 'createdAt'));
        $orderBy = in_array($orderBy, ['title', 'created_at', 'updated_at']) ? $orderBy : 'created_at';
        $orderDir = $this->request->get('orderDir', 'desc');
        $orderDir = in_array($orderDir, ['asc', 'desc']) ? $orderDir : 'desc';

        $count = $this->movements->countByProfile($profileId, $profileIds);
        $results = $this->movements->getByProfile($profileId, $profileIds, $orderBy, $orderDir, $limit, $offset);
        return [
            'total' => $count,
            'offset' => $offset,
            'limit' => $limit,
            'results' => $results
        ];
    }

    /**
     * Stores a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        // Retrieve profile this movement belongs to.
        $profileId = (int) $this->request->input('profileId');
        if (!$profileId) {
            return response('Invalid Profile ID.', 400);
        }

        $profile = $this->profiles->getByUser(Auth::id(), $profileId);
        if (!$profile) {
            return response('Profile Not Found.', 400);
        }

        // Make sure we have a file to work with.
        if (!$original = $this->request->file('file')) {
            return response('No File Received.', 400);
        }

        // Quickly check the MIME type.
        elseif (!preg_match('#^text/(csv|plain)$#', $original->getMimeType())) {
            return response('Invalid MIME Type ('. $original->getMimeType() .').', 400);
        }

        // Extract raw data.
        $title = $original->getClientOriginalName();
        $data = file_get_contents($original->getRealPath());

        // Create the database record.
        $movement = $this->movements->create([
            'submitted_by' => Auth::id(),
            'profile_id' => $profileId,
            'title' => $title
        ]);

        // TODO: save raw data.

        // TODO: save frame data.

        return $movement;
    }

    /**
     * Displays the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        // Retrieve list of relations and attributes to append to results.
        $embed = $this->getEmbedArrays(
            $this->request->get('embed'),
            Movement::$appendable
        );

        // Make sure we have a valid movement.
        $movement = $this->movements->getById($id, Auth::user()->getProfileIDs(), $embed['relations']);
        if (!$movement) {
            return response('Movement Not Found.', 404);
        }

        // Append attributes.
        if (count($embed['attributes']))
        {
            foreach ($embed['attributes'] as $accessor)
            {
                $movement->setAttribute($accessor, $movement->$accessor);
            }
        }

        return $movement;
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
        $movement = $this->movements->getById($id, Auth::user()->getProfileIDs());
        if (!$movement) {
            return response('Movement Not Found.', 404);
        }

        // Main details.
        if ($this->request->has('title')) {
            $movement->title = $this->request->input('title');
        }

        $movement->save();

        // Save movement meta.
        if ($this->request->has('meta'))
        {
            // Retrieve meta object.
            $newMetaData = (array) $this->request->input('meta');
            $metaAttributes = [
                'startFrame',
                'endFrame',
                'score',
                'scoreMin',
                'scoreMax',
                'notes',
                'data',
                'movement_id'
            ];

            $newMetaData['movement_id'] = $movement->id;

            // Create meta data.
            if (!$movement->meta)
            {
                $this->movementMetas->create(array_only($newMetaData, $metaAttributes));
            }

            else
            {
                $metaData = $this->movementMetas->find($movement->meta->id);

                foreach ($metaAttributes as $attribute) {
                    if (array_has($newMetaData, $attribute)) {
                        $metaData->$attribute = $newMetaData[$attribute];
                    }
                }

                $metaData->save();
            }

            // If a score was updated, and the movement belongs to a screening, we'll update the
            // screening score as well.
            if (array_has($newMetaData, 'score') && $movement->screeningId > 0)
            {
                $screening = $this->screenings->find($movement->screeningId, ['movements.meta']);
                if($screening) {
                    $score = 0;
                    foreach ($screening->movements as $test) {
                        $score += $test->meta->score;
                    }

                    $screening->score = $score;
                    $screening->save();
                }
            }
        }

        // TODO: save movement markers.
        // ...

        // TODO: save movement events.
        // ...

        // Attach or create tags.
        if ($this->request->has('tags') || $this->request->has('tagIds'))
        {
            $movement->saveTags(
                $this->request->input('tags', []),
                $this->request->input('tagIds', [])
            );
        }

        // TODO: save folder changes.
        // ...

        // TODO: save aggregate data.
        // ...

        // TODO: save movement frames.
        // ...

        // Retrieve list of relations and attributes to append to results.
        $embed = $this->getEmbedArrays(
            $this->request->get('embed'),
            Movement::$appendable
        );

        // Return updated model.
        $updated = $this->movements->find($movement->id, $embed['relations']);
        
        // Append attributes.
        if (count($embed['attributes']))
        {
            foreach ($embed['attributes'] as $accessor)
            {
                $updated->setAttribute($accessor, $updated->$accessor);
            }
        }

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
        $deleted = $this->movements->destroy($id, Auth::user()->getProfileIDs());

        return $deleted ? response('', 204) : response('', 500);
    }
}
