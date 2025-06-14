@props([
    'id' => null,
    'title' => 'Confirm Status Change',
    'amount' => null,
    'account_number' => null,
    'account_name' => null,
    'bank_type' => null,
])

<form wire:submit.prevent="markAsPaid">
    <div x-data="{ open: @entangle('paidStatus') }" x-show="open" x-transition:enter="ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">

        <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md">
            <button type="button" @click="open = false"
                class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white text-2xl font-bold focus:outline-none">
                &times;
            </button>
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white text-center">{{ __($title) }}</h3>
                <div class="flex flex-wrap -mx-2">
                    <div class="w-full mb-4">
                        <x-admin.label for="twodNumber" label="2d နံပါတ်" required="true" />
                        <x-admin.inputs.input id="twodNumber" label="twodNumber" type="number" wire:model="twodNumber" require
                            class="additional-classes" error="{{ $errors->has('amount') }}" />
                    </div>
                </div>

                <div class="flex flex-wrap -mx-2">
                    <div class="w-full mb-4">
                        <x-admin.label label="လျော်မည့်ဆ" required="true" />
                        <x-admin.inputs.input type="number" wire:model="percentageAmount" class="additional-classes" require
                            error="{{ $errors->has('amount') }}" />
                    </div>
                </div>

                <div class="flex justify-end rounded-b-lg">
                    <x-admin.save-button function="markAsPaid" text="လျော်မည်"></x-save-button>
                </div>
            </div>
        </div>
</form>
