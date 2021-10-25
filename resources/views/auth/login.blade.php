<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            {{-- <a href="/">
                <x-application-logo class="w-20 h-20 text-gray-500 fill-current" />
            </a> --}}
            <a href="/" class="text-4xl font-bold uppercase text-primary"">SIRINGAN</a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4 " :status=" session('status')" />


            <form method="POST" action="{{ route('login') }}" novalidate>
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                        required autofocus />
                    <x-validation-message name="email" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="current-password" />
                        <x-validation-message name="password" />
                </div>

                <!-- Remember Me -->
                <div class="flex justify-between mt-4 item-center">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="text-blue-600 border-gray-300 rounded shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50"
                            name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                    </label>
                    @if(Route::has('password.request'))
                        <a class="text-sm font-medium text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            {{ __('Lupa password Anda?') }}
                        </a>
                    @endif
                </div>

                <div class="flex flex-col items-center justify-center mt-4 space-y-2">
                    <button type="submit" class="w-full btn-primary">login</button>
                    <p class="text-sm font-semibold text-default">Belum punya akun?
                        <a href="{{ route('register') }}" class="text-primary">Daftar disini</a>
                    </p>
                    {{-- <x-button class="ml-3">
                        {{ __('Log in') }}
                    </x-button> --}}
                </div>
            </form>
    </x-auth-card>
</x-guest-layout>
