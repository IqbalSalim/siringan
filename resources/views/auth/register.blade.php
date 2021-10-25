<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/" class="text-4xl font-bold uppercase text-primary"">SIRINGAN</a>
        </x-slot>


        <x-auth-session-status class="mb-4 " :status=" session('status')" />

            <form method="POST" action="{{ route('register') }}" novalidate>
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')" required
                        autofocus />
                    <x-validation-message name="name" />
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                        required />
                    <x-validation-message name="email" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block w-full mt-1" type="password" name="password" required
                        autocomplete="new-password" />
                    <x-validation-message name="password" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block w-full mt-1" type="password"
                        name="password_confirmation" required />
                    <x-validation-message name="password_confirmation" />
                </div>

                <div class="flex items-center justify-end mt-4 space-x-2">
                    <a class="text-sm font-medium text-primary hover:text-blue-700" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>

                    <button type="submit" class="text-sm btn-primary">Register</button>
                </div>
            </form>
    </x-auth-card>
</x-guest-layout>
