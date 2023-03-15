@if (session('message'))
    <div class="alert alert-{{ session('type') ?? 'info' }} mt-4">
        {{ session('message') }}
    </div>
@endif
