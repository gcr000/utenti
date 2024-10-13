<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('users.edit.additional_info_title') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("users.edit.additional_info_subtitle") }}
        </p>
    </header>

    <form method="post" action="{{ route('users.custom_update', $user->id) }}" class="mt-6 space-y-6">
        @method('patch')
        @csrf

        @foreach(\App\Models\Attribute::query()->get() as $attribute)
            <div>
                <x-input-label for="{{ $attribute->slug }}" :value="__('attributes.' . $attribute->slug)" />
                <input type="{{$attribute->type}}" class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
            </div>
        @endforeach

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('profilo.informazioni.save_button') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
