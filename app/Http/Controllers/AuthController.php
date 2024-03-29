<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(LoginRequest $request)
    {
        $validated = $request->validated();

        $validated = $request->safe()->only(['usermail', 'password']);

        $user = User::where('email', $validated['usermail'])->orWhere('username', $validated['usermail'])->first();

        if (!$user) {
            session()->flash('fail', 'Incorrect username or password.');
            return back()->withInput(['usermail' => $validated['usermail']]);
        }

        $crendetials = [
            'email' => $user->email,
            'password' => $validated['password']
        ];


        if ($user->status == 1 || $user->status == 2) {
            if (Auth::attempt($crendetials)) {
                $request->session()->regenerate();
                return redirect()->intended();
            }
            session()->flash('fail', 'Incorrect username or password.');
            return back()->withInput(['usermail' => $validated['usermail']]);
        } else {
            session()->flash('fail', 'Account is not yet active, please contact the administrator.');
            return redirect()->back()->withInput(['usermail' => $validated['usermail']]);
        }
    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();

        $validated = $request->safe()->only(['fullname', 'username', 'email', 'password']);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        $greets = 'Welcome to ' . config('app.name') . ', ' . $validated['fullname'] . '!';

        session()->flash('success', $greets);
        return to_route('login');
    }


    public function signout()
    {
        Auth::logout();

        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return to_route('login');
    }
}
