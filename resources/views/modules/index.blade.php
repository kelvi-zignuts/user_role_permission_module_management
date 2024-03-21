@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Modules')

@section('content')
    {{-- <div class="col-12">
        <label class="switch">
          <input type="checkbox" class="switch-input">
          <span class="switch-toggle-slider">
            <span class="switch-on"></span>
            <span class="switch-off"></span>
          </span>
          <span class="switch-label">Save card for future billing?</span>
        </label>
      </div> --}}
      <div class="container">
        <div class="row justify-content-end">
            <div class="col-md-6 mb-4">
                <form id="filterForm" action="{{ route('modules-index') }}" method="GET">
                    <div class="d-inline-block">
                        <label for="filter" class="form-label">Filter Modules</label>
                        <select id="filter" name="filter" class="select2 form-select" style="width: 150px; height: 40px;" data-allow-clear="true">
                            <option value="all" @if($filter === 'all') selected @endif>All Modules</option>
                            <option value="active" @if($filter === 'active') selected @endif>Active Modules</option>
                            <option value="inactive" @if($filter === 'inactive') selected @endif>Inactive Modules</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Apply </button>
                    <a href="{{ route('modules-index') }}" class="btn btn-secondary">
                        <i class="ti ti-x ti-xs me-1"></i> Clear 
                    </a>
                </form>
            </div>
        </div>
    </div>
    
    

    
    
    <div class="card">
        <h5 class="card-header">Modules</h5>
        <div class="card-datatable table-responsive">
            {{-- <div class="filter">
                <a href="{{ route('modules-index') }}">All</a>
                <a href="{{ route('modules-index', ['filter' => 'active']) }}">Active</a>
                <a href="{{ route('modules-index', ['filter' => 'inactive']) }}">Inactive</a>
            </div> --}}
            <table class="dt-responsive table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($modules as $module)
                    @if($module->parent_module_code===null)
                    <tr class="clickable" data-toggle="collapse" data-target="#subModules{{ $module->code }}" aria-expanded="false" aria-controls="subModules{{ $module->code }}">
                        <td>{{ $module->name }}</td>
                        <td>{{ $module->description }}</td>
                        <td>
                            <form action="{{ route('modules.toggleActive', $module->code) }}" method="POST">
                                @csrf
                                <input type="hidden" name="is_active" value="{{ $module->is_active ? '0' : '1' }}">
                                <label class="toggle-switch">
                                    <input type="checkbox" onchange="submit()" {{ $module->is_active ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </form>
                            {{-- <div class="form-check form-switch mb-2">
                                <input class="form-check-input" type="hidden" name="is_active" value="{{ $module->is_active ? '0' : '1' }}">
                                <label class="toggle-switch">
                                    <input type="checkbox" onchange="submit()" {{ $module->is_active ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                              </div> --}}
                        </td>
                        
                        {{-- <td>{{ $module->is_active ? 'Active' : 'Inactive' }}</td> --}}
                        <td>
                            <a href="{{ route('modules.edit', ['code'=> $module->code] ) }}" class="btn btn-primary">Edit</a>
                        </td>
                    </tr>
                    <tr id="subModules{{ $module->code }}" class="collapse">
                        <td colspan="5">
                            <table class="table">
                                {{-- <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead> --}}
                                <tbody>
                                    @foreach ($module->subModules as $subModule)
                                    <tr>
                                        <td>{{ $subModule->name }}</td>
                                        <td>{{ $subModule->description }}</td>
                                        <td>
                                            <form action="{{ route('modules.toggleActive', $subModule->code) }}" method="POST">
                                                @csrf
                                                <label class="toggle-switch">
                                                    <input type="checkbox" name="is_active" onchange="submit()" {{ $module->is_active && $subModule->is_active ? 'checked' : '' }}>
                                                    <span class="slider"></span>
                                                </label>
                                            </form>
                                        </td>
                                        
                                        
                                        
                                        {{-- <td>{{ $subModule->is_active ? 'Active' : 'Inactive' }}</td> --}}
                                        <td>
                                            <a href="{{ route('modules.edit', ['code'=> $subModule->code] ) }}" class="btn btn-primary">Edit</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    

@endsection