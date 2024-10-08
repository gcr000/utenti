<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('profilo.2fa.title') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('profilo.2fa.description') }}
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
            <x-primary-button>{{ __('profilo.2fa.enable_button') }}</x-primary-button>
        @else
            <x-danger-button>{{ __('profilo.2fa.disable_button') }}</x-danger-button>
        @endif
    </form>
</section>
