@extends('layouts.app')
@section('title', 'Home')
@section('content')
    <header>
        <h1 class="my-5 text-center">My portfolio</h1>
    </header>
    @forelse($projects as $project)
        <div class="card border-secondary mb-3" style="max-width: 100%">
            <div class="card-header">{{ $project->updated_at }}</div>
            <div class="card-body text-secondary">
                <div class="mb-2">{{ $project->id }}</div>
                <h5 class="card-title">{{ $project->title }}</h5>
                <p class="card-text">{{ $project->description }}</p>
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
@endsection
