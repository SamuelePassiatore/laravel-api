<x-mail::message>
    <h1>{{ $text }}</h1>
    <h2>{{ $project->title }}</h2>
    <h3>{{ $project->type?->label }}</h3>
    <address>
        @if ($project->author)
            By {{ $project->author->name }}
        @else
            Anonymous
        @endif
    </address>
    <p>{{ $project->getAbstract() }}</p>
    <p>{{ $project->getDate('updated_at') }}</p>

    @if ($project->is_public)
        <x-mail::button :url="$url">
            Go to Project
        </x-mail::button>
    @endif
    Thanks,
    {{ config('app.name') }}
</x-mail::message>
