<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Delete Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </header>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <table class="w-full text-left text-sm text-gray-500 dark:text-gray-400">
            <thead class="bg-gray-50 text-xs uppercase text-gray-700 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3" scope="col">
                        {{ __('ID') }}
                    </th>
                    <th class="px-6 py-3" scope="col">
                        {{ __('Title') }}
                    </th>
                    <th class="px-6 py-3" scope="col">
                        {{ __('Created Time') }}
                    </th>
                    <th class="px-6 py-3" scope="col">
                        {{ __('Updated Time') }}
                    </th>
                    <th class="px-6 py-3" scope="col">
                        {{ __('Action') }}
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($blogs as $blog)
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-900">
                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                            scope="row">
                            {{ $blog->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $blog->title }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $blog->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $blog->updated_at }}
                        </td>
                        <td class="px-6 py-4">
                            <a class="font-medium text-blue-600 hover:underline dark:text-blue-500"
                                href="{{ route('blog.show', ['id' => $blog->id]) }}">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>
