@extends('layouts/layoutMaster')

@section('title', 'Create User')

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
            <h3 class="role-title mb-2">Create User</h3>
            <p class="text-muted">Enter user details</p>
        </div>
        <!-- Create user form -->
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-6 mb-4">
                    <label class="form-label" for="first_name">First Name</label>
                    <input type="text" class="form-control" id="first_name" name="first_name" placeholder="Enter First Name">
                </div>
                <div class="col-md-6 mb-4">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input type="text" class="form-control" id="last_name" name="last_name" placeholder="Enter Last Name">
                </div>
            </div>
            <div class="col-12 mb-4">
                <label class="form-label" for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Email">
            </div>
            <div class="col-12 mb-4">
                <label class="form-label" for="contact_no">Contact No</label>
                <input type="text" class="form-control" id="contact_no" name="contact_no" placeholder="Enter Contact No">
            </div>
            <div class="col-12 mb-4">
                <label class="form-label" for="address">Address</label>
                <textarea class="form-control" id="address" name="address" rows="3" placeholder="Enter Address"></textarea>
            </div>
            <div class="col-md-6 mb-4">
                <label for="select2Primary" class="form-label">Primary</label>
                <div class="select2-primary">
                    <select id="select2Primary" class="select2 form-select" multiple name="roles[]">
                        @foreach($roles as $role)
                            @if($role->is_active)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light">Send Invite</button>
                <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
            
        </form>
        <!--/ Create user form -->
    </div>
</div>

@endsection
