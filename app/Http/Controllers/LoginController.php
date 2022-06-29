<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index() {
        return view('login');
    }

    public function submitDetails(Request $request){
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5|max:16'
        ]);
        $email = $request->input('email');
        $password = $request->input('password');
        return 'Email:' .' '. $email.' '. 'and Password:'.' '. $password;
    }
}
