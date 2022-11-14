<?php

namespace Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\Auth;

use Gdevilbat\SpardaCMS\Modules\Core\Http\Controllers\CoreController as Controller;
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

    public function showLoginForm()
    {
        return view('core::index'); 
    }

    /**
     * Handle account login request
     *
     * @param  LoginRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->getCredentials();

        if (! Auth::validate($credentials)) {
            throw ValidationException::withMessages([
                'username' => [trans('auth.failed')],
            ]);
        }

        Auth::login($user);

        return $this->authenticated($request, $user);
    }

    /**
     * Handle response after user authenticated
     *
     * @param  Request  $request
     * @param  Auth  $user
     * @return \Illuminate\Http\Response
     */
    protected function authenticated(Request $request, $user)
    {
        return response()->json([
            'status' => true,
            'data' => [
                'redirect_url' => $this->redirectTo,
            ],
        ]);
    }

    /**
     * Log out account user.
     *
     * @return \Illuminate\Routing\Redirector
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->regenerate();

        return redirect('admin');
    }
}
