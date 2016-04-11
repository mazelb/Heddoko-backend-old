<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles user actions.
 * @author  Francis Amankrah (frank@heddoko.com)
 * @date    November 2015
 */
namespace App\Http\Controllers;

use App\Repositories\AccessTokenRepository;
use Auth;
use Hash;
use Image;
use Validator;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;

class DesktopController extends Controller
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
     * @var AccessTokenRepository
     */
    private $tokens;

    /**
     * @param \Illuminate\Http\Request $request
     * @param  UserRepository $users
     * @param AccessTokenRepository $tokens
     */
    public function __construct(Request $request,
                                UserRepository $users,
                                AccessTokenRepository $tokens)
    {
        $this->request = $request;
        $this->users = $users;
        $this->tokens = $tokens;
    }


    /**
     * @return \Illuminate\Database\Eloquent\Model|static
     */
    public function signin()
    {

        $this->validate($this->request, [
            'username' => 'string|required|max:255',
            'password' => 'string|required|min:6|max:60'
        ]);

        $data = $this->request->all();
        $user = $this->users->first($data['username'], 'username');
        if(Hash::check($data['password'], $user->password)) {
            $token = $this->tokens->create([
                "user_id" => $user->id,
                "access_token" => md5($user->id . time())
            ]);
        } else {
            abort(403);
        }

		return $token->access_token;
    }

    public function check()
    {
        $this->validate($this->request, [
            'token' => 'string|required|max:100'
        ]);

        $data = $this->request->all();
        $token = $this->tokens->getByToken($data['token']);

        return $token->user;
    }
}
