<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserManagementController extends Controller
{
    /**
     * Display a listing of users with roles.
     */
    public function index(Request $request)
    {
        // You can implement filtering logic here in the future.
        $users = User::with('role')->paginate(10); // Load users with roles, 10 per page

        return view('admindashboard.usersmanagement', compact('users'));
    }

    /**
     * Show the form for creating a new user.
     */
    public function create()
    {
        // Load roles for dropdown selection
        $roles = Role::all();
        return view('admindashboard.userscreate', compact('roles'));
    }

    /**
     * Store a newly created user in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'firstname' => 'required|string|max:100',
            'lastname'  => 'required|string|max:100',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8|confirmed',
            'role_id'   => 'required|exists:roles,id',
            'photo'     => 'nullable|image|max:2048',
        ]);

        $userData = [
            'firstname' => $validated['firstname'],
            'lastname'  => $validated['lastname'],
            'email'     => $validated['email'],
            'password'  => Hash::make($validated['password']),
            'role_id'   => $validated['role_id'],
        ];

        if ($request->hasFile('photo')) {
            $path = $request->file('photo')->store('users', 'public');
            $userData['photo'] = 'storage/' . $path;
        }

        User::create($userData);

        return redirect()->route('indexusers')->with('success', 'User created successfully.');
    }

    /**
     * Show the form for editing a user.
     */
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admindashboard.userscreate', compact('user', 'roles'));
    }

    /**
     * Update the specified user in storage.
     */
    public function update(Request $request, User $user)
    {
        // dd($request->all());
        $validated = $request->validate([
            'firstname' => 'nullable|string|max:100',
            'lastname'  => 'nullable|string|max:100',
            'email'     => 'nullable|email|unique:users,email,' . $user->id,
            'role_id'   => 'nullable|exists:roles,id',
            'password'  => 'nullable|min:8|',
            'photo'     => 'nullable|image|max:20confirmed48',
        ]);


        $userData = [
            'firstname' => $validated['firstname'],
            'lastname'  => $validated['lastname'],
            'email'     => $validated['email'],
            'role_id'   => $validated['role_id'],
        ];
        // dd($userData);
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($validated['password']);
        }

        if ($request->hasFile('photo')) {
            // Delete old photo if exists
            if ($user->photo && Storage::disk('public')->exists(str_replace('storage/', '', $user->photo))) {
                Storage::disk('public')->delete(str_replace('storage/', '', $user->photo));
            }

            $path = $request->file('photo')->store('users', 'public');
            $userData['photo'] = 'storage/' . $path;
        }

        $user->update($userData);

        return redirect()->route('indexusers')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified user from storage.
     */
    public function destroy(User $user)
    {
        // Delete user photo if exists
        if ($user->photo && Storage::disk('public')->exists(str_replace('storage/', '', $user->photo))) {
            Storage::disk('public')->delete(str_replace('storage/', '', $user->photo));
        }

        $user->delete();
        return redirect()->route('indexusers')->with('success', 'User deleted successfully.');
    }

    public function updateProfile(Request $request)
    {
        // dd('fghjkl');
        $user = auth()->user();
        $validated = $request->validate([
            'firstname' => 'nullable|string|max:100',
            'lastname'  => 'nullable|string|max:100',
            'email'     => 'nullable|email|unique:users,email,' . $user->id,
        ]);

        $userData = [
            'firstname' => $validated['firstname'],
            'lastname'  => $validated['lastname'],
            'email'     => $validated['email'],
        ];
        // dd($userData);
        $user->update($userData);
        // dd($user);
        return redirect()->back()->with('success', 'Profile updated successfully.');
    }
    public function changePassword(Request $request)
    {
        // dd($request->all());
        try {
            $user = User::findOrFail($request->input('user_id'));
            $validated = $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed',
                // 'password_confirmation' => 'required|same:new_password',
            ]);
            // (dd$validated);
                $userData['password'] = Hash::make($validated['password']);
                // dd($userData);
                $passwordPassword = $user->update($userData);
                // dd($passwordPassword);
            return redirect()->back();
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Password not changed',
                'error' => $e->getMessage()
            ]);
        }
    }
}
