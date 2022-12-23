<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('email', 'password');

        try {
            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended("/");
            }

            return response()->json(['error' => 'Something went wrong'], 401);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Something went wrong'], 500);
        }
    }


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login_page()
    {
        return view('login');
    }


    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function register_page()
    {
        return view('login');
    }


    public function register(RegisterRequest $request)
    {
        $attributes = $request->only('email', 'name', 'phone_number', 'dob', 'referal_code', 'password', 'avatar');

        try {
            $credentials = ['email' => $attributes['email'], 'password' => $attributes['password']];

            // Generate a unique file name for the avatar
            $fileName = uniqid() . '.' . $attributes['avatar']->getClientOriginalExtension();

            // Store the avatar file on the server using the Storage facade
            $attributes['avatar']->storeAs('users', $fileName);
            $attributes['avatar'] = $fileName;

            User::create($attributes);

            if(Auth::attempt($credentials))
            {
                return redirect()->intended("/");
            }
        } catch (\Throwable $th) {
            //throw $th;
            dd($th);
            return response()->json(['error' => 'Something went wrong'], 401);
        }
    }
}
