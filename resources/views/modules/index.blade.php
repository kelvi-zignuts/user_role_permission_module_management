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
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
             
                @foreach ($modules as $module)
                <tr>
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
                    <td>
                        {{-- <a href="{{ route('modules.edit', ['code' => $module->code]) }}">Edit</a> --}}
                        {{-- @dd($module->code) --}}
                        {{-- <a href="{{route('modules.edit')}}?param={{$module->code}}">Edit</a> --}}
                        <a href="{{ route('modules.edit', ['code'=> $module->code] ) }}" class="btn btn-primary">Edit</a>
                    </td>
                </tr>
            @endforeach
             
            </tbody>
          </table>
        </div>
      </div>
@endsection