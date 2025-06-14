<div>
    <aside
        class="fixed top-0 left-0 lg:z-40 w-64 h-screen pt-14 transition-transform duration-500 bg-white border-r border-gray-200 dark:bg-gray-900 dark:border-gray-700"
        :class="{ '-translate-x-full': !$store.sidebar.isSidebarOpen, 'translate-x-0': $store.sidebar.isSidebarOpen }">
        <div class="overflow-y-auto py-5 px-3 h-full bg-white dark:bg-gray-900">
            <ul class="space-y-2">
                <form action="#" method="GET" class=" mb-2">
                    <label for="sidebar-search" class="sr-only">Search</label>
                    <div class="relative">
                        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                            <i class="fa-solid fa-magnifying-glass text-gray-500"></i>
                        </div>
                        <input type="text" name="search" id="sidebar-search"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500"
                            placeholder="Search" />
                    </div>
                </form>
                {{-- Dashboard --}}
                {{-- <x-layout.sub.sidebar-item label="{{ __('Dashboard') }}" icon="fa-solid fa-house"
                    route="{{ route('admin.dashboard') }}" :active="request()->routeIs('admin.dashboard')" /> --}}

                {{-- User Access --}}
                {{-- <x-layout.sub.sidebar-group id="" label="{{ __('UserManagement') }}" icon="fa-solid fa-users"
                    :active="request()->routeIs('admin.users') ||
                        request()->routeIs('admin.permission') ||
                        request()->routeIs('admin.role') ||
                        request()->routeIs('admin.classSchedules')">

                    @can('user_access')
                        <x-layout.sub.sidebar-group-item label="{{ __('User') }}" route="{{ route('admin.users') }}"
                            :active="request()->routeIs('admin.users')" />
                    @endcan

                    @can('permission_access')
                        <x-layout.sub.sidebar-group-item label="{{ __('Permission') }}"
                            route="{{ route('admin.permission') }}" :active="request()->routeIs('admin.permission')" />
                    @endcan

                    @can('role_access')
                        <x-layout.sub.sidebar-group-item label="{{ __('Role') }}" route="{{ route('admin.role') }}"
                            :active="request()->routeIs('admin.role')" />
                    @endcan

                </x-layout.sub.sidebar-group> --}}

                {{-- Customer --}}
                @can('customer_access')
                    <x-layout.sub.sidebar-item label="{{ __('Customer') }}" icon="fa-solid fa-user-tie"
                        route="{{ route('admin.customer') }}" :active="request()->routeIs('admin.customer')" />
                @endcan

                {{-- TotalBalance --}}
                @can('total_balance_access')
                    <x-layout.sub.sidebar-item label="{{ __('Total Balance') }}" icon="fa-solid fa-circle-dollar-to-slot"
                        route="{{ route('admin.total-balance') }}" :active="request()->routeIs('admin.total-balance')" />
                @endcan

                {{-- Bank Account --}}
                @can('bank_account_access')
                    <x-layout.sub.sidebar-item label="{{ __('ဘဏ်အကောင့်များ') }}" icon="fa-solid fa-building-columns"
                        route="{{ route('admin.bank-account') }}" :active="request()->routeIs('admin.bank-account')" />
                @endcan

                {{-- Deposit Request --}}
                @can('deposit_request_access')
                    <x-layout.sub.sidebar-item label="{{ __('ငွေသွင်းစာရင်း') }}" icon="fa-solid fa-building-columns"
                        route="{{ route('admin.deposit-request') }}" :active="request()->routeIs('admin.deposit-request')" />
                @endcan

                {{-- Deposit Request --}}
                @can('withdrawl_access')
                    <x-layout.sub.sidebar-item label="{{ __('ငွေထုတ်စာရင်း') }}" icon="fa-solid fa-building-columns"
                        route="{{ route('admin.withdrawl') }}" :active="request()->routeIs('admin.withdrawl')" />
                @endcan

                {{-- Deposit Request --}}
                @can('payment_record_access')
                    <x-layout.sub.sidebar-item label="{{ __('ငွေသွင်း/ငွေထုတ်မှတ်တမ်း') }}"
                        icon="fa-solid fa-building-columns" route="{{ route('admin.payment-record') }}"
                        :active="request()->routeIs('admin.payment-record')" />
                @endcan

                {{-- Two D Ledger --}}
                @can('two_d_ledger_access')
                    <x-layout.sub.sidebar-item label="{{ __('2D လယ်ဂျာ') }}" icon="fa-solid fa-building-columns"
                        route="{{ route('admin.two-d-ledger') }}" :active="request()->routeIs('admin.two-d-ledger')" />
                @endcan

                @can('two_d_ledger_access')
                    <x-layout.sub.sidebar-item label="{{ __('2D စာရင်းမှတ်တမ်း') }}" icon="fa-solid fa-building-columns"
                        route="{{ route('admin.two-d-bet') }}" :active="request()->routeIs('admin.two-d-bet')" />
                @endcan

                @can('twod_threed_record_access')
                    <x-layout.sub.sidebar-item label="{{ __('2d/3d ထိုးစားရင်း') }}" icon="fa-solid fa-building-columns"
                        route="{{ route('admin.twod-threed-record') }}" :active="request()->routeIs('admin.twod-threed-record')" />
                @endcan
            </ul>
        </div>
    </aside>
</div>
