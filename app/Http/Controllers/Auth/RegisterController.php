<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{

    public function __construct(){
        $this->middleware('guest');
    }

    public function registerForm(){
        return view('auth.register');
    }

    protected function register(Request $request){

        $v = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($v->fails()) {
            return redirect()->back()->withErrors($v->errors());
        }
        else{
            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
            ]);
            $user->assignRole('user');
            return redirect('/')->with('success', "You are registered");
        }
    }
}
