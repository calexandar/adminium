@extends('dashboard::admin_layout')

@section('content')

  <form action="{{ route('admin.settings.store', $group) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="space-y-12">
      <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3 dark:border-white/10">
          <div>
            <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">{{ ucwords(str_replace('_', ' ', $group)) }}</h2>
            <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Make the necessary changes below.</p>
          </div>

          <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">

            @foreach ($fields as $field)

              @include('settings::partials.' . $field['type'], ['field' => $field, 'group' => $group])

            @endforeach

          </div>
      </div>  
    </div>


    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Cancel</button>
      <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:focus-visible:outline-indigo-500">Save</button>
    </div>
  </form>

@endsection




