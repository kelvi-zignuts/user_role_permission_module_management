<?php

namespace App\Http\Controllers;


use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ModuleController extends Controller
{
    public function index()
    {
        $modules = Module::all();
        return view('modules.index', compact('modules'));
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
}