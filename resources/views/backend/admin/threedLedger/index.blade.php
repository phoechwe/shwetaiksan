<div>
    <x-admin.pages-header title="3D လယ်ဂျာ" :breadcrumbs="[['label' => '3D လယ်ဂျာ', 'url' => route('admin.threed-ledger')], ['label' => 'List']]" :permission="Gate::check('threed_ledger_create')" :route="route('admin.threed-ledger', ['action' => 'create'])" />

    <!-- Table Container -->
    <div class="rounded-lg shadow-lg bg-primary-500">
        <!-- Search and Filters -->
        <div class="flex flex-wrap items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 rounded-t-xl">
            <div class="w-22">
                <x-admin.inputs.input wire:model.live.debounce.500ms="search"
                    placeholder="Search ledgers..."></x-admin.inputs.input>
            </div>
        </div>

        {{-- Datatable --}}
        <x-admin.table>
            <!-- Header Slot -->
            <x-slot name="header">
                <tr class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-900 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">
                        စာရင်းဖွင့်သည့်ရက်စွဲ
                    </th>
                    <th scope="col" class="px-6 py-3">စာရင်းပိတ်သည့်ရက်စွဲ</th>
                    <th scope="col" class="px-6 py-3">သတ်မှတ်ပမာဏ</th>
                    <th scope="col" class="px-6 py-3">သတ်မှတ်ပမာဏ စုစုပေါင်း</th>
                    <th scope="col" class="px-6 py-3">ထိုးငွေပမာဏ စုစုပေါင်း</th>
                    <th scope="col" class="px-6 py-3">စာရင်းပိတ်ချိန်</th>
                    <th scope="col" class="px-6 py-3">စာရင်းသွင်းသည့်ရက်</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </x-slot>

            <!-- Body Slot -->
            <x-slot name="body">
                @forelse($twodledgers as $index => $ledger)
                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $ledger->start_date ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $ledger->end_date ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <span
                                class="font-bold text-black dark:text-white">{{ number_format($ledger->amount ?? '-') }}</span>
                            {{-- <span class="font-bold text-black dark:text-white">MMK</span> --}}
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="font-bold text-black dark:text-white">{{ number_format($ledger->amount * 100 ?? '-') }}</span>
                            {{-- <span class="font-bold text-black dark:text-white">MMK</span> --}}
                        </td>
                        <td class="px-6 py-4">
                            <span
                                class="font-bold text-black dark:text-white">{{ number_format($ledger->threedLedgerNumbers->sum('amount')) ?? 0 }}</span>
                            {{-- <span class="font-bold text-black dark:text-white">MMK</span> --}}
                        </td>
                        <td class="px-6 py-4">
                            {{ \Carbon\Carbon::parse($ledger->end_time)->format('g:i A') ?? '-' }}
                        </td>

                        <td class="px-6 py-4">{{ $ledger->created_at ? $ledger->created_at->format('d M, Y') : '-' }}
                        </td>
                        <td class="px-6 py-4 relative">
                            <x-admin.action-dropdown>
                                @can('threed_ledger_show')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="{{ route('admin.threed-ledger', ['action' => 'show', 'id' => $ledger->id]) }}"
                                            class="flex items-center gap-2 px-4 py-2" wire:navigate>
                                            <i class="fa-solid fa-eye"></i> Details
                                        </a>
                                    </li>
                                @endcan
                                @can('threed_ledger_edit')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="{{ route('admin.threed-ledger', ['action' => 'edit', 'id' => $ledger->id]) }}"
                                            class="flex items-center gap-2 px-4 py-2" wire:navigate>
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                    </li>
                                @endcan
                                @can('threed_ledger_delete')
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
                        <td colspan="9" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No Ledger found.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-admin.table>
    </div>

    <!-- Pagination -->
    <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-b-xl">
        {{ $twodledgers->links(data: ['scrollTo' => true]) }}
    </div>
</div>
