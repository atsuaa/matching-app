<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Blog Information') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Create new blog.') }}
        </p>
    </header>

    <form class="mt-6 space-y-6" method="post" action="{{ route('blog.store') }}">
        @csrf
        <div>
            <x-input-label for="title" :value="__('Title')" />
            <x-text-input class="mt-1 block w-full" id="title" name="title" type="text" :value="old('title', $blog?->title)" required
                autofocus autocomplete="title" />
            <x-input-error class="mt-2" :messages="$errors->get('title')" />
        </div>

        <div>
            <x-input-label for="body" :value="__('Body')" />
            <x-textarea-wysiwyg-editor id="body" name="body" :value="old('body', $blog?->body)" required="required" />
            <x-input-error class="mt-2" :messages="$errors->get('body', $blog?->body)" />
        </div>

        <div>
            <x-input-radio>
                <x-input-radio-item id="published-0" name="published" value="0" label="非公開" :checked="old('published', $blog?->published) == 0" />
                <x-input-radio-item id="published-1" name="published" value="1" label="公開" :checked="old('published', $blog?->published) == 1" />
            </x-input-radio>
            <x-input-error class="mt-2" :messages="$errors->get('published')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</section>
