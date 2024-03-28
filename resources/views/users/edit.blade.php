@extends('layouts/layoutMaster')

@section('title', 'Edit User')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
<link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
<script src="{{asset('assets/vendor/libs/tagify/tagify.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
<script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
<script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
@endsection

@section('page-script')
<script src="{{asset('assets/js/forms-selects.js')}}"></script>
<script src="{{asset('assets/js/forms-tagify.js')}}"></script>
<script src="{{asset('assets/js/forms-typeahead.js')}}"></script>
@endsection

@section('content')

<div class="modal-content p-3 p-md-5">
    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-body">
        <div class="text-center mb-4">
            <h3 class="role-title mb-2">Edit User</h3>
            <p class="text-muted">Update user details</p>
        </div>
        <!-- Edit user form -->
        <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
            @csrf
            {{-- @method('PUT') --}}
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label" for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                </div>
            </div>
            <div class="col-12 mb-4">
                <label class="form-label" for="contact_no">Contact No</label>
                <input type="text" class="form-control" id="contact_no" name="contact_no" value="{{ $user->contact_no }}">
            </div>
            <div class="col-12 mb-4">
                <label class="form-label" for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" value="{{ $user->address }}">
            </div>
            <div class="col-md-6 mb-4">
                <label for="select2Primary" class="form-label">Roles</label>
                <div class="select2-primary">
                    <select id="select2Primary" class="select2 form-select" multiple name="roles[]">
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" {{ $user->roles->contains($role->id) ? 'selected' : '' }}>{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Update User</button>
                <a href="{{ route('users-index') }}" class="btn btn-label-secondary waves-effect">Cancel</a>
            </div>
        </form>
        
        <!--/ Edit user form -->
    </div>
</div>

@endsection
