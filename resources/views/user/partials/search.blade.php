<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('User Search') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Search user.') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" method="post" action="{{ route('user.search') }}">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input class="mt-1 block w-full" id="name" name="name" type="text" :value="old('name', $param['name'] ?? null)" autofocus
                autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Search') }}</x-primary-button>
        </div>
    </form>
</section>
