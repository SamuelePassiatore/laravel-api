@extends('layouts.app')

@section('title', $project->title)

@section('content')

    <header class="my-4">
        <h1>{{ $project->title }}</h1>
    </header>

    <section id="single-project">
        <div class="container py-5">
            <div class="row row-cols-2 my-5">
                {{-- PROJECT IMG  --}}
                <div class="col d-flex justify-content-center py-5">
                    @if ($project->image)
                        <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                            class="rounded overflow-hidden ">
                    @endif
                </div>
                {{-- PROJECT CONTENT --}}
                <div class="col d-flex justify-content-center flex-column py-5">
                    <div><strong>Description: </strong>
                        <p class="my-2"> {{ $project->description }}</p>
                    </div>
                    <div class="my-2"><strong>Author:
                        </strong>{{ $project->author ? $project->author->name : 'Anonymous' }}
                    </div>
                    <div class="my-2"><strong>Slug: </strong> {{ $project->slug }} </div>
                    <div class="my-2"><strong>Url: </strong> {{ $project->url }} </div>
                    <div class="my-2"><strong>Type: </strong>
                        {{ $project->type?->label ? $project->type->label : '-' }}
                    </div>
                    <div class="my-2">
                        <strong>Technology: </strong>
                        @forelse ($project->technologies as $technology)
                            {{ $technology->label }}
                            @if (!$loop->last)
                                ,
                            @endif
                        @empty
                            No technology
                        @endforelse
                    </div>
                    <div class="my-2"><strong>Status: </strong> {{ $project->is_public ? 'Public' : 'Private' }}
                    </div>
                    <div class="my-2"><strong>Last modification: </strong><time>{{ $project->updated_at }}</time> </div>
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="d-flex justify-content-between my-5">
                <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
                @if ($project->user_id === Auth::id())
                    <form action="{{ route('admin.projects.toggle', $project->id) }}" method="POST">
                        @method('PATCH')
                        @csrf
                        <button type="submit" class="btn btn-outline-{{ $project->is_public ? 'danger' : 'success' }}">
                            {{ $project->is_public ? 'Draft' : 'Publish' }}
                        </button>
                    </form>
                    <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="delete-form"
                        data-name="project">
                        @method('DELETE')
                        @csrf
                        <button type="submit" class="btn btn-danger mx-2"><i class="fas fa-trash me-2"></i>Delete</button>
                    </form>
                    <a class="btn btn-warning" href="{{ route('admin.projects.edit', $project->id) }}">
                        <i class="fas fa-pencil me-2"></i>Edit
                    </a>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection
