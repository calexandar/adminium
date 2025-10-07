@extends('dashboard::admin_layout')

@section('content')
<div>
  <div class="grid grid-cols-1 sm:hidden">
    <!-- Use an "onChange" listener to redirect the user to the selected tab URL. -->
    <select aria-label="Select a tab" class="col-start-1 row-start-1 w-full appearance-none rounded-md bg-white py-2 pr-8 pl-3 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 dark:bg-white/5 dark:text-gray-100 dark:outline-white/10 dark:*:bg-gray-800 dark:focus:outline-indigo-500">
      <option>My Account</option>
      <option>Company</option>
      <option selected>Team Members</option>
      <option>Billing</option>
    </select>
    <svg viewBox="0 0 16 16" fill="currentColor" data-slot="icon" aria-hidden="true" class="pointer-events-none col-start-1 row-start-1 mr-2 size-5 self-center justify-self-end fill-gray-500 dark:fill-gray-400">
      <path d="M4.22 6.22a.75.75 0 0 1 1.06 0L8 8.94l2.72-2.72a.75.75 0 1 1 1.06 1.06l-3.25 3.25a.75.75 0 0 1-1.06 0L4.22 7.28a.75.75 0 0 1 0-1.06Z" clip-rule="evenodd" fill-rule="evenodd" />
    </svg>
  </div>
  <div class="hidden sm:block">
    <div class="border-b border-gray-200 dark:border-white/10">
      <nav aria-label="Tabs" class="-mb-px flex space-x-8">
        <!-- Current: "border-indigo-500 dark:border-indigo-400 text-indigo-600 dark:text-indigo-400", Default: "border-transparent text-gray-500 dark:text-gray-400 hover:border-gray-300 dark:hover:border-white/20 hover:text-gray-700 dark:hover:text-gray-200" -->
        <a href="#" class="border-b-2 border-transparent px-1 py-4 text-sm font-medium whitespace-nowrap text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200">My Account</a>
        <a href="#" class="border-b-2 border-transparent px-1 py-4 text-sm font-medium whitespace-nowrap text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200">Company</a>
        <a href="#" aria-current="page" class="border-b-2 border-indigo-500 px-1 py-4 text-sm font-medium whitespace-nowrap text-indigo-600 dark:border-indigo-400 dark:text-indigo-400">Team Members</a>
        <a href="#" class="border-b-2 border-transparent px-1 py-4 text-sm font-medium whitespace-nowrap text-gray-500 hover:border-gray-300 hover:text-gray-700 dark:text-gray-400 dark:hover:border-white/20 dark:hover:text-gray-200">Billing</a>
      </nav>
    </div>
  </div>
</div>
<form action="{{ route('admin.users.store') }}" method="POST">
  @csrf
  <div class="space-y-12">
    <!-- Personal Information section -->
    <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3 dark:border-white/10">
      <div>
        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Personal Information</h2>
        <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Use a permanent address where you can receive mail.</p>
      </div>

      <div class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6 md:col-span-2">
        <div class="sm:col-span-3">
          <label for="name" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Name</label>
          <div class="mt-2">
            <input id="name" type="text" name="name" value="{{ old('name') }}" autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
          </div>
          @if ($errors->has('name'))           
            <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('name') }}</p>
          @endif
        </div>

        <div class="sm:col-span-4">
          <label for="title" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Title</label>
          <div class="mt-2">
             <input id="title" type="text" name="title" value="{{ old('title') }}" autocomplete="given-title" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
          </div>
           @if ($errors->has('title'))           
            <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('title') }}</p>
          @endif
        </div>

        <div class="sm:col-span-4">
          <label for="email" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Email address</label>
          <div class="mt-2">
            <input id="email" type="email" name="email" value="{{ old('email') }}"  autocomplete="email" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
          </div>
           @if ($errors->has('email'))           
            <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('email') }}</p>
          @endif
        </div>

        <div class="sm:col-span-4">
          <label for="password" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Password</label>
          <div class="mt-2">
             <input id="password" type="password" name="password" value="{{ old('password') }}"  autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
          </div>
           @if ($errors->has('password'))           
            <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('password') }}</p>
          @endif
        </div>

        <div class="sm:col-span-4">
          <label for="password_confirmation" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Confirm Password</label>
          <div class="mt-2">
             <input id="password_confirmation" type="password" name="password_confirmation"  autocomplete="given-name" class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 dark:bg-white/5 dark:text-white dark:outline-white/10 dark:placeholder:text-gray-500 dark:focus:outline-indigo-500" />
          </div>
        </div>

        <div class="col-span-full">
          <label for="photo" class="block text-sm/6 font-medium text-gray-900 dark:text-white">Photo</label>
          <div class="mt-2 flex items-center gap-x-3">
            <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-12 text-gray-300 dark:text-gray-500">
              <path d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z" clip-rule="evenodd" fill-rule="evenodd" />
            </svg>
            <button type="button" class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50 dark:bg-white/10 dark:text-white dark:shadow-none dark:inset-ring-white/5 dark:hover:bg-white/20">Change</button>
          </div>
        </div>

      </div>
    </div>

    <div class="grid grid-cols-1 gap-x-8 gap-y-10 border-b border-gray-900/10 pb-12 md:grid-cols-3 dark:border-white/10">
      <div>
        <h2 class="text-base/7 font-semibold text-gray-900 dark:text-white">Permissions</h2>
        <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">Select all the permissions you want to give to this user.</p>
      </div>

      <div class="max-w-2xl space-y-10 md:col-span-2">
        <fieldset>
          <legend class="text-sm/6 font-semibold text-gray-900 dark:text-white">Admin permissions.</legend>
          <p class="mt-1 text-sm/6 text-gray-600 dark:text-gray-400">These are permissions that are only available to you.</p>
          <div class="mt-6 grid grid-cols-1  md:grid-cols-2 gap-4">
            @foreach (\Admin\UserManagment\UserPermissionName::cases() as $permission)
              
              <div class="flex items-center gap-x-3">
                <input id="{{ $permission }}" type="checkbox" name="permissions[]" value="{{ $permission }}" class="relative size-4 appearance-none rounded-full border border-gray-300 bg-white before:absolute before:inset-1 before:rounded-full before:bg-white not-checked:before:hidden checked:border-indigo-600 checked:bg-indigo-600 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 disabled:border-gray-300 disabled:bg-gray-100 disabled:before:bg-gray-400 dark:border-white/10 dark:bg-white/5 dark:checked:border-indigo-500 dark:checked:bg-indigo-500 dark:focus-visible:outline-indigo-500 dark:disabled:border-white/5 dark:disabled:bg-white/10 dark:disabled:before:bg-white/20 forced-colors:appearance-auto forced-colors:before:hidden" />
                <label for="{{ $permission }}" class="block text-sm/6 font-medium text-gray-900 dark:text-white">{{ $permission->label() }}</label>
              </div>
              
            @endforeach
            @if ($errors->has('permissions'))           
              <p id="email-error" class="mt-2 text-sm text-red-600 dark:text-red-400">{{ $errors->first('permissions') }}</p>
            @endif
          </div>
        </fieldset>
      </div>
    </div>
  </div>

  <div class="mt-6 flex items-center justify-end gap-x-6">
    <button type="button" class="text-sm/6 font-semibold text-gray-900 dark:text-white">Cancel</button>
    <button type="submit" class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600 dark:bg-indigo-500 dark:shadow-none dark:focus-visible:outline-indigo-500">Save</button>
  </div>
</form>


@endsection
