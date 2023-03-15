@extends('layouts.app')

@section('title', 'New project')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>New project</h1>
    </header>
    <hr>
    @include('includes.projects.form')


@endsection

@section('scripts')

@endsection
