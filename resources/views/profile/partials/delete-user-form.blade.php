<section class="space-y-6">
    <header>
        <p class="mt-1 text-sm text-muted">Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger toutes les données ou informations que vous souhaitez conserver.</p>
        <div class="text-danger mt-1">@error('password') {{ $message }} @enderror</div>
    </header>
    <button class="btn btn-danger mt-3" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">Supprimer mon compte</button>
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="confirmUserDeletionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmUserDeletionModalLabel">Êtes-vous sûr de vouloir supprimer votre compte ?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez saisir votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.
                    <form method="post" action="{{ route('profile.destroy') }}" class="mt-4">
                        @csrf
                        @method('delete')
                        <div class="mb-3">
                            <label for="password" class="form-label">Mot de passe</label>
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password">
                            <div class="text-danger mt-1">@error('password') {{ $message }} @enderror</div>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
                            <button type="submit" class="btn btn-danger">Supprimer le compte</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>