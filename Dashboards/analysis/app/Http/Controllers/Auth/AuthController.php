<?php
/**
 * Copyright Heddoko(TM) 2015, all rights reserved.
 *
 * @brief   Handles authentication-related http requests.
 * @author  Maxwell (max@heddoko.com) & Francis Amankrah (frank@heddoko.com)
 */
namespace App\Http\Controllers\Auth;

use Validator;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use App\Repositories\UserRepository;

class AuthController extends Controller
{
    use AuthenticatesAndRegistersUsers;

	protected $username = 'username';

    /**
     * The user repository instance.
     *
     * @var UserRepository
     */
    protected $users;


    /**
     * Creates a new authentication controller instance.
     *
     * @param UserRepository $users
     */
    public function __construct(UserRepository $users)
    {
        // Apply the "guest" middleware.
        $this->middleware('guest', ['except' => 'getLogout']);

        // Update the authentication paths.
        $this->loginPath = route('auth.login');
        $this->redirectPath = route('home');
        $this->users = $users;
    }

    /**
     * Gets a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
		return Validator::make($data, [
			'firstName' => 'required|max:100',
			'lastName' => 'required|max:100',
			'email' => 'required|email|max:255',
			'username' => 'required|max:255|unique:users',
			'password' => 'required|confirmed|min:6|max:60',
		]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        $role = User::ROLE_USER;
        switch ($data['role'])
        {
            case 'admin':
                $role = User::ROLE_ADMIN;
                break;

            case 'manager':
                $role = User::ROLE_ANALYST;
                break;
        }

        // Create new user.
		$user = $this->users->create([
			'email' => $data['email'],
			'username' => $data['username'],
			'password' => bcrypt($data['password']),
			'first_name' => $data['firstName'],
			'last_name' => @$data['lastName'],
			'phone' => @$data['phone'],
			'country' => isset($data['country']) ? $data['country'] : 'US',
            'role' => $role
		]);

		return $user;
    }
}
