<?php
/**
 * @brief   Controller for tags.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    November 2015
 */
namespace App\Http\Controllers;

use App\Repositories\TagRepository;
use Illuminate\Http\Request;

use App\Models\Tag;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     *
     */
    const SEARCH_LIMIT = 100;

    /**
     *
     */
    const ORDER_DIR = 'asc';

    /**
     * The request
     *
     * @var Request
     */
    protected $request;
    /**
     * @var TagRepository
     */
    private $tags;

    /**
     * Constructor.
     *
     * @param \Illuminate\Http\Request $request
     * @param TagRepository $tags
     */
    public function __construct(Request $request, TagRepository $tags)
    {
        $this->request = $request;
        $this->tags = $tags;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $searchTerm = null;
        if ($this->request->has('query')) {
            $searchTerm = trim($this->request->get('query'));
        }

        $offset = max(0, $this->request->get('offset', 0));
        $limit = min(static::SEARCH_LIMIT, $this->request->get('limit', 20));
        $orderDir = $this->request->get('orderDir', static::ORDER_DIR);
        $orderDir = in_array($orderDir, ['asc', 'desc']) ? $orderDir : static::ORDER_DIR;

        return $this->tags->get($searchTerm, 'title', $orderDir, $limit, $offset);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        // Make sure we have a valid title.
        $title = trim($this->request->input('title'));
        if (strlen($title) < 1) {
            return response('Tag Title Too Short.', 400);
        }

        // Make sure tag doesn't already exist.
        $tag = $this->tags->getByTitle($title);
        if ($tag) {
            return response('Tag Already Exists.', 204);
        }

        // Create new tag.
        $tag = $this->tags->create(['title' => $title]);

        return $tag;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tag = $this->tags->find($id);
        if ($tag) {
            return $tag;
        }

        return response('Tag Not Found.', 404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $tag = $this->tags->find($id);
        if (!$tag) {
            return response('Tag Not Found.', 404);
        }

        // Make sure we have a valid title.
        $title = trim($this->request->input('title'));
        if (strlen($title) < 1) {
            return response('Tag Title Too Short.', 400);
        }

        $tag->title = $title;

        if (!$tag->save()) {
            return response('Could not save tag.', 500);
        }

        return $tag;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return $this->tags->delete($id) ? response('', 204) : response('', 500);
    }
}
