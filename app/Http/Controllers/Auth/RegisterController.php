<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class RegisterController extends Controller
{
    use RegistersUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['guest', 'guest:api']);
    }

    /**
     * The user has been registered.
     *
     * @param   \Illuminate\Http\Request    $request
     * @param   \App\Models\User            $user
     *
     * @return  \App\Models\User
     */
    protected function registered(Request $request, User $user)
    {
        // Log the action
        $user->log('registered');

        return response()->json($user);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param   array  $data
     *
     * @return  \Illuminate\Support\Facades\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => 'required|max:255',
            'email' => 'required|email:filter|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param   array  $data
     *
     * @return  \App\Models\User
     */
    protected function create(array $data): User
    {
        $user = User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
        ]);

		return $user;
    }
}
