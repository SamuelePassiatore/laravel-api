{{-- Form --}}
@if (Auth::user()->user_detail)
    <form action="{{ route('admin.user_details.update', Auth::user()->user_detail->id) }}" method="POST"
        enctype="multipart/form-data" novalidate>
        @method('PUT')
    @else
        <form action="{{ route('admin.user_details.store') }}" method="POST" enctype="multipart/form-data" novalidate>
@endif


@csrf

<div class="row">
    <div class="col-12">
        <div class="mb-3">
            <label for="first_name" class="form-label">Name:</label>
            <input type="text" class="form-control w-25 @error('first_name') is-invalid @enderror" id="first_name"
                placeholder="Insert name" name="first_name" required
                value="{{ old('first_name', $user_detail->first_name) }}">
            @error('first_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-color">
        <div class="mb-3">
            <label for="last_name" class="form-label">Surname:</label>
            <input type="text" class="form-control w-25 @error('last_name') is-invalid @enderror" id="last_name"
                placeholder="Insert surname" name="last_name" value="{{ old('last_name', $user_detail->last_name) }}">
            @error('last_name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-color">
        <div class="mb-3">
            <label for="address" class="form-label">Address:</label>
            <input type="text" class="form-control w-25 @error('address') is-invalid @enderror" id="address"
                placeholder="Insert address" name="address" value="{{ old('address', $user_detail->address) }}">
            @error('address')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>

    <div class="col-12 col-color">
        <div class="mb-3">
            <label for="phone" class="form-label">Phone:</label>
            <input type="text" class="form-control w-25 @error('phone') is-invalid @enderror" id="phone"
                placeholder="Insert phone number" name="phone" value="{{ old('phone', $user_detail->phone) }}">
            @error('phone')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>


</div>
<hr>
<div class="d-flex justify-content-between mb-3">
    <a href="{{ route('admin.user_details.index') }}" class="btn btn-secondary me-2">Back</a>
    <button type="submit" class="btn btn-primary">Save</button>
</div>
</form>
