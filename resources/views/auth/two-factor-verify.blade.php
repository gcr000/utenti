<x-guest-layout>
    <form method="POST" action="{{ route('2fa.verify.post') }}">
        @csrf

        <!-- 2FA Code -->
        <div>
            <x-input-label for="2fa_code" :value="__('Enter your 2FA code')" />
            <x-text-input id="2fa_code" class="block mt-1 w-full" type="text" name="2fa_code" required autofocus />
            <x-input-error :messages="$errors->get('2fa_code')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ml-3">
                {{ __('Verify 2FA') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
