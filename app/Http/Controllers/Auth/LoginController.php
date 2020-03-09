<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {
        return view('auth.login');
    }



    public function signIn(Request $request)
    {
        $data = Validator::make($request->all(), [
            'login' => 'required|email',
            'password' => 'required'
        ]);

        if($data->fails() == false){
            if(Auth::guard($request->role)->attempt(['login' => $request->login, 'password' => $request->password])){
                return redirect()->route($request->role.'.index');
            }else{
                return redirect()->back()->withErrors(['password'=>'Невірний логін або пароль']);
            }
        }else{
            return redirect()->back()->withErrors(['login'=>'Поле логін має містити адресу електронної пошти']);
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        $request->session()->flush();

        return redirect()->route('login.index');
    }
}

