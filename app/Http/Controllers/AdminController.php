<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dashboard()
    {

        // Fetch all users from the user table
        $users = User::where('type', '!=', 3)->get();

        // Pass the users data to the admin_dashboard view
        return view('admin_dashboard', compact('users'));
    }
    public function updateType(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->type = $request->type;
        $user->save();

        // You can return a response if needed
        return response()->json(['message' => 'User type updated successfully']);
    }
}
