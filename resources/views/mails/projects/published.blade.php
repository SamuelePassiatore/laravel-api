<x-mail::message>
    # {{ $text }}
    ## {{ $project->title }}
    ### {{ $project->type?->label }}
    <address>
        @if ($project->author)
            By {{ $project->author->name }}
        @else
            Anonymous
        @endif
    </address>
    <p>{{ $project->getAbstract() }}</p>
    <p>{{ $project->getDate('updated_at') }}</p>

    <x-mail::button :url="''">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
