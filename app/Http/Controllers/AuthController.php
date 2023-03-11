<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function signup(Request $request)
    {
//        dd($request->all());

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|max:36|same:re_password',
            'username' => 'required|min:3|max:64|unique:users,username',
            'photo' => 'nullable|mimes:jpg,jpeg,png',
//            'policy' => 'accepted'
        ], [
            'email' => 'Пользователь уже существует'
        ],
        [
            'username' => 'Имя пользователя'
        ]
        );
//        dd($validator->errors());
        if ($validator->fails()){
            return back()->withErrors($validator->errors());
        }

        $validated = $validator->validated();

        $validated['password'] = Hash::make($validated['password']);

        if ($request->file('photo')){
            $validated['image_path'] = $request->file('photo')->store('public/images');
        }

        $user = User::query()->create($validated);

        Auth::login($user);

        return redirect()->route('home');
    }

    public function signin()
    {

    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }
}
