<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
//use Session;
use Illuminate\Support\Facades\Hash as FacadesHash;
use Illuminate\Support\Facades\Session as FacadesSession;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }  
    public function createSignin(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('dashboard')
                        ->withSuccess('Logged-in');
        }
        return redirect("login")->withSuccess('Credentials are wrong.');
    }


    public function signup()
    {
        return view('auth.register');
    }
      

    public function customSignup(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'surname' => 'required',
            'user' => 'required ',
            //'email' => 'required|email|',
            'password' => 'required|min:6',
        ]);
        $data = $request->all();
        $check = $this->createUser($data);
        return redirect("dashboard")->withSuccess('Successfully logged-in!');
    }


    public function createUser(array $data)
    {
      return User::create([
        'USU_NOMBRES' => $data['name'],
        'USU_APELLIDOS' => $data['surname'],
        'USU_USUARIO' => $data['user'],
        'USU_CONTRASENIA' => $data['password'],
        'USU_ESTADO' => 'ACTIVO',
        'USU_CARGO' => '-',
        'USU_TIPO' => 'NORMAL',
        'username' => $data['user'],
        'password' => FacadesHash::make($data['password'])
      ]);
    }    

    /*
    
        'USU_NOMBRES',
        'USU_APELLIDOS',
        'USU_USUARIO',
        'USU_CONTRASENIA',
        'USU_CARGO',
        'USU_ESTADO',
        'USU_TIPO',
        'username',
        'password',
        
    
    */
    

    public function dashboardView()
    {
        if(Auth::check()){
            return view('index');
        }
        return redirect("login")->withSuccess('Access is not permitted');
    }
    

    public function logout() {
        FacadesSession::flush();
        Auth::logout();
        return Redirect('login');
    }



}
