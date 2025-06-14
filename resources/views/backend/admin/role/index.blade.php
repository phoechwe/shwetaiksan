<div>
    <x-admin.pages-header title="Roles" :breadcrumbs="[['label' => 'Roles', 'url' => route('admin.role')], ['label' => 'List']]" :permission="Gate::check('role_create')" :route="route('admin.role', ['action' => 'create'])" />

    <!-- Table Container -->
    <div class="rounded-lg shadow-lg bg-primary-500 ">
        <!-- Search and Filters -->
        <div class="flex flex-wrap items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 rounded-t-xl">
            <div class="w-22">
                <x-admin.inputs.input wire:model.live.debounce.500ms="search"
                    placeholder="Search roles..."></x-admin.inputs.input>
            </div>

            {{-- <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg dark:text-white text-sm">
                    Filters
                    <i class="fa-solid fa-filter ml-2"></i>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 shadow-lg rounded-lg p-4 z-10">
                    <label class="block text-sm text-gray-700 dark:text-gray-300">Role:</label>
                    <select wire:model="roleFilter"
                        class="w-full mt-1 border rounded-lg dark:bg-gray-700 dark:text-white">
                        <i class="fa-solid fa-sort ml-1"></i>
                        <option value="">All</option>
                        <option value="admin">Admin</option>
                        <option value="user">User</option>
                    </select>
                </div>
            </div> --}}
        </div>

        {{-- Datatable --}}
        <x-admin.table>
            <!-- Header Slot -->
            <x-slot name="header">
                <tr class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-900 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">Title</th>
                    <th scope="col" class="px-6 py-3">Permissions</th>
                    <th scope="col" class="px-6 py-3">Create Date</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </x-slot>

            <!-- Body Slot -->
            <x-slot name="body">
                @forelse($roles    as $index => $role)
                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $role->title }}</td>
                        <td class="px-6 py-4">
                            @forelse ($role->permissions as $permission)
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                        {{ $permission->title }}
                                    </span>
                                @empty
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                        No permissions assigned
                                    </span>
                                @endforelse
                        </td>
                        <td class="px-6 py-4">{{ $role->created_at ? $role->created_at->format('d M, Y') : '-' }}</td>
                        <td class="px-6 py-4 relative">
                            <x-admin.action-dropdown>
                                @can('role_show')
                                <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <a href="{{ route('admin.role', ['action' => 'show', 'id' => $role->id]) }}" class="flex items-center gap-2 px-1 py-2" >
                                        <i class="fa-solid fa-eye"></i> Show
                                    </a>
                                </li>
                                @endcan
                                @can('role_edit')
                                <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <a href="{{ route('admin.role', ['action' => 'edit', 'id' => $role->id]) }}" class="flex items-center gap-2 px-1 py-2" >
                                        <i class="fa-solid fa-edit"></i> Edit
                                    </a>
                                </li>
                                @endcan
                                @can('role_delete')
                                <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                    <a href="#" class="flex items-center gap-2 px-1 py-2"
                                        wire:click.prevent='delete({{ $role->id }})' wire:confirm='Are you sure?'>
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
                            No role found.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-admin.table>


    </div>

    <!-- Pagination -->
    <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-b-xl">
        {{-- {{ $users->links() }} --}}
        {{ $roles->links(data: ['scrollTo' => true]) }}

    </div>
</div>
