<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

<!--     <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

    </form> -->


    <form method="POST" action="{{ route('login') }}">
        @csrf
        <h4 class="text-primary mb-4">Ingreso Sysnet Perú!</h4>
        <div class="form-group">
            <input class="form-control" type="email" name="email" :value="old('email')" required
                autofocus autocomplete="username" placeholder="Ingresa tu correo electrónico">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>
        <div class="form-group">
            <input class="form-control" type="password" name="password" required
                autocomplete="current-password" placeholder="Ingresa tu contraseña">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>
        <div class="form-row mb-3">
            <div class="col-sm-6">
                <div class="custom-control custom-checkbox">
                    <input type="checkbox" name="remember" class="custom-control-input" id="remember_me">
                    <label class="custom-control-label font-14" for="remember_me">{{ __('Recordarme') }}</label>
                </div>
            </div>
            <!-- <div class="col-sm-6">
                <div class="forgot-psw">
                    @if (Route::has('password.request'))
                        <a id="forgot-psw" href="{{ route('password.request') }}" class="font-14">{{ __('Olvidaste tu contraseña?') }}</a>
                    @endif
                </div>
            </div> -->
        </div>
        <button type="submit" class="btn btn-success btn-lg btn-block font-18">Ingresar</button>
    </form>
</x-guest-layout>
