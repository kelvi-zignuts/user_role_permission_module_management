@extends('layouts/layoutMaster')

@section('title', 'Edit Permission')

@section('content')

<div class="modal-content p-3 p-md-5">
    <button type="button" class="btn-close btn-pinned" data-bs-dismiss="modal" aria-label="Close"></button>
    <div class="modal-body">
        <div class="text-center mb-4">
            <h3 class="role-title mb-2">Edit Permission</h3>
            <p class="text-muted">Modify permission details</p>
        </div>
        <!-- Edit permission form -->
        <form action="{{ route('permissions.update', ['permission'=> $permission->id]) }}" method="POST">
            @csrf
            <div class="col-12 mb-4">
                <label class="form-label" for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $permission->name }}" placeholder="Enter Permission">
            </div>
            <div class="col-12 mb-4">
                <label class="form-label" for="description">Description</label>
                <textarea class="form-control" id="description" name="description" rows="3">{{ $permission->description }}</textarea>
            </div>
            <div class="col-12">
                <h5>Permissions</h5>
                <!-- Permission table -->
                <div class="table-responsive">
                    <table class="table table-flush-spacing">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Create</th>
                                <th>Edit</th>
                                <th>View</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- @dd($selectedPermissions) --}}
                            @foreach($selectedPermissions as $module)
                            {{-- @if(isset($module['submodules']) && count($module['submodules']) > 0) --}}
                            {{-- @dd($module->pivot->edit) --}}
                                <tr>
                                    <td class="text-nowrap fw-semibold">{{ $module->name }}</td>
                                    <td>
                                        <div class="form-check">
                                            {{-- <input class="form-check-input" type="checkbox" name="permissions[{{ $module['code'] }}][create]" id="createPermission{{ $module['code'] }}" {{ in_array($module['code'], $selectedPermissions) && $permission->hasAccess($module['code'], 'create') ? '1' : '' }}> --}}
                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->code }}][create]"  {{ $module->pivot->create ? 'checked' : ''}}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->code }}][edit]"  {{ $module->pivot->edit ? 'checked' : ''}}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->code }}][view]"  {{ $module->pivot->view ? 'checked' : ''}}>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="permissions[{{ $module->code }}][delete]"  {{ $module->pivot->delete ? 'checked' : ''}}>
                                        </div>
                                    </td>
                                </tr>
                                    {{-- @foreach($module['submodules'] as $submodule)
                                        <tr>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $submodule->name }}</td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[{{ $submodule['code'] }}][create]" {{ $module->pivot->create ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[{{ $submodule['code'] }}][edit]" {{ $module->pivot->edit ? 'checked' : ''}}>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[{{ $submodule['code'] }}][view]" {{ $module->pivot->view ? 'checked' : ''}}>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="permissions[{{ $submodule['code'] }}][delete]"  {{ $module->pivot->delete ? 'checked' : ''}}>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                    {{-- @endif --}}
                                    @endforeach
                        </tbody>
                        
                    </table>
                </div>
                <!-- Permission table -->
            </div>
            
            <div class="col-12 text-center mt-4">
                <button type="submit" class="btn btn-primary me-sm-3 me-1 waves-effect waves-light" onclick="showSuccess()">Update</button>
                <button type="reset" class="btn btn-label-secondary waves-effect" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
            </div>
        </form>
        <!--/ Edit permission form -->
    </div>
</div>
@endsection