<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //
    public function register(Request $request ){
        $incoming_fields = $request->validate( [
            'username' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]
        );

        User::create($incoming_fields);
        return "<h1>Registered</h1>";
    }
}
