@extends('dashboard::admin_layout')

@section('content')

@php
  $locales = config('app.available_locales');
@endphp

<div x-data="{ activeTab: 'en'}">
  <div class=mb-4>
    <div class="grid grid-cols-1 sm:hidden">
      <!-- Mobile menu -->
      <select x-on:change="activeTab = $event.target.value" aria-label="Select a tab" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 dark:bg-white/5 dark:text-gray-100 dark:outline-white/10 dark:*:bg-gray-800 dark:focus:outline-indigo-500">
        @foreach ($locales as $locale )
          <option   value="{{ $locale }}" >{{ strtoupper($locale) }}</option>
        @endforeach
      </select>
      <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end fill-gray-500 dark:fill-gray-400">
        <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
      </svg>
    </div>
    <div class="hidden sm:block">
      <!-- Desktop menu -->
      <div class="border-b border-gray-200 dark:border-white/10">
        <nav aria-label="Tabs" class="-mb-px flex space-x-8">
          @foreach ($locales as $locale )
            <button
              x-on:click="activeTab = '{{ $locale }}'" 
              :class="{ 'border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400': activeTab === '{{ $locale }}' }" 
              class="border-b-2 border-transparent px-1 py-4 text-sm font-medium whitespace-nowrap text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200"
            >
              <span class="fi fi-{{ $locale === 'en' ? 'gb' : $locale }}"></span> {{ strtoupper($locale) }}
            </button>
          @endforeach      
        </nav>
      </div>
    </div>
  </div>
  
  <form action="{{ route('admin.media.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="space-y-12">
      <!-- MediaInformation translatable -->
      @foreach ($locales as $locale )
        <div x-show="activeTab === '{{ $locale }}'" class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3 dark:border-white/10">
          <div>
            <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Media Information</h2>
            <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Mediainformation that is translatable can be used to help you quickly identify and manage your categories.</p>
          </div>

          <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
            <div class="sm:col-span-3">
              <label for="title" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Title</label>
              <div class="mt-2">
                <input id="title" type="text" name="title[{{ $locale }}]" value="{{ old('title.' . $locale, '') }}" autocomplete="given-title" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
              </div>
              @if ($errors->has('title.*'))           
                <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('title.*') }}</p>
              @endif
            </div>

            <div class="col-span-full">
              <label for="description.{{ $locale }}" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Description</label>
              <div class="mt-2">
                <textarea id="description.{{ $locale }}" name="description[{{ $locale }}]" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500">{{ old('description.' . $locale, '') }}</textarea>
              </div>
              <p class="mt-3 text-sm/6 text-gray-600 dark:text-gray-400">Write a description for your news.</p>
                @if ($errors->has('description.*'))           
                <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('description.*') }}</p>
              @endif
            </div>

            <div class="col-span-full">
              <label for="caption" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Caption</label>
              <div class="mt-2">
                <textarea id="caption" name="caption[{{ $locale }}]" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500">{{ old('caption.' . $locale, '') }}</textarea>
              </div>
              <p class="mt-3 text-sm/6 text-gray-600 dark:text-gray-400">Write a caption that will show on hover.</p>
              @if ($errors->has('caption.*'))           
                <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('caption.*') }}</p>
              @endif
            </div>

            <div class="sm:col-span-4">
              <label for="meta_title" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Meta title</label>
              <div class="mt-2">
                <input id="meta_title" type="text" name="meta_title[{{ $locale }}]" value="{{ old('meta_title.' . $locale, '') }}" autocomplete="given-title" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
              </div>
              @if ($errors->has('meta_title.*'))           
                <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('meta_title.*') }}</p>
              @endif
            </div>

            <div class="col-span-full">
              <label for="meta_description" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Meta description</label>
              <div class="mt-2">
                <textarea id="meta_description" name="meta_description[{{ $locale }}]" rows="3" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500">{{ old('meta_description.' . $locale, '') }}</textarea>
              </div>
              <p class="mt-3 text-sm/6 text-gray-600 dark:text-gray-400">Write a meta descritpion that will appear in search results.</p>
              @if ($errors->has('meta_description.*'))           
                <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('meta_description.*') }}</p>
              @endif
            </div>

            <div class="col-span-full">
              <label for="meta_keywords" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Meta keywords</label>
              <div class="mt-2">
                <input id="meta_keywords" type="text" name="meta_keywords[{{ $locale }}]" value="{{ old('meta_keywords.' . $locale, '') }}" autocomplete="given-meta_keywords" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
              </div>
              @if ($errors->has('meta_keywords.*'))           
                <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('meta_keywords.*') }}</p>
              @endif
            </div>
          </div>
        </div>
      @endforeach
      <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3 dark:border-white/10">
          <div>
            <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Common Group Information</h2>
            <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Common Group information that is not translatable can be used to help you quickly identify and manage your categories.</p>
          </div>

          <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
            <div class="sm:col-span-3">
              <label for="slug" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Slug</label>
              <div class="mt-2">
                <input id="slug" type="text" name="slug"  autocomplete="given-slug" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
              </div>
              @if ($errors->has('slug'))           
                <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('slug') }}</p>
              @endif
            </div>

            <div class="col-span-full">
              <div class="flex items-center gap-x-3">
                <div class="group relative inline-flex w-11 shrink-0 rounded-full bg-gray-200 p-0.5 inset-ring inset-ring-gray-900/5 outline-offset-2 outline-indigo-600 transition-colors duration-200 ease-in-out has-checked:bg-indigo-600 has-focus-visible:outline-2 dark:bg-white/5 dark:inset-ring-white/10 dark:outline-indigo-500 dark:has-checked:bg-indigo-500">
                  <span class="size-5 rounded-full bg-white shadow-xs ring-1 ring-gray-900/5 transition-transform duration-200 ease-in-out group-has-checked:translate-x-5"></span>
                  <input type="hidden" name="published" value="0">
                  <input id="published" type="checkbox" name="published" value="1" aria-labelledby="published-label" aria-describedby="published-description" class="absolute inset-0 appearance-none focus:outline-hidden"/>
                </div>

                <div class="text-sm">
                  <label id="published-label" class="font-medium text-gray-900 dark:text-white">Published</label>
                </div>
              </div>
                @if ($errors->has('published'))           
                  <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('published') }}</p>
                @endif
            </div>

            <div class="col-span-full">
              <label for="icon" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Icon</label>
              <div class="mt-2 flex items-center gap-x-3">
                <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-12 text-gray-300 dark:text-gray-500">
                  <path d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                </svg>
                <input id="icon" type="file" name="icon" class="sr-only" />
                <button id="changeIcon"  type="button" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20">Change</button>
                <p id="iconName" class="text-gray-500 dark:text-gray-400">No file selected</p>
              </div>
              @if ($errors->has('icon'))           
                <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('icon') }}</p>
              @endif
            </div>

            <div class="col-span-full">
              <label for="cover_image" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Cover image</label>
              <div class="mt-2 flex justify-center rounded-lg border border-dashed border-gray-900/25 px-6 py-10 dark:border-white/25">
                <div class="text-center">
                  <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="mx-auto size-12 text-gray-300 dark:text-gray-600">
                    <path d="M1.5 6a2.25 2.25 0 0 1 2.25-2.25h16.5A2.25 2.25 0 0 1 22.5 6v12a2.25 2.25 0 0 1-2.25 2.25H3.75A2.25 2.25 0 0 1 1.5 18V6ZM3 16.06V18c0 .414.336.75.75.75h16.5A.75.75 0 0 0 21 18v-1.94l-2.69-2.689a1.5 1.5 0 0 0-2.12 0l-.88.879.97.97a.75.75 0 1 1-1.06 1.06l-5.16-5.159a1.5 1.5 0 0 0-2.12 0L3 16.061Zm10.125-7.81a1.125 1.125 0 1 1 2.25 0 1.125 1.125 0 0 1-2.25 0Z" clip-rule="evenodd" fill-rule="evenodd" />
                  </svg>
                  <div class="mt-4 flex text-sm/6 text-gray-600 dark:text-gray-400">
                    <label for="cover_image" class="relative cursor-pointer rounded-md bg-transparent font-semibold text-indigo-600 focus-within:outline-2 focus-within:outline-offset-2 focus-within:outline-indigo-600 hover:text-indigo-500 dark:text-indigo-400 dark:focus-within:outline-indigo-500 dark:hover:text-indigo-300">
                      <span>Upload a file</span>
                      <input id="cover_image" type="file" name="cover_image" class="sr-only" />
                    </label>
                    <p class="pl-1">or drag and drop</p>
                  </div>
                  <p class="text-xs/5 text-gray-600 dark:text-gray-400">PNG, JPG, GIF up to 10MB</p>
                </div>
              </div>
              @if ($errors->has('cover_image'))           
                <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('cover_image') }}</p>
              @endif
            </div>
          </div>
      </div>  
    </div>


    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Cancel</button>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:focus-visible:outline-indigo-500">Save</button>
    </div>
    <script>
      // Replace the <textarea id="editor1"> with a CKEditor 4
      // instance, using default configuration.
      const locales = @json(config('app.available_locales'));
      locales.forEach(locale => {
        CKEDITOR.replace( 'description.'+locale );
      });
    </script>

  </form>
</div>


@endsection


<script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    const titleInput = document.getElementById('title');
    const slugInput = document.getElementById('slug');

    titleInput.addEventListener('input', function() {
        const title = titleInput.value;
        const slug = generateSlug(title);
        slugInput.value = slug;
    });

    function generateSlug(text) {
        return text
            .toLowerCase() // Convert to lowercase
            .trim() // Remove leading/trailing whitespace
            .replace(/[^a-z0-9\s-]/g, '') // Remove special characters except spaces and hyphens
            .replace(/\s+/g, '-') // Replace spaces with a single hyphen
            .replace(/-+/g, '-') // Replace multiple hyphens with a single hyphen
            .replace(/^-+|-+$/g, ''); // Remove leading/trailing hyphens
    }
});
</script>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        const changeButton = document.getElementById('changeIcon');
        const photoInput = document.getElementById('icon');
        const fileNameElement = document.getElementById('iconName');

       changeButton.addEventListener('click', () => {
        photoInput.click();
    });

    photoInput.addEventListener('change', () => {
        const file = photoInput.files[0];
        if (file) {
            fileNameElement.textContent = file.name;
        } else {
            fileNameElement.textContent = 'No file selected';
        }
    });
});
</script>
