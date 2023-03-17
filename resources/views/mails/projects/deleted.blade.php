<x-mail::message>
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

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
