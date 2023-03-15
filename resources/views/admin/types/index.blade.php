@extends('layouts.app')

@section('title', 'Types')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Types</h1>
        <div class="d-flex align-items-center">
            <form method="GET" action="{{ route('admin.types.index') }}" class="me-5 d-flex" id="filter-form">
                <div class="d-flex align-items-center">
                    <label for="search-input">Label</label>
                    <input type="text" class="filter-text form-control ms-2" placeholder="Insert a type label"
                        name="search" value="{{ $search }}" id="search-input">
                </div>
                <button class="btn btn-primary ms-3" type="submit">Filter</button>
            </form>
        </div>
        <a href="{{ route('admin.types.create') }}" class="btn btn-success me-2">
            <i class="fas fa-plus"></i>Add Type
        </a>
        <a href="{{ route('admin.types.trash.index') }}" class="btn btn-danger">Trash</a>
    </header>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Label</th>
                <th scope="col">Color</th>
                <th scope="col">Update at</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($types as $type)
                <tr>
                    <th scope="row">{{ $type->id }}</th>
                    <td>{{ $type->label }}</td>
                    <td>
                        <form action="{{ route('admin.types.patch', $type->id) }}" method="POST"
                            class="color-form col-color" data-name="type">
                            @method('PATCH')
                            @csrf
                            <input type="color" name="color" value="{{ $type->color }}" class="color-field">
                        </form>
                    </td>
                    <td>{{ $type->updated_at }}</td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('admin.types.destroy', $type->id) }}" method="POST" class="delete-form"
                                data-name="type">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger mx-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a class="btn btn-sm btn-warning" href="{{ route('admin.types.edit', $type->id) }}">
                                <i class="fas fa-pencil"></i>
                            </a>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td scope="row" colspan="5" class="text-center">There aren't types in portfolio with these
                        characteristics</td>
                </tr>
            @endforelse


        </tbody>
    </table>
    <hr>
    <div class="d-flex justify-content-end">
        @if ($types->hasPages())
            {{ $types->links() }}
        @endif
    </div>
@endsection

@section('scripts')
    <script>
        const filterForm = document.getElementById('filter-form');
        const filterStatus = document.getElementById('filter-status');
        filterStatus.addEventListener('change', () => {
            filterForm.submit();
        })
    </script>

    {{-- <script>
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', () => {
            const searchValue = searchInput.value.trim();
        });
    </script> --}}

    <script>
        const filterType = document.getElementById('type_id');
        filterType.addEventListener('change', () => {
            filterForm.submit();
        })
    </script>

    <script>
        const colorFields = document.querySelectorAll('.color-field');
        colorFields.forEach(f => {
            f.addEventListener('change', () => {
                f.parentElement.submit();
            })
        })
    </script>
@endsection
