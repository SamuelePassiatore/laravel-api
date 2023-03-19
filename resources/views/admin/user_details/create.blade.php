@extends('layouts.app')

@section('title', 'New user')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>New user</h1>
    </header>
    <hr>
    @include('includes.user_details.form')


@endsection

@section('scripts')

@endsection
