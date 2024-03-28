<?php

namespace App\Http\Controllers;

use App\Models\Module;
use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
      $filter = $request->query('filter', 'all');
      $searchfilter = $request->input('search');
    $query = Permission::query();
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
    $permissions = $query->get();
    // $permissions = Permission::all();
    return view('permissions.index', ['permissions' => $permissions,'filter'=>$filter,'searchfilter'=>$searchfilter]);
    }
    public function create()
    {
        $modules = Module::whereNull('parent_module_code')->with('submodules')->get();
        return view('permissions.create', compact('modules'));
        // return view('permissions.create'); 
    }
//     public function create()
// {
//     $modules = Module::whereNull('parent_module_code')->with('submodules')->get();
//     $selectedPermissions = []; // Retrieve the selected permissions from the database or session
//     return view('permissions.create', compact('modules', 'selectedPermissions'));
// }

    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:64',
        'description' => 'nullable|string|max:255',
        // Add validation rules for other fields if necessary
    ]);

    // Create the permission
    $permission = Permission::create($validatedData);

    // Attach permissions to modules in the pivot table
    $permissions = $request->input('permissions', []);
    foreach ($permissions as $moduleCode => $permissionData) {
        // Find the module based on its code
        $module = Module::where('code', $moduleCode)->firstOrFail();
        
        // Attach permission to the module in the pivot table
        $module->permissions()->attach($permission->id, [
            'create' => isset($permissionData['create']) ? 1 : 0,
            'edit' => isset($permissionData['edit']) ? 1 : 0,
            'view' => isset($permissionData['view']) ? 1 : 0,
            'delete' => isset($permissionData['delete']) ? 1 : 0,
        ]);
    }

    // Redirect to the index page after successful submission
    return redirect()->route('permissions-index')->with('success', 'Permissions created successfully');
}

    // public function edit(Permission $permission)
    // {
    //     // Fetch modules or any other data required for the form
        
    //     $modules = Module::whereNull('parent_module_code')->with('submodules')->get();
    //     return view('permissions.edit', compact('permission','modules'));
    // }
    public function edit(Permission $permission)
    {
            // $modules = Module::whereNull('parent_module_code')->with('submodules')->get();
            // $selectedPermissions = $permission->with('modules')->whereNull('parent_module_code'); // Get selected module codes
            $selectedPermissions = $permission->modules;
            return view('permissions.edit', compact('permission','selectedPermissions'));
    }
    public function update(Request $request, Permission $permission)
    {
        // Validate the request data
        $request->validate([
            'name' => 'required|string|max:64',
            'description' => 'nullable|string|max:255',
        ]);
    
        // Update the permission with the form data
        $permission->update($request->all());
    
        // Detach existing permissions for the permission being updated
        $permission->modules()->detach();
    
        // Attach updated permissions to modules in the pivot table
        $permissions = $request->input('permissions', []);
        foreach ($permissions as $moduleCode => $permissionData) {
            // Find the module based on its code
            $module = Module::where('code', $moduleCode)->firstOrFail();
    
            // Attach permission to the module in the pivot table
            $module->permissions()->attach($permission->id, [
                'create' => isset($permissionData['create']) ? 1 : 0,
                'edit' => isset($permissionData['edit']) ? 1 : 0,
                'view' => isset($permissionData['view']) ? 1 : 0,
                'delete' => isset($permissionData['delete']) ? 1 : 0,
            ]);
        }
    
        // Redirect back after successful update
        return redirect()->route('permissions-index')->with('success', 'Permission updated successfully');
    }
    

    // public function update(Request $request, Permission $permission)
    // {
    //     // Validate the request data
    //     $request->validate([
    //         'name' => 'required|string|max:64',
    //         'description' => 'nullable|string|max:255',
    //     ]);

    //     // Update the permission with the form data
    //     $permission->update($request->all());

    //     $permissions = $request->input('permissions', []);
    //     foreach ($permissions as $moduleCode => $permissionData) {
    //         // Find the module based on its code
    //         $module = Module::where('code', $moduleCode)->firstOrFail();
            
    //         // Attach permission to the module in the pivot table
    //         $module->permissions()->attach($permission->id, [
    //             'create' => isset($permissionData['create']) ? 1 : 0,
    //             'edit' => isset($permissionData['edit']) ? 1 : 0,
    //             'view' => isset($permissionData['view']) ? 1 : 0,
    //             'delete' => isset($permissionData['delete']) ? 1 : 0,
    //         ]);
    //     }
        // Redirect back after successful update
    //     return redirect()->route('permissions-index')->with('success', 'Permission updated successfully');
    // }
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return redirect()->route('permissions-index')->with('success', 'Permission deleted successfully');
    }

    public function toggleActive($id)
{
    $permission = Permission::findOrFail($id);
    $permission->update(['is_active' => !$permission->is_active]);

    return redirect()->back()->with('success', 'Permission status updated successfully.');
}
}