<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller


{


      
   public function login(Request $request){
    $incoming_fields = $request -> validate(
        ['loginusername' => 'required',
        'loginpassword' => 'required']
    );

    if(auth()->attempt(['username'=> $incoming_fields['loginusername'], 'password'=>$incoming_fields['loginpassword']])){


         $request->session()->regenarate();
         return '<h1>Success</h1>';
    
    }


    else{
       return '<h1>Sorry</h1>';
    }
}
   
    //
    public function register(Request $request ){
        $incoming_fields = $request->validate( [
            'username' => ['required', 'min:3', 'max:20', Rule::unique('users', 'username')],
            'email' => ['required', 'email',Rule::unique('users', 'email')],
            'password' => ['required','min:6', 'max:10', ]
        ]
        );

        $incoming_fields['password'] =  bcrypt( $incoming_fields['password'] );

        User::create($incoming_fields);
        return "<h1>Registered</h1>";
    }
}
