{{-- Form --}}
@if ($type->exists)
    <form action="{{ route('admin.types.update', $type->id) }}" method="POST" enctype="multipart/form-data" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.types.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@endif


@csrf

<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label for="label" class="form-label">Label:</label>
            <input type="text" class="form-control w-25 @error('label') is-invalid @enderror" id="label"
                placeholder="Insert label" name="label" required value="{{ old('label', $type->label) }}">
            @error('label')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-color">
        <div class="mb-3">
            <label for="color" class="form-label">Color:</label>
            <input type="color" class="form-control w-25 @error('color') is-invalid @enderror" id="color"
                placeholder="Insert color" name="color" value="{{ old('color', $type->color) }}">
            @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
<hr>
<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('admin.types.index') }}" class="btn btn-secondary me-2">Back</a>
    <button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
