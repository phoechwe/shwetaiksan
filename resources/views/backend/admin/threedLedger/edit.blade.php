<div>
    <x-admin.pages-header title="3D လယ်ဂျာ" :breadcrumbs="[['label' => '3D လယ်ဂျာ', 'url' => route('admin.threed-ledger')], ['label' => 'Edit']]" :permission="false" />

    <x-admin.create-card>
        <form wire:submit.prevent="update">
            <div class="py-3">
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="စာရင်းဖွင့်ရက်စွဲ" label="စာရင်းဖွင့်ရက်စွဲ" required="true" />
                        <x-admin.inputs.input id="စာရင်းဖွင့်ရက်စွဲ" label="စာရင်းဖွင့်ရက်စွဲ" type="date" wire:model="start_date"
                            class="additional-classes" error="{{ $errors->has('start_date') }}" />
                        @error('start_date"')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="စာရင်းပိတ်ရက်စွဲ" label="စာရင်းပိတ်ရက်စွဲ" required="true" />
                        <x-admin.inputs.input id="စာရင်းပိတ်ရက်စွဲ" label="စာရင်းပိတ်ရက်စွဲ" type="date" wire:model="end_date"
                            class="additional-classes" error="{{ $errors->has('end_date') }}" />
                        @error('end_date')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                  
                     <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="Amount" label="Amount" required="true" />
                        <x-admin.inputs.input id="Amount" label="Amount" type="number" wire:model="amount"
                            class="additional-classes" error="{{ $errors->has('amount') }}" />
                        @error('amount')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                     <div class="w-full sm:w-1/2 lg:w-1/3 px-2 mb-4">
                        <x-admin.label for="စာရင်းပိတ်ချိန်" label="စာရင်းပိတ်ချိန်" required="true" />
                        <x-admin.inputs.input id="စာရင်းပိတ်ချိန်" label="စာရင်းပိတ်ချိန်" type="time" wire:model="end_time"
                            class="additional-classes" error="{{ $errors->has('end_time') }}" />
                        @error('end_time')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <x-admin.save-button function="store">
                    {{ __('Save') }}
                    </x-save-button>
                    <x-admin.inputs.button-secondary type="button" href="{{ route('admin.threed-ledger') }}"
                        wire:navigate>
                        {{ __('Cancel') }}
                    </x-admin.inputs.button-secondary>
            </div>
        </form>
    </x-admin.create-card>
</div>
