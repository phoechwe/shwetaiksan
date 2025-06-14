<div>
    <x-admin.pages-header title="Users" :breadcrumbs="[['label' => 'Users', 'url' => route('admin.users')], ['label' => 'List']]" :permission="Gate::check('user_create')" :route="route('admin.users', ['action' => 'create'])" />

    <!-- Table Container -->
    <div class="rounded-lg shadow-lg bg-primary-500 ">
        <!-- Search and Filters -->
        <div class="flex flex-wrap items-center justify-between p-4 bg-gray-100 dark:bg-gray-800 rounded-t-xl">
            <div class="w-22">
                <x-admin.inputs.input wire:model.live.debounce.500ms="search"
                    placeholder="Search users..."></x-admin.inputs.input>
            </div>

            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="px-4 py-2 bg-gray-200 dark:bg-gray-700 rounded-lg dark:text-white text-sm">
                    Filters
                    <i class="fa-solid fa-filter ml-2"></i>
                </button>
                <div x-show="open" @click.away="open = false"
                    class="absolute right-0 mt-2 w-48 bg-white dark:bg-gray-700 shadow-lg rounded-lg p-4 z-10">

                    <label class="block text-sm text-gray-700 dark:text-gray-300">Role:</label>

                    <div class="relative">
                        <x-admin.select wire:model="roleFilter" wire:change="filterUsers" class="additional-classes">
                            <option value="">Select Role</option>
                            @foreach ($availableRoles as $role)
                                <option value="{{ $role->id }}">{{ $role->title }}</option>
                            @endforeach
                        </x-admin.select>


                        <span wire:loading wire:target="roleFilter"
                            class="absolute right-2 top-2 text-gray-500 dark:text-gray-300">
                            <i class="fa-solid fa-spinner animate-spin"></i>

                        </span>

                    </div>

                    @error('roles')
                        <span class="text-red-500">{{ $message }}</span>
                    @enderror
                </div>
            </div>



        </div>

        {{-- Datatable --}}
        <x-admin.table>
            <!-- Header Slot -->
            <x-slot name="header">
                <tr class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-900 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">
                        <button wire:click="sortBy('name')" class="flex items-center">
                            Name <i class="fa-solid fa-sort ml-1"></i>
                        </button>
                    </th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Role</th>
                    <th scope="col" class="px-6 py-3">Create Date</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </x-slot>

            <!-- Body Slot -->
            <x-slot name="body">
                @forelse($users as $index => $user)
                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $user->name }}</td>
                        <td class="px-6 py-4">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            @foreach ($user->roles as $role)
                                <span
                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $role->title }}</span>
                            @endforeach
                        </td>
                        <td class="px-6 py-4">{{ $user->created_at ? $user->created_at->format('d M, Y') : '-' }}</td>
                        <td class="px-6 py-4 relative">
                            @php
                                $protectedRoles = ["Admin"]; // protect admin account
                                $hasProtectedRoles = $user->roles->pluck("title")->intersect($protectedRoles)->isNotEmpty();
                            @endphp
                           
                            {{-- @if (!$hasProtectedRoles) --}}
                                <x-admin.action-dropdown>
                                    @can('user_show')
                                        <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <a href="{{ route('admin.users', ['action' => 'show', 'id' => $user->id]) }}"
                                                class="flex items-center gap-2 px-4 py-2" wire:navigate>
                                                <i class="fa-solid fa-eye"></i> Show
                                            </a>
                                        </li>
                                    @endcan
                                    @can('user_edit')
                                        <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <button href="{{ route('admin.users', ['action' => 'edit', 'id' => $user->id]) }}"
                                                class="flex items-center gap-2 px-4 py-2" wire:navigate>
                                                <i class="fa-solid fa-edit"></i> Edit
                                            </button>
                                        </li>
                                    @endcan
                                    @can('user_delete')
                                        <li class="hover:bg-gray-100 dark:hover:bg-gray-600">
                                            <a href="#" class="flex items-center gap-2 px-4 py-2"
                                                wire:click.prevent='delete({{ $user->id }})' wire:confirm='Are you sure?'>
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a>
                                        </li>
                                    @endcan
                                </x-action-dropdown>
                            {{-- @endif --}}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No users found.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-admin.table>





    </div>

    <!-- Pagination -->
    <div class="p-4 bg-gray-100 dark:bg-gray-800 rounded-b-xl">
        {{-- {{ $users->links() }} --}}
        {{ $users->links(data: ['scrollTo' => true]) }}

    </div>
</div>
