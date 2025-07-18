<div>
    <x-admin.pages-header title="3D ထိုးစားရင်း" :breadcrumbs="[['label' => '3D ထိုးစားရင်း', 'url' => route('admin.threed-bet')], ['label' => 'List']]" :permission="Gate::check('deposit_request_create_false')" :route="route('admin.deposit-request', ['action' => 'create'])" />

    <div class="flex justify-end mb-3">
        <button type="button"
            class="inline-flex items-center justify-center px-4 py-2 rounded-md text-white
                                    {{ $isPaid == 2 ? 'bg-green-600 cursor-not-allowed' : 'bg-yellow-500 hover:bg-yellow-400' }}"
            {{ $isPaid == 2 ? 'disabled' : '' }}
            @if ($isPaid == 1) wire:click="confirmMarkAsPaid()" @endif wire:loading.attr="disabled">
            {{ config('constant.isPaid.' . $isPaid, '-') }}
        </button>
    </div>
    <!-- Table Container -->
    <div class="rounded-lg shadow-lg bg-primary-500 ">
        <!-- Search and Filters -->
        <div class="flex flex-wrap items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 rounded-t-xl">
            <div class="w-22">
                <x-admin.inputs.input wire:model.live.debounce.500ms="search" type="search"
                    placeholder="Search .."></x-admin.inputs.input>
            </div>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg dark:text-white text-sm">
                    Filters
                    <i class="fa-solid fa-filter ml-2"></i>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 shadow-lg rounded-lg p-4 z-10">

                    {{-- <label class="block text-sm text-gray-700 dark:text-gray-300">Status:</label> --}}

                    <div class="relative">
                        {{-- <x-admin.select wire:model="statusFilter" wire:change="filterStatus" class="additional-classes">
                            <option value="">မနက်/ညနေ</option>
                            <option value="1">မနက်ပိုင်း</option>
                            <option value="2">ညနေပိုင်း</option>
                        </x-admin.select> --}}

                        <span wire:loading wire:target="statusFilter"
                            class="absolute right-2 top-2 text-gray-500 dark:text-gray-300">
                            <i class="fa-solid fa-spinner animate-spin"></i>

                        </span>
                        <label class="block text-sm text-gray-700 dark:text-gray-300">Date:</label>
                        <input type="date" wire:model.live.debounce.500ms="filterDate"
                            class="w-full mt-1 rounded-md dark:bg-gray-800 dark:text-white border-gray-300 dark:border-gray-600" />
                    </div>

                </div>
            </div>
        </div>

        {{-- Datatable --}}
        <x-admin.table>
            <!-- Header Slot -->
            <x-slot name="header">
                <tr class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-900 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">အသုံးပြုသူ</th>
                    <th scope="col" class="px-6 py-3">Threed နံပါတ်</th>
                    <th scope="col" class="px-6 py-3">ပမာဏ</th>
                    <th scope="col" class="px-6 py-3">date</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </x-slot>

            <!-- Body Slot -->
            <x-slot name="body">
                @forelse($threedBets as $index => $record)
                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $record->user->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $record->threedNumber->number ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-black dark:text-white">{{ $record->amount ?? '-' }} </span>
                        </td>
                        <td class="px-6 py-4">
                            {{ $record->created_at ? $record->created_at->format('d M, Y') : '-' }}</td>
                        <td class="px-6 py-4 relative">

                            <x-admin.action-dropdown>
                                @can('deposit_request_show')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="{{ route('admin.payment-record', ['action' => 'show', 'id' => $record->id]) }}"
                                            wire:navigate class="flex items-center gap-2 px-4 py-2">
                                            <i class="fa-solid fa-eye"></i> Show
                                        </a>
                                    </li>
                                @endcan
                                </x-action-dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-25 py-4 text-center text-gray-500 dark:text-gray-400">
                            ယနေ့အတွက်ထိုးစာရင်းများမရှိသေးပါ.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-admin.table>
        <x-admin.threedwin-modal title="လျော်မှာသေချာပါသလား?" />
    </div>

    <!-- Pagination -->
    <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-b-xl">
        {{-- {{ $users->links() }} --}}
        {{ $threedBets->links(data: ['scrollTo' => true]) }}

    </div>
</div>
