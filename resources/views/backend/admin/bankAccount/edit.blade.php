<div>
    <x-admin.pages-header title="Bank Accounts" :breadcrumbs="[['label' => 'Bank Accounts', 'url' => route('admin.bank-account')], ['label' => 'Create']]" :permission="false" />
        
    <x-admin.create-card>
        <form wire:submit.prevent="update">
            <div class="py-3">
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="BankType" label="Bank Type" required="true" />
                        <x-admin.inputs.input id="Bank Type" label="Bank Type" type="text" wire:model="bank_type" disabled="true"
                            class="additional-classes" error="{{ $errors->has('bank_type') }}" />
                        @error('bank_type')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="Account Number" label="Account Number" required="true" />
                        <x-admin.inputs.input id="Account Number" label="Account Number" type="text" wire:model="account_number"
                            class="additional-classes" error="{{ $errors->has('account_number') }}" />
                        @error('account_number')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="Bank Name" label="Bank Name" required="true" />
                        <x-admin.inputs.input id="Bank Name" label="Bank Name" type="text" wire:model="bank_name"
                            class="additional-classes" error="{{ $errors->has('bank_name') }}" />
                        @error('bank_name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="YouTube Link" label="YouTube Link" required="false" />
                        <x-admin.inputs.input id="YouTube Link" label="YouTube Link" type="text" wire:model="youtube_link"
                            class="additional-classes" error="{{ $errors->has('youtube_link') }}" />
                        @error('youtube_link"')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <x-admin.save-button function="update">
                    {{ __('Update') }}
                    </x-save-button>
                    <x-admin.inputs.button-secondary type="button" href="{{ route('admin.bank-account') }}" wire:navigate>
                        {{ __('Cancel') }}
                    </x-admin.inputs.button-secondary>
            </div>
        </form>
    </x-admin.create-card>
</div>
