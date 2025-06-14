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
            <span class="w-60 font-semibold text-lg flex-shrink-0">ပမာဏ</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ $amount ?? '0' }}
                <span class="font-bold text-black dark:text-white">MMK</span>
            </span>
        </div>
    </x-admin.showPage.item>

    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">အကောင့်အမည်</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ $account_name ?? '-' }}
            </span>
        </div>
    </x-admin.showPage.item>

    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">အကောင့်နံပါတ်</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ $account_number ?? '-' }}
            </span>
        </div>
    </x-admin.showPage.item>

    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">Bank အမျိးအစား</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ $bank_type ?? '-' }}
            </span>
        </div>
    </x-admin.showPage.item>

    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">အခြေအနေ</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
                {{ config('constant.paid_status.' . $status, '-') }}

            </span>
        </div>
    </x-admin.showPage.item>

    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">တောင်းဆိုရက်စွဲ</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
               {{ $created_at ? $created_at->format('d M, Y') : '-' }}

            </span>
        </div>
    </x-admin.showPage.item>

    <x-admin.showPage.item>
        <div class="flex items-center w-full">
            <span class="w-60 font-semibold text-lg flex-shrink-0">အတည်ပြုရက်စွဲ</span>

            <span class=" mr-2 flex-shrink-0">
                <i class="fa-solid fa-ellipsis-vertical"></i>
            </span>

            <span class="ml-2 text-sm font-medium overflow-hidden  text-ellipsis">
               {{ $updated_at ? $updated_at->format('d M, Y') : '-' }}

            </span>
        </div>
    </x-admin.showPage.item>


    <x-slot name="button">
        <a class="bg-green-500 text-white hover:bg-green-600 px-2 py-2 rounded inline-block" wire:navigate
            href="{{ route('admin.withdrawl') }}">
            Back to List
        </a>
    </x-slot>

</x-admin.showPage.show-page-display>
