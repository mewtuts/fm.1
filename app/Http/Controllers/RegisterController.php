<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Users;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function register(Request $request){
        
        $request->validate([
            'id_number' => 'required|unique:users',
            'first_name' => 'required',
            'middle_name' => 'required',
            'last_name' => 'required',
            'username' => 'required',
            'email' => 'required|email:rfc,dns',
            'password' => 'required'
        ]);

            $users = new Users();
            $users->id_number = $request->id_number;
            $users->first_name = $request->first_name;
            $users->middle_name = $request->middle_name;
            $users->last_name = $request->last_name;
            $users->username = $request->username;
            $users->email = $request->email;
            $users->password = $request->password;
            if(!$users->save()){
                return redirect('/register')->with('message', 'Something went wrong!');
            } else {
                return redirect('/register')->with('message', 'Your registration was successful. Click ');
            }
    }
}
