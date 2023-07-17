<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Message Search') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Search message.') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" method="post" action="{{ route('message.search') }}">
        @csrf
        <div>
            <x-input-label for="message" :value="__('Message')" />
            <x-text-input class="mt-1 block w-full" id="message" name="message" type="text" :value="old('message', $param['message'] ?? null)" autofocus
                autocomplete="message" />
            <x-input-error class="mt-2" :messages="$errors->get('message')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Search') }}</x-primary-button>
        </div>
    </form>
</section>
