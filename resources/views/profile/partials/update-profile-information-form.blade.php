<section>
    <header>
        <p class="mt-1 text-sm text-muted">{{ __('Modifiez votre nom et votre adresse mail') }}.</p>
    </header>
    <form method="post" action="{{ route('profile.update') }}" class="mt-4">
        @csrf
        @method('patch')
        <div class="mb-3">
            <label for="name" class="form-label">{{ __('Nom') }}</label>
            <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            <div class="text-danger mt-1">@error('name') {{ $message }} @enderror</div>

        </div>
        <div class="mb-3">
            <label for="email" class="form-label">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            <div class="text-danger mt-1">@error('email') {{ $message }} @enderror</div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">{{ __('Enregistrez') }}</button>
            @if (session('status') === 'profile-updated')
                <p class="text-success small mb-0">{{ __('Modifié avec succès') }}.</p>
            @endif
        </div>
    </form>
</section>
