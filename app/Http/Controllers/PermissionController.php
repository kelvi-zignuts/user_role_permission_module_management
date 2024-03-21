<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
      // dd('here');
    //   $totalModulesCount = Module::where('is_active',true)->count();
     
      // $totalModulesCount = $modules->count();
      return view('permissions.index');
    }
}