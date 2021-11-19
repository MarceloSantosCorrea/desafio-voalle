<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">{{ __('Name') }}</label>
        <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="name"
            name="name"
            value="{{ old('name', $product->name ?? null) }}"
            autocomplete="name"
            autofocus
            required
        >
        @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="form-group col-md-6">
        <label for="price">{{ __('Price') }}</label>
        <input
            type="text"
            class="form-control @error('price') is-invalid @enderror"
            id="price"
            name="price"
            value="{{ old('price', $product->price ?? null) }}"
            autocomplete="price"
            required
        >
        @error('price')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
