<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        //
        $validated = $request->validate(['name' => 'required|max:250|min:1', 'email' => 'required|email|unique:users', 'password' => 'required|min:8|max:250']);

        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->password = Hash::make($validated['password']);

        Mail::to($user->email)->send(new WelcomeMail($user));
        dd("hello");
        $user->save();

        return response()->json($validated);
    }
}
