@extends('layouts/layoutMaster')

@section('title', 'Permissions')

@section('content')

<div class="container">
    <!-- Search form -->
    <!-- Your search form HTML code here -->
</div>
<div class="container">
    <div class="row mb-3">
        <div class="col-md-6">
            <form id="filterForm" action="{{ route('permissions-index') }}" method="GET">
                <label for="search-input" class="form-label">Search</label>
                <div class="input-group">
                    <input type="text" class="form-control" id="search-input" placeholder="Search ..." name="search" value="{{ $searchfilter ?? '' }}">
                    <button class="btn btn-primary" type="submit">Search</button>
                </div>
            </form>
        </div>
        <div class="col-md-6 d-flex align-items-end justify-content-end">
            <form id="filterForm" action="{{ route('permissions-index') }}" method="GET" class="d-flex align-items-center">
                <label for="filter" class="form-label me-2">Filter Permissions</label>
                <select id="filter" name="filter" class="select2 form-select" style="width: 150px; height: 40px;" data-allow-clear="true">
                    <option value="all" @if($filter === 'all') selected @endif>All Permissions</option>
                    <option value="active" @if($filter === 'active') selected @endif>Active Permissions</option>
                    <option value="inactive" @if($filter === 'inactive') selected @endif>Inactive Permissions</option>
                </select>
                <button type="submit" class="btn btn-primary ms-3">Apply</button>
                <a href="{{ route('permissions-index') }}" class="btn btn-secondary ms-2">
                    <i class="ti ti-x ti-xs me-1"></i> Clear
                </a>
            </form>
        </div>
    </div>
</div>
@if(session('success'))
    <div class="alert alert-primary" role="alert">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger" role="alert">
        {{ session('error') }}
    </div>
@endif


<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Permissions</h5>
        <a href="{{ route('permissions.create') }}" class="btn btn-primary">
            <span class="align-middle">Create</span>
        </a>
    </div>
    
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
                @foreach($permissions as $permission)
                <tr>
                    <td>{{ $permission->name }}</td>
                    <td>{{ $permission->description }}</td>
                    <td>
                        <form action="{{ route('permissions.toggleActive', $permission->id) }}" method="Post">
                            @csrf
                            <input type="hidden" name="is_active" value="{{ $permission->is_active ? '0' : '1' }}">
                            <div class="form-check form-switch mb-2">
                                <label class="toggle-switch">
                                    <input class="form-check-input" type="checkbox" onchange="this.form.submit()" {{ $permission->is_active ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </div>
                        </form>
                    </td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-primary me-2">Edit</a>
                            <form action="{{ route('permissions.destroy', $permission->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this permission?') ">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
