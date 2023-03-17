<x-mail::message>
    # {{ $project->title }}


    A project was deleted

    <x-mail::button :url="''">
        Button Text
    </x-mail::button>

    Thanks,<br>
    {{ config('app.name') }}
</x-mail::message>
