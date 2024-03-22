@extends('layouts/layoutMaster')

@section('title', 'Edit Role')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3>Edit Role</h3>
            <form action="{{ route('roles.update', ['role' => $role->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ $role->name }}" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3">{{ $role->description }}</textarea>
                </div>
                {{-- <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="is_active" name="is_active" value="1" {{ $role->is_active ? 'checked' : '' }}>
                    <label class="form-check-label" for="is_active">Active</label>
                </div> --}}
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('roles-index') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>

@endsection
