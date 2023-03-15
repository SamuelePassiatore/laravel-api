@extends('layouts.app')

@section('title', 'Trash Projects')

@section('content')

    <header class="my-4 d-flex justify-content-between align-items-center">
        <h1>Trash Projects</h1>
        <div>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back</a>
        </div>
    </header>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Url</th>
                <th scope="col">Update at</th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            @forelse ($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->slug }}</td>
                    <td>{{ $project->url }}</td>
                    <td>{{ $project->updated_at }}</td>
                    <td>
                        <div class="d-flex">
                            <form action="{{ route('admin.projects.trash.restore', $project->id) }}" method="POST"
                                class="restore-form" data-name="project">
                                @csrf
                                @method('PATCH')
                                <button class="btn btn-primary me-2" type="submit">Restore</button>
                            </form>
                            <form action="{{ route('admin.projects.trash.drop', $project->id) }}" method="POST"
                                class="delete-definitive-form" data-name="project">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td scope="row" colspan="5" class="text-center">There aren't projects in trash</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div class="d-flex justify-content-center">
        <form action="{{ route('admin.projects.trash.dropAll') }}" method="POST" class="delete-all-form" data-name="trash">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger">Empty trash</button>
        </form>
    </div>
    <div class="d-flex justify-content-end">
        @if ($projects->hasPages())
            {{ $projects->links() }}
        @endif
    </div>
@endsection

@section('scripts')

@endsection
