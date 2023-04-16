<?php

namespace App\Http\Controllers;

use App\Models\Contents;
use App\Models\Category;
use App\Models\Files;
use App\Models\Templates;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Support\Facades\Session as FacadesSession;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Session\Session as SessionSession;

class UsersController extends Controller
{

    public function logout(){

        session()->getHandler()->destroy('username');
        session()->getHandler()->destroy('id_number');
        session()->getHandler()->destroy('first_name');
        session()->getHandler()->destroy('middle_name');
        session()->getHandler()->destroy('last_name');
        session()->getHandler()->destroy('email');

        return view('login')->with('Success message');
    }

}
