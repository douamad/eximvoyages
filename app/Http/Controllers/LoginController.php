<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Sentinel;

class LoginController extends Controller
{

    public function login()
    {
        return view('authentication.login');
    }


    public function postLogin(Request $request)
    {
        $credentials = [
            'email'    => $request['email'],
            'password' => $request['password'],
        ];
        Sentinel::authenticate($credentials);
        if(Sentinel::check())
        {
            return redirect('/');
        }
        else
        {
            return view('authentication.login')->with('message','Utilisateur ou mot de passe incorecte');
        }

    }

    public function logout()
    {
        Sentinel::logout();
        return redirect('/login');
    }

    public function lostPassword()
    {
        return view('authentication.login');
    }


    public function postLostPassword(Request $request)
    {
        //
    }


}
