@extends('layouts/layoutMaster')

@section('title', 'Users')

@section('content')

    @if (session('success'))
        <div class="alert alert-primary" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
    </div>
    <div class="container">
        <div class="row mb-3">
            <div class="col-md-6">
                <form id="filterForm" action="{{ route('users-index') }}" method="GET">
                    <label for="search-input" class="form-label">Search</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="search-input" placeholder="Search ..." name="search"
                            value="{{ $searchfilter ?? '' }}">
                        <button class="btn btn-primary" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="col-md-6 d-flex align-items-end justify-content-end">
                <form id="filterForm" action="{{ route('users-index') }}" method="GET" class="d-flex align-items-center">
                    <label for="filter" class="form-label me-2">Filter Permissions</label>
                    <select id="filter" name="filter" class="select2 form-select" style="width: 150px; height: 40px;"
                        data-allow-clear="true">
                        <option value="all" @if ($filter === 'all') selected @endif>All Permissions</option>
                        <option value="active" @if ($filter === 'active') selected @endif>Active Permissions</option>
                        <option value="inactive" @if ($filter === 'inactive') selected @endif>Inactive Permissions
                        </option>
                    </select>
                    <button type="submit" class="btn btn-primary ms-3">Apply</button>
                    <a href="{{ route('users-index') }}" class="btn btn-secondary ms-2">
                        <i class="ti ti-x ti-xs me-1"></i> Clear
                    </a>
                </form>
            </div>
        </div>
    </div>
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Users</h5>
            <a href="{{ route('users.create') }}" class="btn btn-primary">
                <span class="align-middle">Create</span>
            </a>
        </div>

        <div class="card-datatable table-responsive">
            <table class="dt-responsive table">
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Last Name</th>
                        <th>Role</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>
                                @php
                                    $rolesCount = $user->roles->count();
                                    $displayRoles = $user->roles->take(2); // Show only the first 2 roles
                                @endphp
                                @foreach ($displayRoles as $role)
                                    {{ $role->name }}
                                    @if (!$loop->last)
                                        ,
                                    @endif
                                @endforeach
                                @if ($rolesCount > 2)
                                    + {{ $rolesCount - 2 }} more
                                @endif
                                {{-- @foreach ($user->roles as $role)
                            {{ $role->name }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @endforeach --}}
                            </td>
                            <td>
                                <form action="{{ route('users.toggleActive', $user->id) }}" method="Post">
                                    @csrf
                                    <input type="hidden" name="is_active" value="{{ $user->is_active ? '0' : '1' }}">
                                    <div class="form-check form-switch mb-2">
                                        <label class="toggle-switch">
                                            <input class="form-check-input" type="checkbox" onchange="this.form.submit()"
                                                {{ $user->is_active ? 'checked' : '' }}>
                                            <span class="slider"></span>
                                        </label>
                                    </div>
                                </form>
                            </td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown"><i class="ti ti-dots-vertical"></i></button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href='{{ route('users.edit', $user->id) }}'><i
                                                class="ti ti-pencil me-1"></i> Edit</a>
                                        <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item"
                                                onclick="return confirm('Are you sure you want to delete this permission?')"><i
                                                    class="ti ti-trash me-1"></i>Delete</button>
                                            {{-- <a class="dropdown-item"><i class="ti ti-trash me-1"></i> Delete</a> --}}
                                        </form>
                                        {{-- <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#resetPasswordModal{{ $user->id }}">
                                            <i class="ti ti-key me-1"></i> Reset Password
                                        </a> --}}
                                        <a href="#" data-bs-target="#addRoleModal" data-bs-toggle="modal"
                                            class="btn mb-2 text-nowrap dropdown-item reset-password-btn">
                                            <img src="https://cdn-icons-png.flaticon.com/128/10480/10480728.png"
                                                width="20px" alt="">
                                            &nbsp; New Password
                                        </a>
                                    </div>
                                </div>
                            </td>
                            {{-- <td>
                        <div class="d-flex">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary me-2">Edit</a>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">Delete</button>
                            </form>
                        </div>
                    </td> --}}
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addRoleModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered modal-add-new-role">
            <div class="modal-content p-3 p-md-5">
                <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-body">
                    <div class="text-center mb-4">
                        <h3 class="role-title mb-2">Set New Password</h3>
                        <p class="text-muted">Set role permissions</p>
                    </div>
                    <form method="POST" action="{{ route('users.resetpasswordform') }}">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ $user->id }}">
                        <div class="mb-3">
                            <label for="new_password" class="form-label">New Password</label>
                            <input type="password" class="form-control" id="new_password" name="password" required>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" id="confirm_password" name="password_confirmation" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Reset Password</button>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>


@endsection
