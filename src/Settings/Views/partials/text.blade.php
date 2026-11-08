<div class="col-span-full">
    <label for="{{ $field['name'] }}" class="block text-sm/6 font-medium text-gray-900 dark:text-white">{{ $field['label'] }}</label>
    <div class="mt-2">
      <input id="{{ $field['name'] }}" type="text" name="{{ $field['name'] }}"  autocomplete="{{ $field['name'] }}" value="{{ settings()->group($group)->get($field['name'], $field['default']) }}" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
    </div>
    @error ($field['name'])           
      <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
    @enderror
</div>