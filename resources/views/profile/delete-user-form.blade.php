<div class="bg-white dark:bg-gray-800 sm:rounded-lg">
    <div class="px-4 py-5 sm:p-6">
        <h3 class="text-lg font-medium text-gray-900 dark:text-white">
            {{ __('Delete Account') }}
        </h3>
        <div class="mt-2 max-w-xl text-sm text-gray-600 dark:text-gray-400">
            <p>
                {{ __('Permanently delete your account.') }}
            </p>
        </div>
        <div class="mt-5">
            <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-300" wire:click="confirmUserDeletion" wire:loading.attr="disabled">
                {{ __('Delete Account') }}
            </button>
        </div>
    </div>

    <!-- Delete User Confirmation Modal -->
    <div x-data="{ open: @entangle('confirmingUserDeletion') }" x-show="open" class="fixed transition  inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50"  x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-md">
            <div class="p-6">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                    {{ __('Delete Account') }}
                </h3>
                <div class="mt-4 text-sm text-gray-600 dark:text-gray-400">
                    <p>
                        {{ __('Are you sure you want to delete your account? Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                    </p>
                </div>
                <div class="mt-4">
                    <input type="password" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white" placeholder="{{ __('Password') }}" wire:model="password" wire:keydown.enter="deleteUser" />
                    @error('password')
                        <p class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="flex justify-end p-6 bg-gray-100 dark:bg-gray-700 rounded-b-lg">
                <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring focus:ring-gray-300 active:bg-gray-800 disabled:opacity-25 transition dark:bg-gray-600 dark:hover:bg-gray-500 dark:focus:ring-gray-400" wire:click="$toggle('confirmingUserDeletion')" wire:loading.attr="disabled">
                    {{ __('Cancel') }}
                </button>
                <button type="button" class="inline-flex items-center justify-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-200 active:bg-red-600 disabled:opacity-25 transition dark:bg-red-500 dark:hover:bg-red-400 dark:focus:ring-red-300 ms-3" wire:click="deleteUser" wire:loading.attr="disabled">
                    {{ __('Delete Account') }}
                </button>
            </div>
        </div>
    </div>
</div>