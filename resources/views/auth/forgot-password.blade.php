<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/"
                class="px-4 py-2 text-4xl font-bold uppercase bg-white rounded-lg shadow-lg bg-opacity-70 text-primary"">SIRINGAN</a>
        </x-slot>

        <div class="mb-4 text-sm text-gray-600 ">
                {{ __('Lupa kata sandi? tidak masalah. silahkan masukkan email anda yang terdaftar di aplikasi untuk dikirimkan link reset password.') }}
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-4 " :status=" session('status')" />

            <!-- Validation Errors -->
            <x-auth-validation-errors class="mb-4" :errors="$errors" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                        required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <button type="submit" class="btn-primary">Kirimkan Link Reset Password</button>
                </div>
            </form>
    </x-auth-card>
</x-guest-layout>
