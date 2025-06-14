<div>
    <x-admin.pages-header title="Deposit Request" :breadcrumbs="[['label' => 'Deposit Request', 'url' => route('admin.deposit-request')], ['label' => 'Edit']]" :permission="false" />

    <x-admin.create-card>
        <form wire:submit.prevent="update">
            <div class="py-3">
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="name" label="User Name" required="true" />
                        <x-admin.inputs.input id="user_id" label="User Name" type="text" wire:model="user_name" disabled="true"
                            class="additional-classes" error="{{ $errors->has('user_id') }}" />
                        @error('user_id')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="amount" label="Amount" required="true" />
                        <x-admin.inputs.input id="amount" label="amount" type="number" wire:model="amount"
                            class="additional-classes" error="{{ $errors->has('amount') }}" />
                        @error('amount')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="Working Number" label="Working Number" required="true"/>
                        <x-admin.inputs.input id="working_number" label="Working Number" type="number" wire:model="working_number"
                            class="additional-classes" error="{{ $errors->has('working_number') }}" />
                        @error('working_number')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="Account Name" label="Account Name" required="true"/>
                        <x-admin.inputs.input id="account_name" label="Account Name" type="text" wire:model="account_name"
                            class="additional-classes" error="{{ $errors->has('account_name') }}" />
                        @error('account_name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="Account Number" label="Account Number" required="true"/>
                        <x-admin.inputs.input id="account_number" label="Account Number" type="text" wire:model="account_number"
                            class="additional-classes" error="{{ $errors->has('account_number') }}" />
                        @error('account_number')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="Admin Bannk" label="To Bank" required="true"/>
                        <x-admin.inputs.input id="admin_bank" label="To Bank" type="text" wire:model="admin_bank"
                            class="additional-classes" error="{{ $errors->has('admin_bank') }}" />
                        @error('admin_bank')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="Status" label="Status" required="true"/>
                        <x-admin.inputs.input id="status" label="Status" type="text" wire:model="status"
                            class="additional-classes" error="{{ $errors->has('status') }}" />
                            {{-- <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-300" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                                {{ config('constant.paid_status.' . $status,'-') }}
                            </button> --}}
                        @error('status')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="pt-4">
                <x-admin.save-button function="store">
                    {{ __('Save') }}
                    </x-save-button>
                    <x-admin.inputs.button-secondary type="button" href="{{ route('admin.deposit-request') }}" wire:navigate>
                        {{ __('Cancel') }}
                    </x-admin.inputs.button-secondary>
            </div>
        </form>
    </x-admin.create-card>
</div>
