<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employer;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Models\Student;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    } 

    protected function validator_v2(array $data)
    {
        return Validator::make($data, [
            'code' => ['required', 'string', 'max:50'],
            'fullname' => ['required', 'string', 'email', 'max:255', 'unique:students,login'],
            'password' => ['required', 'string', 'min:6']
        ], [
            'code.max' => 'Код реєстрації не може бути більше 50 символів',
            'fullname.email' => 'Поле логін має містити адресу електронної пошти',
            'fullname.max' => 'Адреса електронної пошти занадто довга',
            'fullname.unique' => 'Користувач із такою адресою електронної пошти вже зареєстрований',
            'password.min' => 'Пароль має бути не меншим за 6 символів'
        ]);
    } 

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function postRegister(Request $request)
    {
        $validator = $this->validator_v2($request->all()); // ВОЗМОЖНА ОШИБКА
        $role = $request['role'];
        if ($validator->fails()) {          
            return Redirect::back()->withErrors($validator)->withInput();
        };
        try
        {
            switch ($role){
                case 'Teacher':
                     $var_user = Employer::where('registry_code', $request['code'])->firstOrFail(); // ВОЗМОЖНА ОШИБКА
                    break;
                case 'Student':
                     $var_user = Student::where('registry_code', $request['code'])->firstOrFail(); // ВОЗМОЖНА ОШИБКА
                    break;
            }

        }
        catch(ModelNotFoundException $exception) {
            return Redirect::back()->withErrors(['code' => 'Хибний код реєстрації'])->withInput();
        }
        if( $var_user->is_registered == 1) // ВОЗМОЖНА ОШИБКА
        {
            return Redirect::back()->withErrors(['code' => 'Користувач з таким кодом вже зареєстрований'])->withInput();    
        }
         $var_user->update(['password' => Hash::make($request['password']), 'login' => $request['fullname'], 'is_registered' => 1]);
        return redirect()->route('login');
    }
}
