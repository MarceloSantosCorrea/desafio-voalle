<div class="form-row">
    <div class="form-group col-md-6">
        <label for="name">{{ __('Name') }}</label>
        <input
            type="text"
            class="form-control @error('name') is-invalid @enderror"
            id="name"
            name="name"
            value="{{ old('name', $client->name ?? null) }}"
            autocomplete="name"
            autofocus
            required
        >
        @error('name')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="form-group col-md-6">
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email', $client->email ?? null) }}"
            autocomplete="email"
            required
        >
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="cpf">{{ __('CPF') }}</label>
        <input
            type="text"
            class="form-control @error('cpf') is-invalid @enderror"
            id="cpf"
            name="cpf"
            value="{{ old('cpf', $client->cpf ?? null) }}"
            autocomplete="cpf"
            required
        >
        @error('cpf')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="form-group col-md-6">
        <label for="phone">{{ __('Phone') }}</label>
        <input
            type="text"
            class="form-control @error('phone') is-invalid @enderror"
            id="phone"
            name="phone"
            value="{{ old('phone', $client->phone ?? null) }}"
            autocomplete="phone"
            required
        >
        @error('phone')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>
