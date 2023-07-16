<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Blog Search') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Search blog.') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" method="post" action="{{ route('blog.search') }}">
        @csrf
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input class="mt-1 block w-full" id="title" name="title" type="text" :value="old('title', $param['title'] ?? null)" autofocus
                autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-checkbox>
                <x-input-checkbox-item id="published-0" name="published[]" value="0" label="非公開"
                    :checked="in_array(0, old('published', $param['published'] ?? []))" />
                <x-input-checkbox-item id="published-1" name="published[]" value="1" label="公開"
                    :checked="in_array(1, old('published', $param['published'] ?? []))" />
            </x-input-checkbox>
            <x-input-error class="mt-2" :messages="$errors->get('published')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Search') }}</x-primary-button>
        </div>
    </form>
</section>
