@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Modules')

@section('content')
{{-- <h4 class="fw-bold py-3 mb-4">
    Edit
  </h4> --}}
    <div class="container d-flex justify-content-center align-items-center" style="margin-top: 20vh;">
        <div class="card" style="width: 40%;  border-radius: 10px; box-shadow: 0 4px 6px rgba(74, 13, 134, 0.1);">
            <div class="card-header text-center">
                <h3 class="card-title">Edit {{ $module->name }}</h3>
            </div>
            <div class="card-body">
                <form action="{{ route('modules.update', $module->code) }}" method="POST">
                    @csrf
                    {{-- @method('PUT') --}}
                    <div class="mb-3">
                        <label for="name" class="form-label">Name:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $module->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description:</label>
                        <input class="form-control" type="text" id="description" name="description" value="{{ $module->description }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

  
    {{-- <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" >
    </div> --}}

    {{-- <div>
        <label for="description">description:</label>
        <textarea id="description" name="description">{{ $module->description }}</textarea>
    </div> --}}

    {{-- <button type="submit">Update</button> --}}

@endsection
