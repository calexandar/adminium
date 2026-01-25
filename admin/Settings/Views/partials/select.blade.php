<div class="col-span-full">
    <label for="{{ $field['name'] }}" class="block text-sm/6 font-medium text-gray-900 dark:text-white">{{ $field['label'] }}</label>
    <div class="mt-2 grid grid-cols-1">
        <select id="{{ $field['name'] }}" name="{{ $field['name'] }}" autocomplete="{{ $field['name'] }}" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-1.5 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:*:bg-gray-800 dark:focus:outline-indigo-500">
            @if(isset($field['placeholder']))
                <option value="">{{ $field['placeholder'] }}</option>
            @endif
            @foreach($field['options'] as $value => $label)
                <option value="{{ $value }}" {{ settings()->group($group)->get($field['name'], $field['default']) == $value ? 'selected' : '' }}>{{ $label }}</option>
            @endforeach
        </select>
        <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end text-gray-500 sm:size-4 dark:text-gray-400">
            <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z"/>
        </svg>
    </div>
    @error($field['name'])
        <p id="{{ $field['name'] }}-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>