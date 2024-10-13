<form action="{{ route('users.two_factor_disabled', $user->id) }}" class="">
    @csrf
    <x-danger-button>{{ __('profilo.2fa.disable_button') }}</x-danger-button>
</form>
