<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('auth:api')->except('logout');
    }

	/**
	 * Get the authenticated user
	 *
	 * @param   Request  $request
	 *
	 * @return  App\Model\User
	 */
    public function get(Request $request)
    {
        return response()->json($request->user());
    }
}
