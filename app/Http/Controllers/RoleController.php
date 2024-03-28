<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
// use Illuminate\Support\Str;

class RoleController extends Controller
{
    public function index(Request $request)
  {
    $filter = $request->query('filter', 'all');
    $searchfilter = $request->input('search');
  $query = Role::query();
  if ($filter === 'active') {
      $query->where('is_active', true);
  } elseif ($filter === 'inactive') {
      $query->where('is_active', false);
  }
  if ($request->has('search')) {
      $query->where(function ($subQuery) use ($searchfilter) {
          $subQuery->where('name', 'like', "%$searchfilter%");
      });
  }
  $roles = $query->get();
  // $permissions = Permission::all();
  return view('roles.index', ['roles' => $roles,'filter'=>$filter,'searchfilter'=>$searchfilter]);
  }
  public function create()
  {
    $permissions = Permission::all();
      return view('roles.create', compact('permissions'));
      // return view('permissions.create'); 
  }
  public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'name' => 'required|string|max:64',
            'description' => 'nullable|string|max:255',
            'permissions' => 'required|array',
        ]);
    
        // Extract only the specified fields from the request
        $roleData = $request->only(['name', 'description']);
    
        // Create a new role instance and save it to the database
        $role = Role::create($roleData);
    
        // Attach permissions to the role
        $role->permissions()->attach($request->input('permissions'));
    
        return redirect()->route('roles-index')->with('success', 'Role created successfully!');
    }
    public function edit(Role $role)
    {
        return view('roles.edit', compact('role'));
    }

    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:64',
            'description' => 'nullable|string|max:255',
        ]);

        $role->update($validatedData);

        return redirect()->route('roles-index')->with('success', 'Role updated successfully!');
    }

    public function toggleActive($id)
    {
        $role = Role::findOrFail($id);
        $role->update(['is_active' => !$role->is_active]);
    
        return redirect()->back()->with('success', 'Permission status updated successfully.');
    }
    public function destroy(Role $role)
{
    // Delete the role
    $role->delete();

    // Redirect back with a success message
    return redirect()->route('roles-index')->with('success', 'Role deleted successfully!');
}


}