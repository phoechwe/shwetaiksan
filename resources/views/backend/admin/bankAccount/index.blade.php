<div>
    <x-admin.pages-header title="Bank Account" :breadcrumbs="[['label' => 'Bank Account', 'url' => route('admin.bank-account')], ['label' => 'List']]" :permission="Gate::check('bank_account_create_false')" :route="route('admin.customer', ['action' => 'create'])" />

    <!-- Table Container -->
    <div class="rounded-lg shadow-lg bg-primary-500 ">
        <!-- Search and Filters -->
        <div class="flex flex-wrap items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 rounded-t-xl">
            <div class="w-22">
                <x-admin.inputs.input wire:model.live.debounce.500ms="search"
                    placeholder="Search users..."></x-admin.inputs.input>
            </div>
        </div>

        {{-- Datatable --}}
        <x-admin.table>
            <!-- Header Slot -->
            <x-slot name="header">
                <tr class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-900 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">
                        <button class="flex items-center">
                            Bank Type
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-3">Account Number</th>
                    <th scope="col" class="px-6 py-3">Account Nmae</th>
                    <th scope="col" class="px-6 py-3">Update Date</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </x-slot>

            <!-- Body Slot -->
            <x-slot name="body">
                @forelse($bank_accounts as $index => $bank_account)
                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $bank_account->bank_type ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $bank_account->bank_name ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $bank_account->account_number ?? '-' }}</td>
                        <td class="px-6 py-4">{{ $bank_account->updated_at ? $bank_account->updated_at->format('d M, Y') : '-' }}</td>
                        <td class="px-6 py-4 relative">
                            <x-admin.action-dropdown>
                                {{-- @can('bank_account_show')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="{{ route('admin.customer', ['action' => 'show', 'id' => $bank_account->id]) }}"
                                            class="flex items-center gap-2 px-4 py-2" wire:navigate>
                                            <i class="fa-solid fa-eye"></i> Show
                                        </a>
                                    </li>
                                @endcan --}}
                                @can('bank_account_edit')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <button href="{{ route('admin.bank-account', ['action' => 'edit', 'id' => $bank_account->id]) }}"
                                            class="flex items-center gap-2 px-4 py-2" wire:navigate>
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </button>
                                    </li>
                                @endcan
                                {{-- @can('bank_account_delete')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="#" class="flex items-center gap-2 px-4 py-2"
                                            wire:click.prevent='delete({{ $bank_account->id }})' wire:confirm='Are you sure?'>
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </a>
                                    </li>
                                @endcan --}}
                                </x-action-dropdown>
                        </td>
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
    </div>

    <!-- Pagination -->
    <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-b-xl">
        {{-- {{ $bank_accounts->links() }} --}}
        {{ $bank_accounts->links(data: ['scrollTo' => true]) }}

    </div>
</div>
