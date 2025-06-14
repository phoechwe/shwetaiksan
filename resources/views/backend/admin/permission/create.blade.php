<div>
    <x-admin.pages-header title="Permissions" :breadcrumbs="[['label' => 'Permissions', 'url' => route('admin.permission')], ['label' => 'Create']]" :permission="false" />

    <x-admin.create-card>
        <form wire:submit.prevent="store">
            <div class="py-3">
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="title" label="title" required="true" />
                        <x-admin.inputs.input id="title" label="Title" type="text" wire:model="title"
                            class="additional-classes" error="{{ $errors->has('title') }}" />
                        @error('title')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <x-admin.save-button function="store">
                    {{ __('Save') }}
                    </x-save-button>
                    <x-admin.inputs.button-secondary type="button" href="{{ route('admin.permission') }}" wire:navigate>
                        {{ __('Cancel') }}
                    </x-admin.inputs.button-secondary>
            </div>
        </form>
    </x-admin.create-card>
</div>
