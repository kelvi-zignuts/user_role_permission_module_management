<?php

namespace App\Http\Controllers\pages;

use App\Models\Module;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomePage extends Controller
{
  public function index()
  {
    // dd('here');
    $totalModulesCount = Module::where('is_active',true)->count();
   
    // $totalModulesCount = $modules->count();
    return view('content.pages.pages-home',['totalModulesCount'=> $totalModulesCount]);
  }
}