<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('manageUser', User::class);
        $users = User::all();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('manageUser', User::class);
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->authorize('manageUser', User::class);
        $request->validate([
            'name' => 'required|string|min:4|max:20',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|confirmed',
            'role' => 'required|boolean',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'is_admin' => $request->role
        ]);
        return redirect()->route('users.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $this->authorize('manageUser', User::class);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $this->authorize('manageUser', User::class);
        $request->validate([
            'name' => 'required|string|min:4|max:20',
            'email' => 'required|string|email|unique:users,email,' . $user->id,
            'role' => 'required|boolean',
            'password' => 'confirmed'
        ]);

        $user->password = ($request->password == null) ? $user->password : $request->password;

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password,
            'is_admin' => $request->role
        ]);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $this->authorize('manageUser', User::class);
        $user->delete();
        return redirect()->route('users.index');
    }
}
