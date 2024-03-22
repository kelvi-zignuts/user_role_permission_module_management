@extends('layouts/layoutMaster')

@section('title', 'Permissions')

@section('content')


<div class="modal-content p-3 p-md-5">
    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-body">
      <div class="text-center mb-4">
        <h3 class="role-title mb-2">Create Roles</h3>
        <p class="text-muted">Set roles</p>
      </div>
      <!-- Add role form -->
      <form action="{{ route('roles.store') }}" method="POST" >
        @csrf
        <div class="col-12 mb-4">
            <label class="form-label" for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Permission">
        </div>
        <div class="col-12 mb-4">
            <label class="form-label" for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>

        <div class="col-12 text-center mt-4">
          <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Submit</button>
          <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
        </div>
      <input type="hidden"></form>
      <!--/ Add role form -->
    </div>
  </div>

@endsection