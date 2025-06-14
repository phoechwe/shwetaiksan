<div class="md:grid">
    <div class="md:mt-0 md:col-span-2">
        <div class="px-4 sm:p-6 sm:rounded-lg">
            <div class="dark:text-white text-lg font-bold mb-3">
                {{ __('Two Factor Authentication') }}
            </div>
            <div class="dark:text-white">
                {{ __('Add additional security to your account using two factor authentication.') }}
            </div>
            <h3 class="text-lg font-medium dark:text-white text-gray-900">
                @if ($this->enabled)
                    @if ($showingConfirmation)
                        {{ __('Finish enabling two factor authentication.') }}
                    @else
                        {{ __('You have enabled two factor authentication.') }}
                    @endif
                @else
                    {{ __('You have not enabled two factor authentication.') }}
                @endif
            </h3>

            <div class="mt-3 max-w-xl text-sm text-gray-600">
                <p>
                    {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
                </p>
            </div>

            @if ($this->enabled)
                @if ($showingQrCode)
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            @if ($showingConfirmation)
                                {{ __('To finish enabling two factor authentication, scan the following QR code using your phone\'s authenticator application or enter the setup key and provide the generated OTP code.') }}
                            @else
                                {{ __('Two factor authentication is now enabled. Scan the following QR code using your phone\'s authenticator application or enter the setup key.') }}
                            @endif
                        </p>
                    </div>

                    <div class="mt-4 p-2 inline-block bg-white">
                        {!! $this->user->twoFactorQrCodeSvg() !!}
                    </div>

                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('Setup Key') }}: {{ decrypt($this->user->two_factor_secret) }}
                        </p>
                    </div>

                    @if ($showingConfirmation)
                        <div class="mt-4">
                            <x-admin.label for="code" label="{{ __('Code') }}" required="true" />
                            <x-admin.inputs.input type="text" name="code" class="block mt-1 w-1/2"
                                inputmode="numeric" autofocus autocomplete="one-time-code" wire:model="code"
                                wire:keydown.enter="confirmTwoFactorAuthentication"
                                error="{{ $errors->has('code') }}" />
                            <x-admin.inputs.input-error for="code" class="mt-2" />
                        </div>
                    @endif
                @endif

                @if ($showingRecoveryCodes)
                    <div class="mt-4 max-w-xl text-sm text-gray-600">
                        <p class="font-semibold">
                            {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                        </p>
                    </div>

                    <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                        @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                            <div>{{ $code }}</div>
                        @endforeach
                    </div>
                @endif
            @endif

            <div class="mt-5">
                @if (!$this->enabled)
                    <x-admin.auth.confirms-password wire:then="enableTwoFactorAuthentication">
                        <x-admin.inputs.button-primary type="button" wire:loading.attr="disabled">
                            {{ __('Enable') }}
                        </x-admin.inputs.button-primary>
                    </x-admin.auth.confirms-password>
                @else
                    @if ($showingRecoveryCodes)
                        <x-admin.auth.confirms-password wire:then="regenerateRecoveryCodes">
                            <x-admin.inputs.button-primary class="me-3">
                                {{ __('Regenerate Recovery Codes') }}
                            </x-admin.inputs.button-primary>
                        </x-admin.auth.confirms-password>
                    @elseif ($showingConfirmation)
                        <x-admin.auth.confirms-password wire:then="confirmTwoFactorAuthentication">
                            <x-admin.inputs.button-primary type="button" class="me-3" wire:loading.attr="disabled">
                                {{ __('Confirm') }}
                            </x-admin.inputs.button-primary>
                        </x-admin.auth.confirms-password>
                    @else
                        <x-admin.auth.confirms-password wire:then="showRecoveryCodes">
                            <x-admin.inputs.button-primary class="me-3">
                                {{ __('Show Recovery Codes') }}
                            </x-admin.inputs.button-primary>
                        </x-admin.auth.confirms-password>
                    @endif

                    @if ($showingConfirmation)
                        <x-admin.auth.confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-admin.inputs.button-secondary wire:loading.attr="disabled">
                                {{ __('Cancel') }}
                            </x-admin.inputs.button-secondary>
                        </x-admin.auth.confirms-password>
                    @else
                        <x-admin.auth.confirms-password wire:then="disableTwoFactorAuthentication">
                            <x-admin.inputs.button-danger wire:loading.attr="disabled">
                                {{ __('Disable') }}
                            </x-danger-button>
                        </x-admin.auth.confirms-password>
                    @endif

                @endif
            </div>
        </div>
    </div>
</div>
