<div>
    <x-admin.pages-header title="Roles" :breadcrumbs="[['label' => 'Roles', 'url' => route('admin.role')], ['label' => 'Create']]" :permission="false" />

    <x-admin.create-card>
        <form wire:submit.prevent="update">
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
                <!-- Permissions Multi-Select Field -->
                <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                    <x-admin.label for="permissions" label="Permissions" required="true" />
                    <select id="permissions" wire:model="selectedPermissions" multiple
                        class="form-select additional-classes">
                        @forelse($permissions as $permission)
                            <option value="{{ $permission->id }}"
                                @if (in_array($permission->id, $selectedPermissions)) selected @endif>
                                {{ $permission->title }}
                            </option>
                        @empty
                            <option disabled>No permissions available</option>
                        @endforelse
                    </select>

                    @error('selectedPermissions')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="pt-4">
                <x-admin.save-button function="update">
                    {{ __('Update') }}
                    </x-save-button>
                    <x-admin.inputs.button-secondary type="button" href="{{ route('admin.role') }}" wire:navigate>
                        {{ __('Cancel') }}
                    </x-admin.inputs.button-secondary>
            </div>
        </form>
    </x-admin.create-card>
</div>
