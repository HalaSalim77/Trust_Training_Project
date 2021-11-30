<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
     
    public function register(Request $request)
    {
        $fileds =  $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'name' => $fileds['name'],
            'email' => $fileds['email'],
            'password' => bcrypt($fileds['password']),
        ]);



        $token = $user->createToken('mytestToken')->plainTextToken;
        //this token i should be able to use to access protected routes such as > add new product
        $response = [
            'user' => $user,
            'token' => $token
        ];

        //201 everything created 
        return response($response, 201);
    }

    //login function 
    
    public function login(Request $request)
    {
        $fileds =  $request->validate([
                
                'email' => 'required|string',
                'password' => 'required|string'
            ]);

           //check email 
           $user = User::where('email' , $fileds['email'])->first();

           //check password
           //if doesn't match the password 
           if(!$user || !Hash::check($fileds['password'],  $user->password)){
               //Bad login 
               return response([
                   'message' => 'Bad login , please try again with correct password '
               ] , 401);
           }


        $token = $user->createToken('mytestToken')->plainTextToken;
        //this token i should be able to use to access protected routes such as > add new product
        $response = [
                'user' => $user,
                'token' => $token
            ];

        //201 everything created 
        return response($response, 201);
    }



    //logout function 
    public function logout(Request $request){
      auth()->user()->tokens()->delete();

      return [
             'message' => 'logged Out'
      ];
    }
}
