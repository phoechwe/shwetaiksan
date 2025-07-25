<div>
    <x-admin.pages-header title="2D/3D မှတ်တမ်း" :breadcrumbs="[['label' => '2D/3D မှတ်တမ်း', 'url' => route('admin.twod-threed-record')], ['label' => 'List']]" :permission="Gate::check('twod_threed_record_create_false')" :route="route('admin.two-d-ledger', ['action' => 'create'])" />

    <!-- Table Container -->
    <div class="rounded-lg shadow-lg bg-primary-500">
        <!-- Search and Filters -->
        <div class="flex flex-wrap items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 rounded-t-xl">
            <div class="w-22">
                <x-admin.inputs.input wire:model.live.debounce.500ms="search"
                    placeholder="Search ledgers..."></x-admin.inputs.input>
            </div>

             <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg dark:text-white text-sm">
                    Filters
                    <i class="fa-solid fa-filter ml-2"></i>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 shadow-lg rounded-lg p-4 z-10">

                    <label class="block text-sm text-gray-700 dark:text-gray-300">Status:</label>

                    <div class="relative">
                        <x-admin.select wire:model="statusFilter" wire:change="filterStatus" class="additional-classes">
                            <option value="">Status</option>
                            <option value="1">Bet</option>
                            <option value="2">Win</option>
                            <option value="2">Lucky</option>
                        </x-admin.select>

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
                    <th scope="col" class="px-6 py-3">Member</th>
                    <th scope="col" class="px-6 py-3">Number</th>
                    <th scope="col" class="px-6 py-3">Amount</th>
                    <th scope="col" class="px-6 py-3">Type</th>
                    <th scope="col" class="px-6 py-3">Status</th>
                    <th scope="col" class="px-6 py-3">date</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </x-slot>

            <!-- Body Slot -->
            <x-slot name="body">
                @forelse($twodThreedRecords as $index => $ledger)
                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $ledger->user->name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $ledger->number ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="font-bold text-black dark:text-white">{{ number_format($ledger->amount ?? '-') }}</span>
                            {{-- <span class="font-bold text-black dark:text-white">MMK</span> --}}
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="text-black dark:text-white">{{ config('constant.twod_threed_type.' . $ledger->type, '-') }}</span>
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="inline-flex items-center justify-center px-4 py-2 rounded-md text-white
            {{ $ledger->status == 1 ? 'bg-orange-500 hover:bg-orange-400' : ($ledger->status == 2 || $ledger->status == 3 ? 'bg-green-600 hover:bg-green-500' : 'bg-gray-500') }}">
                                {{ config('constant.twod_threed_status.' . $ledger->status, '-') }}
                            </span>
                        </td>


                        <td class="px-6 py-4">{{ $ledger->created_at ? $ledger->created_at->format('d M, Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 relative">
                            <x-admin.action-dropdown>
                                @can('two_d_ledger_show')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="{{ route('admin.two-d-ledger', ['action' => 'show', 'id' => $ledger->id]) }}"
                                            class="flex items-center gap-2 px-4 py-2" wire:navigate>
                                            <i class="fa-solid fa-eye"></i> Details
                                        </a>
                                    </li>
                                @endcan

                                @can('two_d_ledger_delete')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="#" class="flex items-center gap-2 px-4 py-2"
                                            wire:click.prevent='destory({{ $ledger->id }})' wire:confirm='Are you sure?'>
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </a>
                                    </li>
                                @endcan
                            </x-admin.action-dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No Record found.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-admin.table>
    </div>

    <!-- Pagination -->
    <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-b-xl">
        {{ $twodThreedRecords->links(data: ['scrollTo' => true]) }}
    </div>
</div>
