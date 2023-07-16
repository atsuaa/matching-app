@props(['value', 'label', 'id', 'name', 'checked'])

<label
    class="block flex w-full rounded-md border border-gray-200 bg-white p-3 text-sm focus:border-blue-500 focus:ring-blue-500 dark:border-gray-700 dark:bg-slate-900 dark:text-gray-400"
    :for="$id">
    <span class="text-sm text-gray-500 dark:text-gray-400">{{ $label ?? $slot }}</span>
    <input
        class="pointer-events-none ml-auto mt-0.5 shrink-0 rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-gray-700 dark:bg-gray-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800"
        id="{{ $id }}" name="{{ $name }}" type="checkbox" value="{{ $value }}"
        @checked($checked ?? false)>
</label>
