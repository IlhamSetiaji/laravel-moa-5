<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function storeLogin()
    {
        $validator = Validator::make(request()->all(),[
            'email' => 'required|email',
            'password' => 'required|min:8|string',
        ]);
        if($validator->fails())
        {
            return redirect('login')->withInput()->withErrors($validator);
        }
        $user = User::where('email',request('email'))->first();
        if($user)
        {
            if(Hash::check(request('password'),$user->password))
            {
                if($user->hasRole('admin'))
                {
                    Auth::login($user);
                    return redirect('/admin');
                }
                if($user->hasRole('user'))
                {
                    Auth::login($user);
                    return redirect('/');
                }
            }
            return redirect('login')->with('status','Password salah');
        }
        return redirect('login')->with('status','Data email tidak ditemukan');
    }

    public function logout()
    {
        $user = request()->user();
        Auth::logout($user);
        return redirect('login');
    }
}
