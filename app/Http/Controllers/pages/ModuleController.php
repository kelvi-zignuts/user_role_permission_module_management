<?php

namespace App\Http\Controllers\pages;


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

    public function edit(Request $request)
    {
        $module = Module::findOrFail($request->code);
        return view('modules.edit', compact('module'));
    }

    public function update(Request $request, $code)
    {
        $module = Module::findOrFail($code);
        $module->update($request->all());
        return redirect()->route('modules.index')->with('success', 'Module updated successfully');
    }
}