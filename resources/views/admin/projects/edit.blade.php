@extends('layouts.app')

@section('title', 'Edit project')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Edit project</h1>
    </header>
    <hr>
    @include('includes.projects.form')

@endsection

@section('scripts')

@endsection
