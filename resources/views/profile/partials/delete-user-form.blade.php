<section class="space-y-6">
    <button 
        type="button" 
        class="btn btn-danger" 
        data-toggle="modal" 
        data-target="#confirmUserDeletionModal"
    >
        {{ __('Eliminar Cuenta') }}
    </button>

    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form method="post" action="{{ route('profile.destroy') }}">
                    @csrf
                    @method('delete')

                    <div class="modal-header border-0">
                        <h5 class="modal-title font-weight-bold" id="deleteModalLabel">
                            {{ __('¿Estás seguro de que deseas eliminar tu cuenta?') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <p class="text-muted">
                            {{ __('Una vez que tu cuenta sea eliminada, todos sus recursos y datos se borrarán permanentemente. Por favor, introduce tu contraseña para confirmar la eliminación.') }}
                        </p>

                        <div class="form-group mt-3">
                            <label for="password" class="sr-only">{{ __('Password') }}</label>
                            <input 
                                id="password"
                                name="password"
                                type="password"
                                class="form-control {{ $errors->userDeletion->has('password') ? 'is-invalid' : '' }}"
                                placeholder="{{ __('Contraseña') }}"
                                required
                            />
                            
                            @if($errors->userDeletion->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->userDeletion->first('password') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="modal-footer border-0 d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary mr-2" data-dismiss="modal">
                            {{ __('Cancelar') }}
                        </button>

                        <button type="submit" class="btn btn-danger">
                            {{ __('Eliminar Cuenta') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>