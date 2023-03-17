<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Boolfolio Project</title>
</head>

<body>
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
</body>

</html>
