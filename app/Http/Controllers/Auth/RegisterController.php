<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Import Auth facade

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string', 'max:255'],
            'adhar' => ['required', 'string', 'max:255'],
            'pan' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        ]);
    }

    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'mobile' => $data['mobile'],
            'adhar' => $data['adhar'],
            'pan' => $data['pan'],
            'email' => $data['email'],
            'password' => Hash::make('123456'),
        ]);
    }

    // Override the registered method to logout the user after registration
    protected function registered(Request $request, $user)
    {
        Auth::logout(); // Logout the user
        return redirect()->back()->with('status', 'Registration successful!');
    }
}
