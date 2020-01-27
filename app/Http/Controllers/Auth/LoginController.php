<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

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
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'email'],
            'password' => ['required', 'string']
        ], [
            'fullname.email' => 'Поле логін має містити адресу електронної пошти',
        ]);
    }

    public function postLogin(Request $request)
    {
        $validator = $this->validator($request->all()); // ВОЗМОЖНА ОШИБКА
        if ($validator->fails()) {          
            return Redirect::back()->withErrors($validator)->withInput();
        };
        if (Auth::guard('student')->attempt(['login' => $request->fullname, 'password' => $request->password])){
            return 'Пользователь вошел, все гут';
        }
        return Redirect::back()->withErrors(['password' => 'Невірний логін або пароль'])->withInput(); 
    }

    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('login');
    }
}

