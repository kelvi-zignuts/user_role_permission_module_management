<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
    return view('');
  }
  public function create()
  {
      
      return view('roles.create');
      // return view('permissions.create'); 
  }
  public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:64',
            'description' => 'nullable|string|max:255',
        ]);

        $validatedData['id'] = Str::uuid();

        // Create a new role instance and save it to the database
        $role = Role::create($validatedData);

        // Redirect back with a success message
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
    // public function toggleActive($id)
    // {
    //     $role = Role::where($id)->firstOrFail();
        
    //     $role->update(['is_active' => !$role->is_active]);
    //     return redirect()->back()->with('success', 'Role status updated successfully.');
    // }
}