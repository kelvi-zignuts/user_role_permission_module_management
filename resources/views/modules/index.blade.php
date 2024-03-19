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
        <h5 class="card-header"> Modules</h5>
        <div class="card-datatable table-responsive">
          <table class="dt-responsive table">
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
                    {{-- @dd($module) --}}
                    <td>{{ $module->name }}</td>
                    <td>{{ $module->description }}</td>
                    <td>
                        {{-- <a href="{{ route('modules.edit', ['code' => $module->code]) }}">Edit</a> --}}
                        {{-- @dd($module->code) --}}
                        <a href="{{ url('modules/edit', ['code' => urlencode($module->code)]) }}">Edit</a>
                    </td>
                </tr>
            @endforeach
             
            </tbody>
          </table>
        </div>
      </div>
@endsection
