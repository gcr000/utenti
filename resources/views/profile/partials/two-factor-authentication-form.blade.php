<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Google 2FA') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Aggiungi un livello di sicurezza aggiuntivo al tuo account utilizzando Google Authenticator.') }}
        </p>

        @if($qrCode)
            <div class="mt-6">
                {{ $qrCode }}
            </div>
        @endif
    </header>

    <form method="post" action="{{ route('two-factor.enable') }}" class="">
        @csrf

        @if(!Auth::user()->google2fa_secret)
            <x-primary-button>{{ __('Abilita') }}</x-primary-button>
        @else
            <x-danger-button>{{ __('Disabilita') }}</x-danger-button>
        @endif
    </form>
</section>
