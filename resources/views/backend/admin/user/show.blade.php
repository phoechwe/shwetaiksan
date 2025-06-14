<x-admin.showPage.show-page-display>
    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">Name</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ $name }}
            </span>
        </div>
    </x-admin.showPage.item>

    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">Email</span>
            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ $email }}
            </span>
        </div>
    </x-admin.showPage.item>

    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">Role</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
               @foreach ($role_title as $title )
                   {{$title}}
               @endforeach
            </span>
        </div>
    </x-admin.showPage.item>
    <x-slot name="button">
        <a class="bg-green-500 text-white hover:bg-green-600 px-2 py-2 rounded inline-block" wire:navigate
            href="{{ route('admin.users') }}">
            Back to List
        </a>
    </x-slot>

</x-admin.showPage.show-page-display>
