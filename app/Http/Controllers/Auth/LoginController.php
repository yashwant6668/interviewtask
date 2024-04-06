<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request; // Import the correct Request class
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->type == 0) {
            Auth::logout();
            return redirect()->back()->with('status', 'Your account is not approved!');
        } elseif ($user->type == 1) {
            return redirect('/user_dashboard');
        } elseif ($user->type == 3) {
            return redirect('/admin_dashboard');
        }
    }
}
