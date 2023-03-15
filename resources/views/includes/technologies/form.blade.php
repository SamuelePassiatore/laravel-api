{{-- Form --}}
@if ($technology->exists)
    <form action="{{ route('admin.technologies.update', $technology->id) }}" method="POST" enctype="multipart/form-data"
        novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.technologies.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@endif


@csrf

<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label for="label" class="form-label">Label:</label>
            <input type="text" class="form-control w-25 @error('label') is-invalid @enderror" id="label"
                placeholder="Insert label" name="label" required value="{{ old('label', $technology->label) }}">
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
                placeholder="Insert color" name="color" value="{{ old('color', $technology->color) }}">
            @error('color')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-10">
        <div class="mb-3">
            <label for="icon" class="form-label">Icon:</label>
            <input type="file"
                class="form-control @if ($technology->icon) d-none @endif @error('icon') is-invalid @enderror"
                id="icon" name="icon" value="{{ old('icon', $technology->icon) }}">
            @error('icon')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="input-group mb-3 @if (!$technology->icon) d-none @endif" id="prev-img">
                <button class="btn btn-outline-secondary" type="button" id="change-image">Change icon</button>
                <input type="text" class="form-control" value="{{ $technology->icon }}" disabled>
            </div>
        </div>
    </div>
    <div class="col-2">
        <img id="icon-preview"
            src="{{ $technology->icon ? asset('storage/' . $technology->icon) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
            alt="">
    </div>
</div>
<hr>
<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('admin.technologies.index') }}" class="btn btn-secondary me-2">Back</a>
    <button type="submit" class="btn btn-primary">Save</button>
</div>
</form>

@section('scripts')
    {{-- Javascript for img preview --}}
    <script>
        const imageInput = document.getElementById('icon');
        const imagePreview = document.getElementById('icon-preview');
        const placeholder = 'https://marcolanci.it/utils/placeholder.jpg';

        imageInput.addEventListener('change', () => {
            if (imageInput.files && imageInput.files[0]) {
                const reader = new FileReader();
                reader.readAsDataURL(imageInput.files[0]);
                reader.onload = e => {
                    imagePreview.src = e.target.result;
                }
            } else {
                imagePreview.src = placeholder;
            }
        })
    </script>

    {{-- Javascript for toggle button and input --}}
    <script>
        const prevImgField = document.getElementById('prev-img');
        const changeImageBtn = document.getElementById('change-image');

        const switchImageInput = () => {
            imageInput.classList.toggle('d-none');
            prevImgField.classList.toggle('d-none');
        }

        changeImageBtn.addEventListener('click', () => {
            imagePreview.src = placeholder;
            switchImageInput();
            imageInput.click();
        })
    </script>
@endsection
