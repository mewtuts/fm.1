<?php

namespace App\Http\Controllers;

use App\Models\Users;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request){
        if(isset($request->login))
        {
            $users = Users::Select('id', 'username', 'password', 'first_name', 'middle_name', 'last_name', 'email')->where('username', $request->username)->where('password', $request->password)->first();
            if($users)
            {
                session()->put('user_id', $users->id);
                session()->put('username', $users->username);
                session()->put('first_name', $users->first_name);
                session()->put('middle_name', $users->middle_name);
                session()->put('last_name', $users->last_name);
                session()->put('email', $users->email);

                return redirect('users/home');

            }else
            {
                return view('login')->with('error', 'The username you have enter is not registered');
            }

        }else
        {

        }
    }

    public function logout(Request $request)
    {
        $request->session()->forget('user_id');
        $request->session()->forget('username');
        $request->session()->forget('first_name');
        $request->session()->forget('middle_name');
        $request->session()->forget('last_name');
        $request->session()->forget('email');
        $request->session()->forget('template_id');

        return redirect('/');
    }
}
