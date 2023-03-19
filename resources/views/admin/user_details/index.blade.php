@extends('layouts.app')

@section('title', 'User Details')

@section('content')

    <header class="my-4 d-flex align-items-center justify-content-between">
        <h1>Users Details</h1>
        {{-- <div class="d-flex align-items-center">
            <form method="GET" action="{{ route('admin.projects.index') }}" class="me-5 d-flex" id="filter-form">
                <div class="d-flex align-items-center">
                    <label for="search-input">Title</label>
                    <input type="text" class="filter-text form-control ms-2" placeholder="Insert a project title"
                        name="search" value="{{ $search }}" id="search-input">
                </div>
                <div class="d-flex align-items-center mx-3">
                    <label for="type_id">Type</label>
                    <select class="form-select ms-2" name="type_id" id="type_id">
                        <option value="">All types</option>
                        @foreach ($types as $type)
                            <option @if ($type_id == $type->id) selected @endif value="{{ $type->id }}">
                                {{ $type->label }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="d-flex align-items-center me-3">
                    <label for="filter-status">Status</label>
                    <select class="form-select ms-2" name="filter" id="filter-status">
                        <option @if ($selected === 'all') selected @endif value="">All</option>
                        <option @if ($selected === 'public') selected @endif value="public">Public</option>
                        <option @if ($selected === 'private') selected @endif value="private">Private</option>
                    </select>
                </div>
                <button class="btn btn-primary" type="submit">Filter</button>
            </form>
        </div> --}}

        <div>
            <a href="{{ route('admin.user_details.create') }}" class="btn btn-success me-2">
                <i class="fas fa-plus"></i>Add user
            </a>
        </div>
    </header>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">First name</th>
                <th scope="col">Last name</th>
                <th scope="col">Address</th>
                <th scope="col">Date of birth</th>
                <th scope="col">Phone</th>
                <th scope="col">Created at</th>
                <th scope="col">Last Updated</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($user_details as $user_detail)
                <tr>
                    <th scope="row">{{ $user_detail->id }}</th>
                    <td>{{ $user_detail->first_name }}</td>
                    <td>{{ $user_detail->last_name }}</td>
                    <td>{{ $user_detail->address }}</td>
                    <td>{{ $user_detail->date_of_birth }}</td>
                    <td>{{ $user_detail->phone }}</td>
                    <td>{{ $user_detail->getDate('created_at') }}</td>
                    <td>{{ $user_detail->getDateDiff('updated_at') }}</td>
                    <td>
                        <div class="d-flex">
                            @if ($user_detail->user_id === Auth::id())
                                <a class="btn btn-sm btn-warning"
                                    href="{{ route('admin.user_details.edit', $user_detail->user_id) }}">
                                    <i class="fas fa-pencil"></i>
                                </a>
                            @endif
                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td scope="row" colspan="9" class="text-center">There aren't users with these
                        characteristics</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
