@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Modules')

@section('content')
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <form id="filterForm" action="{{ route('modules-index') }}" method="GET">
                <label for="search-input" class="form-label">Search</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="search-input" placeholder="Search ..." name="search" value="{{ $searchfilter ?? '' }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>

        <div class="col-md-6 d-flex align-items-end justify-content-end">
            <form id="filterForm" action="{{ route('modules-index') }}" method="GET" class="d-flex align-items-center">
                <label for="filter" class="form-label me-2">Filter Modules</label>
                <select id="filter" name="filter" class="select2 form-select" style="width: 150px; height: 40px;" data-allow-clear="true">
                    <option value="all" @if($filter === 'all') selected @endif>All Modules</option>
                    <option value="active" @if($filter === 'active') selected @endif>Active Modules</option>
                    <option value="inactive" @if($filter === 'inactive') selected @endif>Inactive Modules</option>
                </select>
                <button type="submit" class="btn btn-primary ms-3">Apply</button>
                <a href="{{ route('modules-index') }}" class="btn btn-secondary ms-2">
                    <i class="ti ti-x ti-xs me-1"></i> Clear
                </a>
            </form>
        </div>
    </div>
</div>


<div class="card">
    <h5 class="card-header">Modules</h5>
    <div class="card-datatable table-responsive">
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
                    </td>
                    <td>
                        <a href="{{ route('modules.edit', ['code'=> $module->code] ) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
                <tr id="subModules{{ $module->code }}" class="collapse">
                    <td colspan="5">
                        <table class="table">
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
