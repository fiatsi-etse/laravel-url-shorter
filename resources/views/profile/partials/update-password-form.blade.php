<section>
    <header>
        <p class="mt-1 text-sm text-muted"></p>{{ __('Veillez à ce que votre compte utilise un mot de passe long et aléatoire pour rester sécurisé.') }}
    </header>

    <form method="post" action="{{ route('user.password.update') }}" class="mt-4">
        @csrf
        @method('put')
        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">{{ __('Mot de passe actuel') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="form-control" autocomplete="current-password">
            <div class="text-danger mt-1">@error('current_password') {{ $message }} @enderror</div>
        </div>
        <div class="mb-3">
            <label for="update_password_password" class="form-label">{{ __('Nouveau mot de passe') }}</label>
            <input id="update_password_password" name="password" type="password" class="form-control" autocomplete="new-password">
            <div class="text-danger mt-1">@error('password') {{ $message }} @enderror</div>
        </div>
        <div class="mb-3">
            <label for="update_password_password_confirmation" class="form-label">{{ __('Confirmez le mot de passe') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
            <div class="text-danger mt-1">@error('password_confirmation') {{ $message }} @enderror</div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
            <button type="submit" class="btn btn-primary">{{ __('Enregistrer') }}</button>
            @if (session('status') === 'password-updated')
                <p class="text-success small mb-0">{{ __('Mot de passe modifié avec succès') }}.</p>
            @endif
        </div>
    </form>
</section>