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
                            <form action="{{route('modules.toggleActive',$module->code)}}" method="POST">
                                @csrf
                                <input type="hidden" name="is_active" value="{{$module->is_active ? '0':'1'}}">
                                <button type="submit"  class="btn {{$module->is_active ? 'btn-success' : 'btn-secondary'}}">{{$module->is_active ? 'A':'I'}}</button>
                                {{-- <div class="form-check form-switch">
                                    <input class="form-check-input toggle-switch" type="checkbox" id="is_active" name="is_active"
                                        {{ $module->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">Active</label>
                                </div> --}}
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
                                                <input type="hidden" name="is_active" value="{{ $module->is_active && $subModule->is_active ? '1' : '0' }}">
                                                <button type="submit" class="btn {{ $module->is_active && $subModule->is_active ? 'btn-success' : 'btn-secondary' }}">
                                                    {{ $module->is_active && $subModule->is_active ? 'A' : 'I' }}
                                                </button>
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