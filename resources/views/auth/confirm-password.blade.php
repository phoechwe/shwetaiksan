<x-guest-layout>
    <x-admin.auth.authentication-card>
        <x-slot name="logo">
            <x-admin.auth.authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
        </div>

        <x-admin.auth.validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div>
                <x-admin.label for="password" value="{{ __('Password') }}" />
                <x-admin.inputs.input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" autofocus />
            </div>

            <div class="flex justify-end mt-4">
                <x-admin.inputs.button-primary class="ms-4">
                    {{ __('Confirm') }}
                </x-button>
            </div>
        </form>
    </x-<x-admin.auth.authentication-card>
</x-guest-layout>
