<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('pages.user-edit', ['user' => $user]);
    }

    public function update(UserRequest $request, $id)
    {
        $attributes = $request->only('email', 'name', 'phone_number', 'dob', 'password', 'avatar');
        $user = User::findOrFail($id);

        try {

            if (isset($attributes['avatar'])) {
                // Generate a unique file name for the avatar
                $fileName = uniqid() . '.' . $attributes['avatar']->getClientOriginalExtension();

                // Store the avatar file on the server using the Storage facade
                $attributes['avatar']->storeAs('public/users', $fileName);
                $attributes['avatar'] = $fileName;
            }

            $user->update($attributes);
            return redirect()->back()->with('message', 'User was updated');
        } catch (\Throwable $th) {
            //throw $th;
            return redirect()->back()->withErrors(['message' => 'Something went wrong']);
        }
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);

        try {
            //code...
            $user->delete();
            return redirect()->route('admin')->with('message', 'User was deleted');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
