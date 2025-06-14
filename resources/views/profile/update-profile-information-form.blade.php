<div>
    <h4 class="text-lg font-medium text-gray-900 dark:text-white">
        {{ __('Your profile Information') }}
    </h4>

    <p class="mt-1 text-sm text-gray-600 dark:text-white">
        {{ __('Update your account\'s profile information and email address.') }}
    </p>

    <form class="mt-6 col-span-4 w-full xl:w-3/4" wire:submit.prevent="updateProfileInformation" method="POST">
        @csrf

        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4 m-4">
                <!-- Profile Photo File Input -->
                <input type="file" id="photo" class="hidden" wire:model.live="photo" x-ref="photo"
                    x-on:change="
                                  photoName = $refs.photo.files[0].name;
                                  const reader = new FileReader();
                                  reader.onload = (e) => {
                                      photoPreview = e.target.result;
                                  };
                                  reader.readAsDataURL($refs.photo.files[0]);
                          " />

                <x-admin.label for="photo" value="{{ __('Photo') }}" label="Photo" required="false" />

                <!-- Current Profile Photo -->
                <div class="mt-2 mb-3" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>


                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>
                <x-admin.inputs.button-secondary class="mt-5 me-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-inputs.button-secondary>

                @if ($this->user->profile_photo_path)
                    <x-admin.inputs.button-secondary type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-inputs.button-secondary>
                @endif

                {{-- <x-admin.inputs.input-error for="photo" class="mt-2" /> --}}
            </div>
        @endif

        
        <x-admin.inputs.form-input type="text" id="name" label="Name" placeholder="Enter your name" required="true"
            extra="wire:model.defer='state.name'" />

        <x-admin.inputs.form-input type="email" id="email" label="Email" placeholder="Enter your email"  required="true"
            extra="wire:model.defer='state.email'" />

        @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::emailVerification()) &&
                !$this->user->hasVerifiedEmail())
            <p class="text-sm mt-2 dark:text-white">
                {{ __('Your email address is unverified.') }}

                <button type="button"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 dark:text-gray-100 focus:ring-indigo-500"
                    wire:click.prevent="sendEmailVerification">
                    {{ __('Click here to re-send the verification email.') }}
                </button>
            </p>

            @if ($this->verificationLinkSent)
                <p class="mt-2 font-medium text-sm text-green-600">
                    {{ __('A new verification link has been sent to your email address.') }}
                </p>
            @endif
        @endif

        <x-admin.inputs.button-primary class="mt-4" wire:loading.attr="disabled" wire:target="updateProfileInformation">
            <i class="fa-solid fa-pen-to-square mr-2" wire:loading.class="fa-beat-fade"
                wire:target="updateProfileInformation"></i>
            {{ __('Change') }}
        </x-inputs.button-primary>
    </form>
</div>
