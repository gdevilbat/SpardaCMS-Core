<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController as Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/control/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('core.guest')->except(['logout', 'isLogin']);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('core::auth.login');
    }

    public function isLogin()
    {
        if(\Auth::check())
            return response()->json(['status' => true], 200);

        return response()->json(['status' => false], 403);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->regenerate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
