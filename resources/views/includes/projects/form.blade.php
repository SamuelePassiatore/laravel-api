{{-- Form --}}
@if ($project->exists)
    <form action="{{ route('admin.projects.update', $project->id) }}" method="POST" enctype="multipart/form-data"
        novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.projects.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@endif


@csrf

<div class="row">
    <div class="col-4">
        <div class="mb-3">
            <label for="title" class="form-label">Title:</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                placeholder="Insert title" name="title" required value="{{ old('title', $project->title) }}">
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label for="slug" class="form-label">Slug:</label>
            <input type="text" class="form-control" id="slug" placeholder="Slug" disabled
                value="{{ Str::slug(old('image', $project->title), '-') }}">
        </div>
    </div>
    <div class="col-4">
        <div class="mb-3">
            <label for="url" class="form-label">Url:</label>
            <input type="text" class="form-control @error('url') is-invalid @enderror" id="url"
                placeholder="Insert url" name="url" value="{{ old('url', $project->url) }}">
            @error('url')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
    <div class="col-4 d-flex align-items-center justify-content-center mt-5 mb-4">
        <div class="form-check form-switch">
            <label class="form-label" for="is_public">Public</label>
            <input class="form-check-input" type="checkbox" role="switch" id="is_public" name="is_public"
                @if (old('is_public', $project->is_public)) checked @endif>
        </div>
    </div>
    <div class="col-5 d-flex align-items-center justify-content-center mt-5 mb-4">
        <label class="form-label" for="type_id" style="width: 185px">Type of project</label>
        <select class="form-select @error('type_id') is-invalid @enderror" name="type_id" id="type_id">
            <option value="">No types</option>
            @foreach ($types as $type)
                <option @if (old('type_id', $project->type_id) == $type->id) selected @endif value="{{ $type->id }}">
                    {{ $type->label }}</option>
            @endforeach
        </select>
        @error('image')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
    <div class="col-12 d-flex align-items-center justify-content-center mt-5">
        @foreach ($technologies as $technology)
            <div class="form-check form-check-inline">
                <input class="form-check-input" type="checkbox" id="tag-{{ $technology->id }}"
                    value="{{ $technology->id }}" name="technologies[]" @checked(in_array($technology->id, old('technologies', $project_technologies ?? [])))>
                <label class="form-check-label" for="tag-{{ $technology->id }}">{{ $technology->label }}</label>
            </div>
        @endforeach
    </div>
    <div class="mb-5 mt-2 text-center">
        @error('technologies')
            <div class="text-danger flex-column">{{ $message }}</div>
        @enderror
    </div>
    <div class="col-10">
        <div class="mb-3 mt-5">
            <label for="image" class="form-label">Image:</label>
            <input type="file"
                class="form-control @if ($project->image) d-none @endif @error('image') is-invalid @enderror"
                id="image" name="image" value="{{ old('image', $project->image) }}">
            @error('image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            <div class="input-group mb-3 @if (!$project->image) d-none @endif" id="prev-img">
                <button class="btn btn-outline-secondary" type="button" id="change-image">Change image</button>
                <input type="text" class="form-control" value="{{ $project->image }}" disabled>
            </div>


        </div>
    </div>
    <div class="col-2">
        <img id="img-preview"
            src="{{ $project->image ? asset('storage/' . $project->image) : 'https://marcolanci.it/utils/placeholder.jpg' }}"
            alt="">
    </div>
    <div class="col-12">
        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" id="description" rows="5"
                class="form-control @error('description') is-invalid @enderror" placeholder="Insert description">{{ old('description', $project->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
<hr>
<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary me-2">Back</a>
    <button type="submit" class="btn btn-primary">Save</button>
</div>
</form>

@section('scripts')
    {{-- Javascript for slug reactive --}}
    <script>
        const titleInput = document.getElementById('title');
        const slugInput = document.getElementById('slug');

        titleInput.addEventListener('blur', () => {
            slugInput.value = titleInput.value.toLowerCase().split(' ').join('-');
        });
    </script>

    {{-- Javascript for img preview --}}
    <script>
        const imageInput = document.getElementById('image');
        const imagePreview = document.getElementById('img-preview');
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
