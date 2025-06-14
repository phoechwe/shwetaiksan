<div>
    <x-admin.pages-header title="2D ဂဏန်းအချုပ်" :breadcrumbs="[['label' => '2D လယ်ဂျာ', 'url' => route('admin.two-d-ledger')], ['label' => 'List']]" :permission="Gate::check('two_d_ledger_create_false')" :route="route('admin.two-d-ledger', ['action' => 'create'])" />

    <!-- Table Container -->
    <div class="rounded-lg shadow-lg bg-primary-500">

        {{-- Datatable --}}
        <x-admin.table>
            <!-- Header Slot -->
            <x-slot name="header">
                <tr class="text-xs text-gray-700 uppercase bg-gray-200 dark:bg-gray-900 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3">No</th>
                    <th scope="col" class="px-6 py-3">
                        ရက်စွဲ
                    </th>
                    <th scope="col" class="px-6 py-3">မနက်/ညနေ</th>
                    <th scope="col" class="px-6 py-3">ဂဏန်း</th>
                    <th scope="col" class="px-6 py-3">သတ်မှတ်ပမာဏ</th>
                    <th scope="col" class="px-6 py-3">ထိုးငွေပမာဏ စုစုပေါင်း</th>
                </tr>
            </x-slot>

            <!-- Body Slot -->
            <x-slot name="body">
                @forelse($twodledgerNumberBalances as $index => $ledger)
    
                    <tr
                        class="bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                        <td class="px-6 py-4">{{ $index + 1 }}</td>
                        <td class="px-6 py-4">{{ $ledger['date'] }}</td>
                        <td>
                            <span
                                class="text-black dark:text-white">{{ config('constant.session_time.' . $ledger['session_time'], '-') }}</span>
                        </td>
                        <td class="px-6 py-4">{{ $ledger['number'] }}</td>

                        <td class="px-6 py-4">
                            <span class="font-bold text-black dark:text-white">{{ $ledger['limit_amount'] ?? 0 }}</span>
                            <span class="font-bold text-black dark:text-white">MMK</span>
                        </td>
                        <td class="px-6 py-4">
                            <span class="font-bold text-black dark:text-white">{{ $ledger['total_bet_amount'] ?? 0 }}</span>
                            <span class="font-bold text-black dark:text-white">MMK</span>
                        </td>

                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                            No Ledger found.
                        </td>
                    </tr>
                @endforelse
            </x-slot>
        </x-admin.table>
    </div>
</div>
