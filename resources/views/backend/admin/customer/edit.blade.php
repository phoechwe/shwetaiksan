<div>
    <x-admin.pages-header title="Customers" :breadcrumbs="[['label' => 'Customers', 'url' => route('admin.customer')], ['label' => 'Edit']]" :permission="false" />

    <x-admin.create-card>
        <form wire:submit.prevent="update">
            <div class="py-3">
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="name" label="User Name" required="true" />
                        <x-admin.inputs.input id="name" label="Name" type="text" wire:model="name"
                            class="additional-classes" error="{{ $errors->has('name') }}" />
                        @error('name')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="phone_no" label="Phone Number" required="true" />
                        <x-admin.inputs.input id="phone_no" label="phone_no" type="phone_no" wire:model="phone_no"
                            class="additional-classes" error="{{ $errors->has('phone_no') }}" />
                        @error('phone_no')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="password" label="Password" />
                        <x-admin.inputs.input id="password" label="Password" type="password" wire:model="password"
                            class="additional-classes" error="{{ $errors->has('password') }}" />
                        @error('password')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="pt-4">
                <x-admin.save-button function="store">
                    {{ __('Save') }}
                    </x-save-button>
                    <x-admin.inputs.button-secondary type="button" href="{{ route('admin.customer') }}" wire:navigate>
                        {{ __('Cancel') }}
                    </x-admin.inputs.button-secondary>
            </div>
        </form>
    </x-admin.create-card>
</div>
