@props([
    'id' => null,
    'title' => 'Confirm Status Change',
    'amount' => null,
    'account_number' => null,
    'account_name' => null,
    'bank_type' => null,
])

<div x-data="{ open: @entangle('confirmingPaidStatus') }" x-show="open"
    x-transition:enter="ease-out duration-200"
    x-transition:enter-start="opacity-0 scale-95"
    x-transition:enter-end="opacity-100 scale-100"
    x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100 scale-100"
    x-transition:leave-end="opacity-0 scale-95"
    class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"
    style="display: none;"
>
    <div class="relative bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md">
        {{-- Close Button --}}
        <button type="button" @click="open = false"
            class="absolute top-2 right-2 text-gray-500 hover:text-gray-700 dark:text-gray-300 dark:hover:text-white text-2xl font-bold focus:outline-none">
            &times;
        </button>

        <div class="p-6">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                {{ __($title) }}
            </h3>

            <div class="mt-4 space-y-2 text-sm text-gray-700 dark:text-gray-300">
                <div class="flex justify-between">
                    <span class="font-semibold">အကောင့်အမည်</span>
                    <span class="font-bold text-black dark:text-white">{{ $account_name ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold">ထည့်သွင်းငွေပမာဏ</span>
                    <span class="font-bold text-black dark:text-white">{{ $amount ?? '-' }} MMK</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold">အကောင့်နံပါတ်</span>
                    <span>{{ $account_number ?? '-' }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="font-semibold">ဘဏ်အမျိုးအစား</span>
                    <span>{{ $bank_type ?? '-' }}</span>
                </div>
            </div>
        </div>

        <div class="flex justify-between p-6 bg-gray-100 dark:bg-gray-700 rounded-b-lg">
            <button type="button" wire:click="markAsPaid(3)" class="px-4 py-2 m-2 bg-red-800 text-white rounded-md" wire:loading.attr="disabled">
                {{ __('ငြင်းပယ်မည်') }}
            </button>
            <button type="button" wire:click="markAsPaid(2)" class="px-4 py-2 m-2 bg-green-600 text-white rounded-md" wire:loading.attr="disabled">
                {{ __('သေချာပါသည်') }}
            </button>
        </div>
    </div>
</div>
