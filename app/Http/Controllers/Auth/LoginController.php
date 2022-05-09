<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware(['guest', 'guest:api'])->except('logout');
    }

    /**
     * Attempt to log the user into the application.
     *
	 * @param   \Illuminate\Http\Request  $request
     *
     * @return  bool
     */
    protected function attemptLogin(Request $request): bool
    {
        $token = $this->guard()->attempt($this->credentials($request));

        if (! $token) {
            return false;
        }

        $user = $this->guard()->user();

        // Log the action
        $user->log('login');

		// Set the token
        $this->guard()->setToken($token);

        return true;
    }

    /**
     * Send the response after the user was authenticated.
     *
	 * @param   \Illuminate\Http\Request  $request
     *
     * @return  json
     */
    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);

        $token = (string) $this->guard()->getToken();
        $expiration = $this->guard()->getPayload()->get('exp');

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiration - time(),
        ]);
    }

    /**
     * Get the failed login response instance.
     *
	 * @param   \Illuminate\Http\Request  $request
     *
     * @return  \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        $user = $this->guard()->user();

        throw ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Log the user out of the application.
     *
	 * @param   \Illuminate\Http\Request  $request
     *
     * @return  json
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        return response()->json(null, 204);
    }
}
