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
