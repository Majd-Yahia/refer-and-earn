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
    public function login_page()
    {
        return view('pages.login');
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
        return view('pages.register');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    /**
     * Handle an authentication attempt.
     *
     * @param  \Illuminate\Http\Request $request
     *
     * @return Response
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->only('phone_number', 'password');

        try {
            if (Auth::attempt($credentials)) {
                // Authentication passed...
                return redirect()->intended("/");
            }

            return back()->withErrors(['phone_number' => 'The provided credentials are incorrect.']);
        } catch (\Throwable $th) {
            return back()->withErrors(['phone_number' => 'Something went wrong']);
        }
    }


    public function register(RegisterRequest $request)
    {
        $attributes = $request->only('email', 'name', 'phone_number', 'dob', 'referal_code', 'password', 'avatar');

        try {
            $credentials = ['email' => $attributes['email'], 'password' => $attributes['password']];

            if (isset($attributes['avatar'])) {
                // Generate a unique file name for the avatar
                $fileName = uniqid() . '.' . $attributes['avatar']->getClientOriginalExtension();

                // Store the avatar file on the server using the Storage facade
                $attributes['avatar']->storeAs('public/users', $fileName);
                $attributes['avatar'] = $fileName;
            }

            $user = User::create($attributes);
            $user->assignRole('user');

            if(Auth::attempt($credentials))
            {
                return redirect()->intended("/");
            }
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors(['phone_number' => 'Something went wrong']);
        }
    }
}
