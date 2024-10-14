<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('users.edit.title') }}
        </h2>
    </x-slot>


            <div class="py-12">
                <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 space-y-6">
                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-8xl">
                            @include('users.edit.general_info')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-xl">
                            @include('users.edit.additional_info')
                        </div>
                    </div>

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-8xl">
                            @include('users.edit.update_password')
                        </div>
                    </div>

                    @if($user->google2fa_enabled)
                        <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                            <div class="max-w-8xl">
                                @include('users.edit.twofactor_authentication_reset')
                            </div>
                        </div>
                    @endif

                    <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                        <div class="max-w-8xl">
                            @include('users.edit.delete_user')
                        </div>
                    </div>
                </div>
            </div>

</x-app-layout>
