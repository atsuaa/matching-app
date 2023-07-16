<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Index Account') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('アカウント一覧') }}
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
                        {{ __('Name') }}
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
                @foreach ($users as $user)
                    <tr class="border-b bg-white dark:border-gray-700 dark:bg-gray-900">
                        <th class="whitespace-nowrap px-6 py-4 font-medium text-gray-900 dark:text-white"
                            scope="row">
                            {{ $user->id }}
                        </th>
                        <td class="px-6 py-4">
                            {{ $user->name }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->created_at }}
                        </td>
                        <td class="px-6 py-4">
                            {{ $user->updated_at }}
                        </td>
                        <td class="px-6 py-4">
                            <a class="font-medium text-blue-600 hover:underline dark:text-blue-500"
                                href="{{ route('user.show', ['id' => $user->id]) }}">Show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</section>
