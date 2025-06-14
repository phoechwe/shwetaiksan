<div>
    <x-admin.pages-header title="Permission" :breadcrumbs="[['label' => 'Permission', 'url' => route('admin.permission')], ['label' => 'List']]" :permission="Gate::check('permission_create')" :route="route('admin.permission', ['action' => 'create'])" />

    <!-- Table Container -->
    <div class="rounded-lg shadow-lg bg-primary-500 ">
        <!-- Search and Filters -->
        <div class="flex flex-wrap items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 rounded-t-xl">
            <div class="w-22">
                <x-admin.inputs.input wire:model.live.debounce.500ms="search"
                    placeholder="Search permissions..."></x-admin.inputs.input>
            </div>

            {{-- <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg dark:text-white text-sm">
                    Filters
                    <i class="fa-solid fa-filter ml-2"></i>
                </button>
            </div> --}}
        </div>

        {{-- Datatable --}}
        <x-admin.table>
            <!-- Header Slot -->
            <x-slot name="header">
                <tr class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-900 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Create Date</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </x-slot>

            <!-- Body Slot -->
            <x-slot name="body">
                @forelse($permissions    as $index => $permission)
                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $permission->title }}</td>
                        <td class="px-6 py-4">
                            {{ $permission->created_at ? $permission->created_at->format('d M, Y') : '-' }}</td>
                        <td class="px-6 py-4 relative">

                            <x-admin.action-dropdown>
                                @can('permission_show')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="{{ route('admin.permission', ['action' => 'show', 'id' => $permission->id]) }}"
                                            class="flex items-center gap-2 px-4 py-2">
                                            <i class="fa-solid fa-eye"></i> Show
                                        </a>
                                    </li>
                                @endcan
                                @can('permission_edit')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="{{ route('admin.permission', ['action' => 'edit', 'id' => $permission->id]) }}"
                                            class="flex items-center gap-2 px-4 py-2">
                                            <i class="fa-solid fa-edit"></i> Edit
                                        </a>
                                    </li>
                                @endcan
                                @can('permission_delete')
                                    <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                        <a href="#" class="flex items-center gap-2 px-4 py-2"
                                            wire:click.prevent='delete({{ $permission->id }})' wire:confirm='Are you sure?'>
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </a>
                                    </li>
                                @endcan
                                </x-action-dropdown>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No permission found.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-admin.table>


    </div>

    <!-- Pagination -->
    <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-b-xl">
        {{-- {{ $users->links() }} --}}
        {{ $permissions->links(data: ['scrollTo' => true]) }}

    </div>
</div>
