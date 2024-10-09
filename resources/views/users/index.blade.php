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
                    {{ __('users.welcome_msg') }}

                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full border-collapse  border-gray-200">
                            <thead>
                            <tr class="border-b">
                                <th class="text-start">{{ __('users.table.name') }}</th>
                                <th class="text-start">{{ __('users.table.surname') }}</th>
                                <th class="text-start">{{ __('users.table.email') }}</th>
                                <th class="text-start">{{ __('users.table.role') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-start">{{ $user->name }}</td>
                                    <td class="text-start">{{ $user->surname }}</td>
                                    <td class="text-start">{{ $user->email }}</td>
                                    <td class="text-start">{{ $user->role_name }}</td>
                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
