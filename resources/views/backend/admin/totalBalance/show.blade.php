<x-admin.showPage.show-page-display>
    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">Customer Name</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ $customer_name ?? '-' }}
            </span>
        </div>
    </x-admin.showPage.item>

    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">Total Balance</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ $total_balance ?? '0' }}
                <span class="font-bold text-black dark:text-white">MMK</span>
            </span>
        </div>
    </x-admin.showPage.item>

    {{-- Datatable --}}
    <x-admin.table>
        <!-- Header Slot -->
        <x-slot name="header">
            <tr class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-900 dark:text-gray-400">
                <th scope="col" class="px-6 py-3">No</th>
                <th scope="col" class="px-6 py-3">
                    Name
                </th>
                <th scope="col" class="px-6 py-3">ပမာဏ</th>
                <th scope="col" class="px-6 py-3">အမျိုးအစား</th>
            </tr>
        </x-slot>

        <!-- Body Slot -->
        <x-slot name="body">
            @forelse($payment_records as $index => $record)
                <tr
                    class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                    <td class="px-6 py-4">{{ $index + 1 }}</td>
                    <td class="px-6 py-4">{{ $record->user->name }}</td>
                    <td class="px-6 py-4">
                        <span class="font-bold text-black dark:text-white">{{ $record->amount ?? '-' }} MMK</span>
                    </td>
                    <td class="px-6 py-4">{{ config('constant.balance_type.' . $record->balance_type, '-') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        No Customer found.
                    </td>
                </tr>
            @endforelse
        </x-slot>
    </x-admin.table>

    {{-- Back Button --}}
    <x-slot name="button">
        <a class="bg-green-500 text-white hover:bg-green-600 px-2 py-2 rounded inline-block" wire:navigate
            href="{{ route('admin.total-balance') }}">
            Back to List
        </a>
    </x-slot>

</x-admin.showPage.show-page-display>
