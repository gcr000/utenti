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
                        <div class="">
                            {{ __('users.welcome_msg') }}
                        </div>
                        <div class="mt-4 sm:mt-0 text-right flex">
                            {{--<input placeholder="{{ __('users.search_input') }}" type="text" class="w-64 me-4 inline-flex items-center py-2 dark:bg-gray-200 border rounded-md font-semibold text-xs dark:text-gray-800 uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150" />--}}

                            <div class="me-4 relative flex h-10 w-[500px] min-w-[200px] max-w-[24rem]">
                                <button
                                    class="!absolute right-1 top-1 z-10 select-none rounded bg-gray-800 py-2 px-4 text-center align-middle font-sans text-xs font-bold uppercase text-white shadow-md shadow-gray-800/20 transition-all hover:shadow-lg hover:shadow-gray-800/40 focus:opacity-[0.85] focus:shadow-none active:opacity-[0.85] active:shadow-none peer-placeholder-shown:pointer-events-none peer-placeholder-shown:bg-blue-gray-500 peer-placeholder-shown:opacity-50 peer-placeholder-shown:shadow-none"
                                    type="button"
                                    onclick="searchUser(this)"
                                    data-ripple-light="true"
                                >
                                    {{ __('users.search_input_button') }}
                                </button>
                                <input
                                    type="text"
                                    {{--onblur="clearInput(this)"--}}
                                    class="
                                    peer h-full w-full
                                    rounded-[7px] border border-blue-gray-200
                                    bg-transparent px-3 py-2.5 pr-20 font-sans
                                    text-sm font-normal text-blue-gray-700
                                    outline outline-0
                                    transition-all placeholder-shown:border
                                    placeholder-shown:border-blue-gray-200
                                    placeholder-shown:border-t-blue-gray-200
                                    focus:border-2 focus:border-gray-800 focus:border-t-transparent
                                    focus:outline-none disabled:border-0
                                    focus:ring-0
                                    focus:ring-offset-0
                                    disabled:bg-blue-gray-50
                                    "
                                    placeholder=" "
                                    required
                                />
                                <label class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none text-[11px] font-normal leading-tight text-blue-gray-400 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-800 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-800 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-800 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                    {{ __('users.search_input_label') }}
                                </label>
                            </div>

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
                            <tbody id="users_result">
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

                    <br>
                    <div id="links_div">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function searchUser(button) {

            let  inputElement = document.querySelector('input[type="text"]');
            let users_result = document.getElementById('users_result');
            let links_div = document.getElementById('links_div');
            button.innerHTML = '...';
            button.disabled = true;
            const searchValue = document.querySelector('input[type="text"]').value;

            if(searchValue.length < 4 || searchValue.trim().length === 0) {
                Swal.fire({
                    title: '{{ __('users.search_input_alert_error_title') }}',
                    text: '{{ __('users.search_input_alert_charachters') }}',
                    icon: "error",
                    showConfirmButton: false,
                });
                button.innerHTML = '{{ __('users.search_input_button') }}';
                button.disabled = false;
                inputElement.focus();
                inputElement.value = '';
                return;
            }

            let result = await fetch('/users_search', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ search: searchValue })
            })

            result = await result.text();

            button.innerHTML = '{{ __('users.search_input_button') }}';
            button.disabled = false;
            inputElement.value = '';

            if(result.length === 0) {
                Swal.fire({
                    title: '{{ __('users.search_input_alert_error_title') }}',
                    text: '{{ __('users.search_input_alert_no_results') }}',
                    icon: "error",
                    showConfirmButton: false,
                });
                return;
            }

            users_result.innerHTML = result;
            links_div.innerHTML = '';
        }

    </script>
</x-app-layout>
