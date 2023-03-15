@extends('layouts.app')

@section('title', $technology->label)

@section('content')

    <header class="my-4">
        <h1>{{ $technology->title }}</h1>
    </header>

    <section id="single-technology">
        <div class="container py-5">
            <div class="row row-cols-2 my-5">
                {{-- Technology IMG  --}}
                <div class="col d-flex justify-content-center py-5">
                    @if ($technology->icon)
                        <img src="{{ asset('storage/' . $technology->icon) }}" alt="{{ $technology->label }}"
                            class="rounded overflow-hidden ">
                    @endif
                </div>
                {{-- technology CONTENT --}}
                <div class="col d-flex justify-content-center flex-column py-5">
                    <div class="my-2"><strong>Label: </strong> {{ $technology->label }} </div>
                    <div class="my-2"><strong>Color: </strong> {{ $technology->color }} </div>
                    <div class="my-2"><strong>Last modification: </strong><time>{{ $technology->updated_at }}</time>
                    </div>
                </div>
            </div>

            {{-- BUTTONS --}}
            <div class="d-flex justify-content-between my-5">
                <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary me-2">
                    <i class="fas fa-arrow-left me-2"></i>Back
                </a>
                {{-- <form action="{{ route('admin.projects.destroy', $project->id) }}" method="POST" class="delete-form"
                    data-name="project">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="btn btn-danger mx-2"><i class="fas fa-trash me-2"></i>Delete</button>
                </form> --}}
                <a class="btn btn-warning" href="{{ route('admin.technologies.edit', $technology->id) }}">
                    <i class="fas fa-pencil me-2"></i>Edit
                </a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')

@endsection
