<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'username'; // Replace 'username' with your desired field
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        // Determine the field name
        $field = $this->getLoginField($request->username);

        return [
            $field => $request->username,
            "password" => $request->password
        ];
    }

    /**
     * Dynamically identify the login field (username, email, or contact).
     *
     * @param  string  $input
     * @return string
     */
    protected function getLoginField($input)
    {
        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return 'email';
        } elseif (is_numeric($input)) {
            return 'contact';
        } else {
            return 'username';
        }
    }
}
