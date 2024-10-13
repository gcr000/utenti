<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profilo.2fa.title') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profilo.2fa.description') }}
        </p>

    </header>


    <form action="{{ route('users.two_factor_disabled', $user->id) }}" class="mt-4">
        @csrf
        <x-danger-button>{{ __('profilo.2fa.disable_button') }}</x-danger-button>
    </form>
</section>
