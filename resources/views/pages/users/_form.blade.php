<div class="form-row">
    <div class="form-group col-md-6">
        <label for="firstname">{{ __('Firstname') }}</label>
        <input
            type="text"
            class="form-control @error('firstname') is-invalid @enderror"
            id="firstname"
            name="firstname"
            value="{{ old('firstname', $user->firstname ?? null) }}"
            autocomplete="firstname"
            autofocus
            required
        >
        @error('firstname')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="form-group col-md-6">
        <label for="lastname">{{ __('Lastname') }}</label>
        <input
            type="text"
            class="form-control @error('lastname') is-invalid @enderror"
            id="lastname"
            name="lastname"
            value="{{ old('lastname', $user->lastname ?? null) }}"
        >
        @error('lastname')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="email">{{ __('E-Mail Address') }}</label>
        <input
            type="email"
            class="form-control @error('email') is-invalid @enderror"
            id="email"
            name="email"
            value="{{ old('email', $user->email ?? null) }}"
            autocomplete="email"
            required
        >
        @error('email')
        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
    <div class="form-group col-md-6">
        <label for="password">{{ __('Password') }}</label>
        <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            id="password"
            name="password"
            autocomplete="new-password"
        >
        @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-row">
    <div class="form-group col-md-6">
        <label for="password-confirm">{{ __('Confirm Password') }}</label>
        <input
            type="password"
            class="form-control @error('password') is-invalid @enderror"
            id="password-confirm"
            name="password_confirmation"
            autocomplete="new-password"
        >
        @error('password')<span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>@enderror
    </div>
</div>

<div class="form-group">
    <div class="form-check">
        <input
            class="form-check-input"
            type="checkbox"
            id="is_active"
            name="is_active"
            {{ old('is_active', isset($user) ? $user->is_active : true) ? 'checked': null }}
        >
        <label class="form-check-label" for="is_active">
            {{ __('Is Active?') }}
        </label>
    </div>
</div>
