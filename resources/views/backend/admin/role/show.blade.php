<x-admin.showPage.show-page-display>
    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">Title</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ $title }}
            </span>
        </div>

    </x-admin.showPage.item>
    <x-admin.showPage.item>
        <div class="flex items-center ">
            <span class="w-60 font-semibold text-lg flex-shrink-0">Permission</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>
            <div class="text-sm font-medium text-gray-700 p-4">
            @forelse ($selectedPermissions as $key=> $permission)
            <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                {{ $permission }}
            </span>
        @empty
            <span
                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                No permissions assigned
            </span>
        @endforelse
            </div>
        </div>
    </x-admin.showPage.item>


    <x-slot name="button">
        <a class="bg-green-500 text-white hover:bg-green-600 px-2 py-2 rounded inline-block" wire:navigate
            href="{{ route('admin.role') }}">
            Back to List
        </a>
    </x-slot>

</x-admin.showPage.show-page-display>
