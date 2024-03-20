@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Modules')

@section('content')
{{-- <h1>List of Modules</h1> --}}

    {{-- <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($modules as $module)
                <tr>
                    <td>{{ $module->name }}</td>
                    <td>{{ $module->description }}</td>
                    <td>
                        <a href="">Edit</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table> --}}
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
                                    <input type="checkbox" onchange="this.form.submit()" {{ $module->is_active ? 'checked' : '' }}>
                                    <span class="slider"></span>
                                </label>
                            </form>
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
                                                    <input type="checkbox" name="is_active" onchange="this.form.submit()" {{ $module->is_active && $subModule->is_active ? 'checked' : '' }}>
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