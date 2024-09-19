<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        // $this->middleware('auth')->only('logout');
    }

    public function username()
    {
        $login = request()->input('email');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        request()->merge([$field => $login]);
        return $field;
    }

    public function index(Request $request)
    {
        try {
            return view('auth.index');
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return view('errors.message', ['message' => $this->response]);
        }
    }

    public function login(Request $request)
    {
        try {
            $login = request()->input('username');
            $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt([$field => $login, 'password' => $request->password])) {
                Helper::menu();
                return redirect()->route('admin');
            } else {
                return redirect()->back();
            }
        } catch (\Exception $e) {
            $this->response['message'] = $e->getMessage() . ' in file :' . $e->getFile() . ' line: ' . $e->getLine();
            return view('errors.message', ['message' => $this->response]);
        }
    }

    public function logout(Request $request)
    {
        // $roles = auth()->user()->id_role;
        $this->guard()->logout();
        $request->session()->invalidate();
        // if ($roles == 3) {
        //     return $this->loggedOut($request) ?: redirect('/login');
        // } else {
        return $this->loggedOut($request) ?: redirect('/');
        // }
    }
}
