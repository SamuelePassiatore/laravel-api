@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-5">
            <div>
                <h2 class="mb-3">My projects</h2>
            </div>
            @forelse($projects as $project)
                <div class="card border-secondary mb-3" style="max-width: 100%">
                    <div class="card-header">{{ $project->updated_at }}</div>
                    <div class="card-body text-secondary">
                        <div class="mb-2">{{ $project->id }}</div>
                        <h5 class="card-title">{{ $project->title }}</h5>
                        <p class="card-text">{{ $project->description }}</p>
                        <p class="card-text">{{ $project->slug }}</p>
                        <p class="card-text">{{ $project->url }}</p>
                        @if ($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}"
                                class="rounded overflow-hidden card-img-bottom">
                        @endif
                    </div>
                </div>
            @empty
                <div class="d-flex justify-content-center">There aren't projects in portfolio</div>
            @endforelse
            <div class="d-flex justify-content-end">
                @if ($projects->hasPages())
                    {{ $projects->links() }}
                @endif
            </div>
        </div>
    </div>


@endsection
