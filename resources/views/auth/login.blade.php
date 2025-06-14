
<x-guest-layout>
    <div class="flex flex-col items-center justify-center px-6 pt-8 mx-auto md:h-screen pt:mt-0 dark:bg-gray-900">
        <!-- Card -->
        <div class="w-full border-t-4 border-t-primary-500 max-w-xl bg-white rounded-lg shadow-md dark:bg-gray-800">

            <div class="border-b px-4 py-6">
                <a href="/"
                    class="flex items-center justify-center md:text-xl xl:text-2xl font-semibold dark:text-white">
                    <img src="#" class="mr-3 h-20 xl:h-20" alt=" Logo" />

                </a>
            </div>

            <div class=" px-6 pt-6 xl:pb-3 space-y-6 sm:px-8">
                <h3 class="text-lg xl:text-xl text--center font-medium text-gray-900 dark:text-white">
                    Login To Your Account
                </h3>

                @if (session('status'))
                    <div class="mt-6 font-medium text-md text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div>
                        <x-admin.label for="email" value="{{ __('Email') }}" label="Email" />
                        <x-admin.inputs.input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autofocus autocomplete="username" />
                    </div>

                    <div class="mt-4">
                        <x-admin.label for="password" value="{{ __('Password') }}" label="Password" />
                        <x-admin.inputs.input id="password" class="block mt-1 w-full" type="password" name="password"  autocomplete="current-password" />
                    </div>

                    <div class="block mt-4">
                        <label for="remember_me" class="flex items-center">
                            <x-admin.inputs.checkbox id="remember_me" name="remember" />
                            <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-end mt-4">
                        @if (Route::has('password.request'))
                            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif

                        <x-admin.inputs.button-primary class="ms-4">
                            {{ __('Log in') }}
                        </x-admin.inputs.button-primary>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
