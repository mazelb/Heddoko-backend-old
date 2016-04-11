<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles user actions.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    November 2015
 */
namespace App\Http\Controllers;

use Auth;
use Image;
use Validator;

use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;


    /**
     * The request instance.
     *
     * @var Request
     */
    protected $request;

    /**
     * @param \Illuminate\Http\Request $request
     * @param  UserRepository  $users
     */
    public function __construct(Request $request, UserRepository $users)
    {
        $this->request = $request;
        $this->users = $users;
    }

    /**
     * Stores a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $validator = Validator::make($this->request->all(), [
			'firstName' => 'required|max:100',
			'lastName' => 'required|max:100',
			'email' => 'required|email|max:255',
			'username' => 'required|max:255|unique:users',
			'password' => 'required|confirmed|min:6|max:60',
		]);

        if ($validator->fails()) {
            return response($validator->errors()->first(), 400);
        }

        // Create new user.
        $data = $this->request->all();
		$user = $this->users->create([
			'email' => $data['email'],
			'username' => $data['username'],
			'password' => bcrypt($data['password']),
			'firstName' => $data['firstName'],
			'lastName' => $data['lastName'],
			'phone' => @$data['phone'],
			'country' => isset($data['country']) ? $data['country'] : 'US',
            'role' => User::ROLE_ANALYST
		]);

		return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        if (!$user = $this->getUser($id)) {
            return response('User Not Found.', 404);
        }

        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        if (!$user = $this->getUser($id)) {
            return response('User Not Found.', 404);
        }

        $data = $this->request->all();

        $this->users->update(array_only($data, [
            'username',
            'firstName',
            'lastName',
            'phone',
            'email'
        ]), $id);


        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!$user = $this->getUser($id)) {
            return response('User Not Found.', 404);
        }

        // Delete avatar.
        if ($user->avatar) {
            $user->avatar->delete();
        }

        // Delete user.
       $this->users->delete($id);

        // Return status code "204 No Content"
        return response('User Successfully Deleted.', 204);
    }

    /**
     * Saves the avatar for a user.
     *
     * @param mixed $id
     * @return array
     */
    public function saveAvatar($id)
    {
        if (!$user = $this->getUser($id)) {
            return response('User Not Found.', 404);
        }

        // Check image.
        if (!$original = $this->request->file('image')) {
            return response('No File Received.', 400);
        } elseif (!preg_match('#^(image/[a-z]+)$#', $original->getMimeType())) {
            return response('Invalid MIME type.', 400);
        }

        // Delete previous avatar.
        if ($user->avatar) {
            $user->avatar->delete();
        }

        // Save avatar data.
        $avatar = $user->avatar()->create([
            'data_uri' => base64_encode(file_get_contents($original->getRealPath())),
            'mime_type' => $original->getMimeType()
        ]);

        return [
            'user' => $user,
            'avatar' => $avatar,
            'avatar_src' => $avatar->src
        ];
    }

    /**
     * Removes the user's avatar
     * @param $id
     * @return User|null
     */
    public function destroyAvatar($id)
    {
        if (!$user = $this->getUser($id)) {
            return response('User Not Found.', 404);
        }

        // Delete avatar.
        $user->avatar()->delete();

        return $user;
    }

    /**
     * Shortcut to retrieve user object.
     *
     * @param int|string $id    Either an integer identifying the user or an MD5 hash of the ID.
     * @param array $embed      List of relations to embed with the user object.
     * @return \App\Models\User|null
     */
    private function getUser($id, array $embed = ['avatar'])
    {
        // If the ID is a hash, assume we're trying to retrieve data for the currently
        // authenticated user.
        if (!is_numeric($id) && $id == md5(Auth::id())) {
            $id = Auth::id();
        }

        // Else, find the user by ID.
        return $this->users->find($id, $embed);
    }
}
