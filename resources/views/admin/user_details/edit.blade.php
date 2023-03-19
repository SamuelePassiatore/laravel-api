@extends('layouts.app')

@section('title', 'Edit user')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Edit user</h1>
    </header>
    <hr>
    @include('includes.user_details.form')

@endsection

@section('scripts')

@endsection
