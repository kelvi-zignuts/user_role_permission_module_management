<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Str;
use App\Mail\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{ 
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
        $searchfilter = $request->input('search');


    $query = User::query();

    if ($filter === 'active') {
        $query->where('is_active', true);
    } elseif ($filter === 'inactive') {
        $query->where('is_active', false);
    }

    if ($request->filled('search')) {
        $query->where(function ($subQuery) use ($searchfilter) {
            $subQuery->where('first_name', 'like', "%$searchfilter%")
                     ->orWhere('last_name', 'like', "%$searchfilter%")
                     ->orWhereHas('roles', function ($roleQuery) use ($searchfilter) {
                         $roleQuery->where('name', 'like', "%$searchfilter%");
                     });
        });
    }
    

    $users = $query->with('roles')->get();
    return view('users.index', compact('users', 'filter'));
    }
  public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:64',
            'last_name' => 'required|string|max:64',
            'email' => 'required|email',
            'contact_no' => 'nullable|string|max:16',
            'address' => 'nullable|string|max:256',
        ]);

        // dd($request->all());
       

        $randomPassword = Str::random(8);

        $user = User::create([
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($randomPassword),
            'contact_no' => $validatedData['contact_no'],
            'address' => $validatedData['address'],
        ]);

        $user->roles()->attach($request->input('roles')); 

        // dd($user->email, $user, $randomPassword );

        // Send user invitation email
        Mail::to($user->email)->send(new UserInvitation($user, $randomPassword)); 

        // $user = User::create(array_merge($validatedData, [
        //     'password' => bcrypt($randomPassword), // Hash the password
        // ]));

        // $user = User::create($validatedData);

        return redirect()->route('users-index')->with('success', 'User created successfully!');
    }
    public function edit(User $user)
    {
        $roles = Role::all();
        return view('users.edit', compact('user', 'roles'));
    }

    public function update(Request $request, User $user)
{
    $validatedData = $request->validate([
        'first_name' => 'required|string|max:64',
        'last_name' => 'required|string|max:64',
        'contact_no' => 'nullable|string|max:16',
        'address' => 'nullable|string|max:256',
        'roles' => 'required|array', // Ensure roles are provided
    ]);

    // Remove email from the validated data
    unset($validatedData['email']);

    // Update user details
    $user->update($validatedData);

    // Sync user roles
    $user->roles()->sync($validatedData['roles']);

    return redirect()->route('users-index')->with('success', 'User updated successfully!');
}

public function destroy(User $user)
{
    // Delete the role
    $user->delete();

    // Redirect back with a success message
    return redirect()->route('users-index')->with('success', 'Role deleted successfully!');
}

    
    public function toggleActive($id)
    {
        $user = User::findOrFail($id);
        $user->update(['is_active' => !$user->is_active]);

        return redirect()->back()->with('success', 'Permission status updated successfully.');
    }
    public function showResetPasswordForm(Request $request)
    {
        $pageConfigs = ['myLayout' => 'blank'];
        $email = $request->query('email');
        return view('users.reset-password', ['pageConfigs' => $pageConfigs,'email' => $email]);
    }
        
    public function resetPassword(Request $request)
    {
        // Validate request
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);
        // Find the user by email
        $user = User::where('email', $request->email)->first();

        // $user = User::findOrFail($request->id);
        // Set user's password
        $user->password = bcrypt($request->password);
        $user->save();

        // Mail::to($user->email)->send(new UserInvitation($user, $request->password));
        
        // Redirect user to dashboard or wherever you want
        return redirect()->route('auth-login-basic')->with('success', 'Password reset successfully!');
    }

    // public function resetPassword(Request $request)
    // {
    //     // Validate request
    //     $request->validate([
    //         'id'=> 'required|exists:users,id',
    //         // 'email' => 'required|email|exists:users,email',
    //         'password' => 'required|string|min:8|confirmed',
    //     ]);
    //     // Find the user by email
    //     // $user = User::where('email', $request->email)->first();

    //     $user = User::findOrFail($request->id);
    //     // Set user's password
    //     $user->password = bcrypt($request->password);
    //     $user->save();

    //     // Mail::to($user->email)->send(new UserInvitation($user, $request->password));
        
    //     // Redirect user to dashboard or wherever you want
    //     return redirect()->route('auth-login-basic')->with('success', 'Password reset successfully!');
    // }
    public function resetPasswordform(Request $request)
{
    // Validate request
    $request->validate([
        'user_id' => 'required|exists:users,id',
        'password' => 'required|string|min:8|confirmed',
    ]);

    // Find the user
    $user = User::findOrFail($request->user_id);

    // Update user's password
    $user->password = bcrypt($request->password);
    $user->save();

    // Redirect back with a success message
    return redirect()->route('users-index')->with('success', 'Password reset successfully!');
}


}