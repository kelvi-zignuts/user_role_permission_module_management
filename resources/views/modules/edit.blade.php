@php
$configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Modules')

@section('content')
<h1>Edit Module</h1>

<form action=" {{route('modules.update', ['code' => $module->code])}}" method="POST">
    @csrf
    @method('PUT')

    <div>
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="{{ $module->name }}">
    </div>

    <div>
        <label for="description">Description:</label>
        <textarea id="description" name="description">{{ $module->description }}</textarea>
    </div>

    <button type="submit">Update</button>
</form>
@endsection