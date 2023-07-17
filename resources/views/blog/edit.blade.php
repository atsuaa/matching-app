<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Blog Edit') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
            <div class="bg-white p-4 shadow sm:rounded-lg sm:p-8">
                <div class="max-w-xl">
                    <section>
                        <header>
                            <h2 class="text-lg font-medium text-gray-900">
                                {{ __('Blog Information') }}
                            </h2>

                            <p class="mt-1 text-sm text-gray-600">
                                {{ __('Edit blog.') }}
                            </p>
                        </header>

                        <form class="mt-6 space-y-6" method="post"
                            action="{{ route('blog.update', ['id' => $entity->id]) }}">
                            @csrf
                            @method('patch')
                            @include('blog.partials.input')
                        </form>
                    </section>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
