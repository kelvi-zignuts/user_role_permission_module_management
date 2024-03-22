<?php

namespace App\Http\Controllers;


use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ModuleController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->query('filter', 'all');
    $searchfilter = $request->input('search');

    // Initialize query builder
    $query = Module::query();

    // Apply filter conditions
    if ($filter === 'active') {
        $query->where('is_active', true);
    } elseif ($filter === 'inactive') {
        $query->where('is_active', false);
    }

    // Apply search condition
    if ($request->has('search')) {
        $query->where(function ($subQuery) use ($searchfilter) {
            $subQuery->where('name', 'like', "%$searchfilter%")
                     ->orWhereHas('submodules', function ($q) use ($searchfilter) {
                         $q->where('name', 'like', "%$searchfilter%");
                     });
        });
    }

    // Fetch modules
    $modules = $query->get();
   
    // $totalModulesCount = $query->count();

    // Pass modules, filter, and search to the view
    return view('modules.index', compact('modules', 'filter', 'searchfilter'));
        // $filter = $request->query('filter', 'all');
        // $modules = Module::all();
        // $filter = $request->query('filter');
        // switch ($filter) {
        //     case 'active':
        //         $modules = Module::where('is_active', true)->get();
        //         break;
        //     case 'inactive':
        //         $modules = Module::where('is_active', false)->get();
        //         break;
        //     default:
        //         $modules = Module::all();
        //         break;
        // }

        // return view('modules.index', compact('modules'));
    }
    public function edit($code)
    {
        $module = Module::where('code', $code)->firstOrFail();
        return view('modules.edit', compact('module'));
    }
    // public function edit(Request $request)
    // {
    //     $code = $request->query('string');
    //     // Use $code to fetch the module to edit
    //     $module = Module::where('code', $code)->firstOrFail();
    //     // dd($module);
    //     return view('modules.edit', compact('module'));
    // }

    public function update(Request $request, $code)
    {
        $module = Module::where('code', $code)->firstOrFail();
        $module->update($request->all());
        return redirect()->route('modules-index')->with('success', 'Module updated successfully');
    }
    public function toggleActive($code)
    {
        $module = Module::where('code', $code)->firstOrFail();
        
        $module->update(['is_active' => !$module->is_active]);
        // $module->update(['is_active' => false]);

        
        if (!$module->is_active) {
            $module->subModules()->update(['is_active' => false]);
        }
        
        return redirect()->back()->with('success', 'Module status updated successfully.');
    }

}