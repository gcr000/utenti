<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('users.title') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <!-- Flex container for heading and button, switches to column on small screens -->
                    <div class="flex flex-col sm:flex-row justify-between sm:items-center">
                        <div class="col-8">
                            {{ __('users.welcome_msg') }}
                        </div>
                        <div class="col-4 mt-4 sm:mt-0 text-right">
                            <x-primary-a href="{{ route('users.create') }}">
                                + {{ __('users.table.add_button') }}
                            </x-primary-a>
                        </div>
                    </div>

                    <!-- Responsive table container with horizontal scrolling on mobile -->
                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full border-collapse border-gray-200">
                            <thead>
                                <tr class="border-b">
                                    <th class="text-start px-1 py-1"><b>{{ __('users.table.surname') }}</b></th>
                                    <th class="text-start px-1 py-1">{{ __('users.table.name') }}</th>
                                    <th class="text-start px-1 py-1">{{ __('users.table.email') }}</th>
                                    <th class="text-start px-1 py-1">{{ __('users.table.role') }}</th>
                                    <th class="text-end px-1 py-1"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                                        <td class="text-start px-1 py-1"><b>{{ $user->surname }}</b></td>
                                        <td class="text-start px-1 py-1">{{ $user->name }}</td>
                                        <td class="text-start px-1 py-1">{{ $user->email }}</td>
                                        <td class="text-start px-1 py-1">
                                            <div class="flex justify-center">
                                                @if($user->role_name == 'admin')
                                                    <img width="20px" height="10px" src="/king.png" alt="">
                                                @endif
                                                &nbsp; {{ $user->role_name }}
                                            </div>
                                        </td>
                                        <td class="text-end px-1 py-1">
                                            <x-primary-a href="{{ route('users.edit', $user->id) }}">
                                                {{ __('users.table.edit_button') }}
                                            </x-primary-a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
