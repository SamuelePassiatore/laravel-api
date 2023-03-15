@extends('layouts.app')

@section('title', 'Technologies')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Technologies</h1>
        <div class="d-flex align-items-center">
            <form method="GET" action="{{ route('admin.technologies.index') }}" class="me-5 d-flex" id="filter-form">
                <div class="d-flex align-items-center">
                    <label for="search-input">Label</label>
                    <input type="text" class="filter-text form-control ms-2" placeholder="Insert a technology label"
                        name="search" value="{{ $search }}" id="search-input">
                </div>
                <button class="btn btn-primary ms-3" type="submit">Filter</button>
            </form>
        </div>
        <a href="{{ route('admin.technologies.create') }}" class="btn btn-success me-2">
            <i class="fas fa-plus"></i>Add Technology
        </a>
        <a href="{{ route('admin.technologies.trash.index') }}" class="btn btn-danger">Trash</a>
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
            @forelse ($technologies as $technology)
                <tr>
                    <th scope="row">{{ $technology->id }}</th>
                    <td>{{ $technology->label }}</td>
                    <td>
                        <form action="{{ route('admin.technologies.patch', $technology->id) }}" method="POST"
                            class="color-form col-color" data-name="technology">
                            @method('PATCH')
                            @csrf
                            <input type="color" name="color" value="{{ $technology->color }}" class="color-field">
                        </form>
                    </td>
                    <td>{{ $technology->updated_at }}</td>
                    <td>
                        <div class="d-flex">
                            <a class="btn btn-sm btn-primary"
                                href="{{ route('admin.technologies.show', $technology->id) }}">
                                <i class="fas fa-eye"></i>
                            </a>
                            <form action="{{ route('admin.technologies.destroy', $technology->id) }}" method="POST"
                                class="delete-form" data-name="technology">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-sm btn-danger mx-2">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            <a class="btn btn-sm btn-warning"
                                href="{{ route('admin.technologies.edit', $technology->id) }}">
                                <i class="fas fa-pencil"></i>
                            </a>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td scope="row" colspan="7" class="text-center">There aren't projects in portfolio with these
                        characteristics</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <hr>
    <div class="d-flex justify-content-end">
        @if ($technologies->hasPages())
            {{ $technologies->links() }}
        @endif
    </div>
@endsection

@section('scripts')

    {{-- <script>
        const searchInput = document.getElementById('search-input');
        searchInput.addEventListener('input', () => {
            const searchValue = searchInput.value.trim();
        });
    </script> --}}

    <script>
        const colorFields = document.querySelectorAll('.color-field');
        colorFields.forEach(f => {
            f.addEventListener('change', () => {
                f.parentElement.submit();
            })
        })
    </script>
@endsection
