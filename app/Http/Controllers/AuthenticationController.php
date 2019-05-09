<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function signIn(){
        return view('authentication.signin');
    }

    public function login(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:8'
        ]);

        if(Auth::attempt(['email'=>$request->email, 'password'=>$request->password])){
            return auth()->user();
        }else{
            return response()->json(['errors'=>['email'=>['No user with this email']]],422);
        }
    }

    public function register(Request $request){
        $request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8|confirmed'
        ]);

        $user = User::create([
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        if($user){
            $profile = Profile::create([
                'firstname'=>$request->firstname,
                'lastname'=>$request->lastname,
                'user_id'=>$user->id,
                'gender'=>'unknown'
            ]);

            if($profile){
                $this->login($request);
                return $user;
            }else{
                return response()->json(['errors'=>['email'=>['User was not registered. Try again later.']]],422);
            }
        }
    }
}




















