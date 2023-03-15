@extends('layouts.app')

@section('title', 'Trash Technologies')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Trash Technologies</h1>
        <div>
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back</a>
        </div>
    </header>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Label</th>
                <th scope="col">Color</th>
                <th scope="col">Updated at</th>
                <th scope="col">Deleted at</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($technologies as $technology)
                <tr>
                    <th scope="row">{{ $technology->id }}</th>
                    <td>{{ $technology->label }}</td>
                    <td>{{ $technology->color }}</td>
                    <td>{{ $technology->updated_at }}</td>
                    <td>{{ $technology->deleted_at }}</td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('admin.technologies.trash.restore', $technology->id) }}" method="POST"
                                class="restore-form" data-name="technology">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-primary me-2" type="submit">Restore</button>
                            </form>
                            <form action="{{ route('admin.technologies.trash.drop', $technology->id) }}" method="POST"
                                class="delete-definitive-form" data-name="technology">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td scope="row" colspan="5" class="text-center">There aren't technologies in trash</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <form action="{{ route('admin.technologies.trash.dropAll') }}" method="POST" class="delete-all-form"
            data-name="trash">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Empty trash</button>
        </form>
    </div>
    <div class="d-flex justify-content-end">
        @if ($technologies->hasPages())
            {{ $technologies->links() }}
        @endif
    </div>
@endsection

@section('scripts')

@endsection
