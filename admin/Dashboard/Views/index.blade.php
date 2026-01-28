@extends('dashboard::admin_layout')

@section('content')
    <ul role="list" class="grid grid-cols-1 gap-x-6 gap-y-8 lg:grid-cols-3 xl:gap-x-8">
        <li class="overflow-hidden rounded-xl outline outline-gray-200 dark:-outline-offset-1 dark:outline-white/10">
            <div
                class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6 dark:border-white/10 dark:bg-gray-800/50">
                <svg width="48px" height="48px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" aria-hidden="true" role="img" class="iconify iconify--fxemoji" preserveAspectRatio="xMidYMid meet" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path fill="#EAC083" d="M446.067 512h-217.97c-2.818 0-5.102-3.663-5.102-8.182V8.182c0-4.519 2.284-8.182 5.102-8.182H446.23c2.727 0 4.938 3.546 4.938 7.92v495.898c.001 4.519-2.283 8.182-5.101 8.182z"></path><path fill="#F9E7C0" d="M392.753 512H191.967L35.007 355.04V8.182A8.182 8.182 0 0 1 43.189 0h349.826a7.92 7.92 0 0 1 7.92 7.92v495.898a8.182 8.182 0 0 1-8.182 8.182z"></path><path fill="#597B91" d="M303.694 456.668h-60.108c-6.147 0-11.13-4.983-11.13-11.13s4.983-11.13 11.13-11.13h60.108c6.146 0 11.13 4.983 11.13 11.13s-4.983 11.13-11.13 11.13zm59.646-83.983c0-6.146-4.983-11.13-11.13-11.13H243.586c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H352.21c6.146-.001 11.13-4.984 11.13-11.13zm-23.867-72.854c0-6.146-4.983-11.13-11.13-11.13h-84.757c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h84.757c6.146 0 11.13-4.983 11.13-11.13zm-49.297-72.853c0-6.147-4.983-11.13-11.13-11.13H102.809c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h176.237c6.146-.001 11.13-4.983 11.13-11.13zm-92.007 72.853c0-6.146-4.983-11.13-11.13-11.13h-84.231c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h84.231c6.148 0 11.13-4.983 11.13-11.13zm110.859-145.707c0-6.147-4.983-11.13-11.13-11.13h-195.09c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13h195.09c6.147 0 11.13-4.983 11.13-11.13zm54.312-72.853c0-6.147-4.983-11.13-11.13-11.13H102.809c-6.147 0-11.13 4.983-11.13 11.13s4.983 11.13 11.13 11.13H352.21c6.146 0 11.13-4.983 11.13-11.13z"></path><path fill="#EAC083" d="M191.967 512L35.007 355.04h123.597c18.426 0 33.363 14.937 33.363 33.363V512z"></path></g></svg>
                <div class="text-sm/6 font-medium text-gray-900 dark:text-white">Pages</div>
                <el-dropdown class="relative ml-auto">
                    <button
                        class="relative block text-gray-400 hover:text-gray-500 dark:text-gray-400 dark:hover:text-white">
                        <span class="absolute -inset-2.5"></span>
                        <span class="sr-only">Open options</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                            <path
                                d="M3 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM8.5 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM15.5 8.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z" />
                        </svg>
                    </button>
                    <el-menu anchor="bottom end" popover
                        class="w-32 origin-top-right rounded-md bg-white py-2 shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(0.5)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                        <a href="{{ route('admin.pages.index') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">View<span
                                class="sr-only">, Pages View</span></a>
                        <a href="{{ route('admin.pages.create') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">Create<span
                                class="sr-only">, Pages Create</span></a>
                    </el-menu>
                </el-dropdown>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm/6 dark:divide-white/10">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Last published</dt>
                    <dd class="text-gray-700 dark:text-gray-300"><time datetime="2022-12-13">December 13, 2022</time></dd>
                </div>
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Total pages</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $pagesCount }}</div>
                    </dd>
                </div>
            </dl>
        </li>
        <li class="overflow-hidden rounded-xl outline outline-gray-200 dark:-outline-offset-1 dark:outline-white/10">
            <div
                class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6 dark:border-white/10 dark:bg-gray-800/50">
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 506 506" xml:space="preserve" width="48px" height="48px" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <path style="fill:#E8E3E3;" d="M373,456h37.6c3.6,0,3.2-6,3.2-9.6V47.6c0-3.6,0.4-3.6-3.2-3.6H103.4c-3.6,0-9.6,0-9.6,3.6v33.6 L373,456z"></path> <path style="fill:#E8E3E3;" d="M419,420h35.6c3.6,0,3.2-10,3.2-13.6V11.6c0-3.6,0.4-7.6-3.2-7.6H147.4c-3.6,0-9.6,4-9.6,7.6V44 L419,420z"></path> </g> <path style="fill:#F4EFEF;" d="M369.8,493.6c0,3.6-2.8,6.4-6.4,6.4H56.6c-3.6,0-6.4-2.8-6.4-6.4V90.4c0-3.6,2.8-6.4,6.4-6.4h306.8 c3.6,0,6.4,2.8,6.4,6.4V493.6z"></path> <rect x="81.8" y="124" style="fill:#AEB1B4;" width="256" height="80"></rect> <rect x="85.8" y="364" style="fill:#7D8B95;" width="96" height="96"></rect> <path d="M257.8,242h-176c-2.4,0-4-1.6-4-4s1.6-4,4-4h176c2.4,0,4,1.6,4,4S260.2,242,257.8,242z"></path> <path d="M257.8,274h-176c-2.4,0-4-1.6-4-4s1.6-4,4-4h176c2.4,0,4,1.6,4,4S260.2,274,257.8,274z"></path> <path d="M257.8,306h-176c-2.4,0-4-1.6-4-4s1.6-4,4-4h176c2.4,0,4,1.6,4,4S260.2,306,257.8,306z"></path> <path d="M257.8,338h-176c-2.4,0-4-1.6-4-4s1.6-4,4-4h176c2.4,0,4,1.6,4,4S260.2,338,257.8,338z"></path> <path d="M337.8,370h-120c-2.4,0-4-1.6-4-4s1.6-4,4-4h120c2.4,0,4,1.6,4,4S340.2,370,337.8,370z"></path> <path d="M337.8,402h-120c-2.4,0-4-1.6-4-4s1.6-4,4-4h120c2.4,0,4,1.6,4,4S340.2,402,337.8,402z"></path> <path d="M337.8,434h-120c-2.4,0-4-1.6-4-4s1.6-4,4-4h120c2.4,0,4,1.6,4,4S340.2,434,337.8,434z"></path> <path d="M337.8,466h-120c-2.4,0-4-1.6-4-4s1.6-4,4-4h120c2.4,0,4,1.6,4,4S340.2,466,337.8,466z"></path> <path d="M337.8,242h-52c-2.4,0-4-1.6-4-4s1.6-4,4-4h52c2.4,0,4,1.6,4,4S340.2,242,337.8,242z"></path> <path d="M337.8,274h-52c-2.4,0-4-1.6-4-4s1.6-4,4-4h52c2.4,0,4,1.6,4,4S340.2,274,337.8,274z"></path> <path d="M337.8,306h-52c-2.4,0-4-1.6-4-4s1.6-4,4-4h52c2.4,0,4,1.6,4,4S340.2,306,337.8,306z"></path> <path d="M337.8,338h-52c-2.4,0-4-1.6-4-4s1.6-4,4-4h52c2.4,0,4,1.6,4,4S340.2,338,337.8,338z"></path> <path d="M361.4,506H54.6c-6,0-10.4-4.8-10.4-10.4V92.4c0-6,4.8-10.4,10.4-10.4h306.8c6,0,10.4,4.8,10.4,10.4v402.8 C371.8,501.2,367,506,361.4,506z M54.2,90c-1.2,0-2.4,1.2-2.4,2.4v402.8c0,1.2,1.2,2.4,2.4,2.4H361c1.2,0,2.4-1.2,2.4-2.4V92.4 c0-1.2-1.2-2.4-2.4-2.4H54.2z"></path> <path d="M335.8,210h-256c-2.4,0-4-1.6-4-4v-80c0-2.4,1.6-4,4-4h256c2.4,0,4,1.6,4,4v80C339.8,208.4,338.2,210,335.8,210z M83.8,202 h248v-72h-248V202z"></path> <path d="M179.8,466h-96c-2.4,0-4-1.6-4-4v-96c0-2.4,1.6-4,4-4h96c2.4,0,4,1.6,4,4v96C183.8,464.4,182.2,466,179.8,466z M87.8,458h88 v-88h-88V458z"></path> <path d="M407.4,462h-37.6c-2.4,0-4-1.6-4-4s1.6-4,4-4h37.6c1.2,0,2.4-1.2,2.4-2.4V48.4c0-1.2-1.2-2.4-2.4-2.4H100.6 c-1.2,0-2.4,1.2-2.4,2.4V84c0,2.4-1.6,4-4,4s-4-1.6-4-4V48.4c0-6,4.8-10.4,10.4-10.4h306.8c6,0,10.4,4.8,10.4,10.4v402.8 C417.8,457.2,413,462,407.4,462z"></path> <path d="M451.4,424h-37.6c-2.4,0-4-1.6-4-4s1.6-4,4-4h37.6c1.2,0,2.4-1.2,2.4-2.4V10.4c0-1.2-1.2-2.4-2.4-2.4H144.6 c-1.2,0-2.4,1.2-2.4,2.4V38c0,2.4-1.6,4-4,4s-4-1.6-4-4V10.4c0-6,4.8-10.4,10.4-10.4h306.8c6,0,10.4,4.8,10.4,10.4v402.8 C461.8,419.2,457,424,451.4,424z"></path> </g></svg>
                <div class="text-sm/6 font-medium text-gray-900 dark:text-white">Articles</div>
                <el-dropdown class="relative ml-auto">
                    <button
                        class="relative block text-gray-400 hover:text-gray-500 dark:text-gray-400 dark:hover:text-white">
                        <span class="absolute -inset-2.5"></span>
                        <span class="sr-only">Open options</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                            <path
                                d="M3 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM8.5 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM15.5 8.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z" />
                        </svg>
                    </button>
                    <el-menu anchor="bottom end" popover
                        class="w-32 origin-top-right rounded-md bg-white py-2 shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(0.5)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                        <a href="{{ route('admin.articles.index') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">View<span
                                class="sr-only">, View Articles</span></a>
                        <a href="{{ route('admin.articles.create') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">Create<span
                                class="sr-only">, Create Articles</span></a>
                    </el-menu>
                </el-dropdown>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm/6 dark:divide-white/10">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Last published</dt>
                    @if($lastPublishedArticle)
                        <dd class="text-gray-700 dark:text-gray-300"><time datetime="{{ $lastPublishedArticle }}">{{ $lastPublishedArticle->updated_at->format('M d, Y') }}</time></dd>
                    @else
                        <dd class="text-gray-700 dark:text-gray-300">No articles yet</dd>
                    @endif
                </div>
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Total articles</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $articlesCount }}</div>
                    </dd>
                </div>
            </dl>
        </li>
        <li class="overflow-hidden rounded-xl outline outline-gray-200 dark:-outline-offset-1 dark:outline-white/10">
            <div
                class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6 dark:border-white/10 dark:bg-gray-800/50">
                <svg width="48px" height="48px" viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" version="1.1" fill="#000000" stroke="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path style="fill:#427794;stroke:#2A424F" d="M 22,43 C 18,48 6.5,45 4.2,56 2,62 2,81 14,79 13,64 12,57 12,57 c 0,0 1,14 2,21 9,4 24,4 35,-1 0,-8 -1,-13 0,-18 0,-5 0,19 0,19 0,0 6,2 8,-5 3,-10 5,-24 -9,-28 -9,-1 -7,-2 -8,-2 -2,0 -18,0 -18,0 z"></path> <path style="fill:#C29B82;stroke:#693311" d="m 23,38 c 0,0 1,3 -1,5 3,4 11,8 18,0 -1,-2 -1,-2 -1,-5 0,0 -16,0 -16,0 z"></path> <path style="fill:#CDA68E;stroke:#693311" d="M 31,42 C 17,42 7.6,4.8 31,4.2 55,4.1 44,42 31,42 z"></path> <path style="fill:#553932;stroke:#311710" d="M 17,26 C 14,16 14,3.2 31,2.4 44,3.1 49,15 44,26 44,21 45,19 43,16 39,15 33,16 28,11 27,15 15,13 17,26 z"></path> <path style="fill:#5F3E20;stroke:#311710" d="m 45,65 c 5,-8 0,-25 3,-31 3,-10 7,-16 16,-16 10,0 16,8 20,17 1,2 0,6 2,11 1,4 -1,8 -1,10 0,5 -1,3 2,9 -5,13 -34,10 -42,0 z"></path> <path style="fill:#D8933B;stroke:#2A424F" d="m 58,60 c -5,5 -18,3 -20,13 -2,6 -1,25 11,24 -1,-16 -3,-23 -3,-23 0,0 2,15 3,21 9,5 23,5 35,-1 0,-6 -1,-13 0,-18 1,-5 0,20 0,20 0,0 7,1 9,-6 2,-9 4,-22 -7,-25 -9,-3 -10,-5 -12,-5 -1,0 -16,0 -16,0 z"></path> <path style="fill:#DEB89F;stroke:#693311" d="m 58,54 c 0,0 1,3 0,7 3,3 10,8 16,0 -1,-4 -1,-4 -1,-7 0,0 -15,0 -15,0 z"></path> <path style="fill:#DBBFA8;stroke:#693311" d="M 66,59 C 52,59 43,21 66,20 86,21 79,59 66,59 z"></path> <path style="fill:#5F3E20" d="m 63,27 c -3,5 -7,8 -12,9 -4,1 2,-17 13,-17 5,0 13,3 15,15 -6,1 -14,-5 -16,-7"></path> </g></svg>
                <div class="text-sm/6 font-medium text-gray-900 dark:text-white">Users</div>
                <el-dropdown class="relative ml-auto">
                    <button
                        class="relative block text-gray-400 hover:text-gray-500 dark:text-gray-400 dark:hover:text-white">
                        <span class="absolute -inset-2.5"></span>
                        <span class="sr-only">Open options</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                            <path
                                d="M3 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM8.5 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM15.5 8.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z" />
                        </svg>
                    </button>
                    <el-menu anchor="bottom end" popover
                        class="w-32 origin-top-right rounded-md bg-white py-2 shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(0.5)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                        <a href="{{ route('admin.users.index') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">View<span
                                class="sr-only">, Users List</span></a>
                        <a href="{{ route('admin.users.create') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">Create<span
                                class="sr-only">, Create User</span></a>
                    </el-menu>
                </el-dropdown>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm/6 dark:divide-white/10">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Last invoice</dt>
                    <dd class="text-gray-700 dark:text-gray-300"><time datetime="2023-01-23">January 23, 2023</time></dd>
                </div>
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Total users</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $usersCount }}</div>
                    </dd>
                </div>
            </dl>
        </li>
        <li class="overflow-hidden rounded-xl outline outline-gray-200 dark:-outline-offset-1 dark:outline-white/10">
            <div
                class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6 dark:border-white/10 dark:bg-gray-800/50">
                <svg width="48px" height="48px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7.24 2H5.34C3.15 2 2 3.15 2 5.33V7.23C2 9.41 3.15 10.56 5.33 10.56H7.23C9.41 10.56 10.56 9.41 10.56 7.23V5.33C10.57 3.15 9.42 2 7.24 2Z" fill="#1c6fd4"></path> <path opacity="0.4" d="M18.6695 2H16.7695C14.5895 2 13.4395 3.15 13.4395 5.33V7.23C13.4395 9.41 14.5895 10.56 16.7695 10.56H18.6695C20.8495 10.56 21.9995 9.41 21.9995 7.23V5.33C21.9995 3.15 20.8495 2 18.6695 2Z" fill="#1c6fd4"></path> <path d="M18.6695 13.4302H16.7695C14.5895 13.4302 13.4395 14.5802 13.4395 16.7602V18.6602C13.4395 20.8402 14.5895 21.9902 16.7695 21.9902H18.6695C20.8495 21.9902 21.9995 20.8402 21.9995 18.6602V16.7602C21.9995 14.5802 20.8495 13.4302 18.6695 13.4302Z" fill="#1c6fd4"></path> <path opacity="0.4" d="M7.24 13.4302H5.34C3.15 13.4302 2 14.5802 2 16.7602V18.6602C2 20.8502 3.15 22.0002 5.33 22.0002H7.23C9.41 22.0002 10.56 20.8502 10.56 18.6702V16.7702C10.57 14.5802 9.42 13.4302 7.24 13.4302Z" fill="#1c6fd4"></path> </g></svg>
                <div class="text-sm/6 font-medium text-gray-900 dark:text-white">Categories</div>
                <el-dropdown class="relative ml-auto">
                    <button
                        class="relative block text-gray-400 hover:text-gray-500 dark:text-gray-400 dark:hover:text-white">
                        <span class="absolute -inset-2.5"></span>
                        <span class="sr-only">Open options</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                            <path
                                d="M3 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM8.5 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM15.5 8.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z" />
                        </svg>
                    </button>
                    <el-menu anchor="bottom end" popover
                        class="w-32 origin-top-right rounded-md bg-white py-2 shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(0.5)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                        <a href="{{ route('admin.categories.index') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">View<span
                                class="sr-only">, Categories List</span></a>
                        <a href="{{ route('admin.categories.create') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">Create<span
                                class="sr-only">, Category Create</span></a>
                    </el-menu>
                </el-dropdown>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm/6 dark:divide-white/10">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Last published</dt>
                    <dd class="text-gray-700 dark:text-gray-300"><time datetime="2023-01-23">January 23, 2023</time></dd>
                </div>
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Total categories</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $categoriesCount }}</div>
                    </dd>
                </div>
            </dl>
        </li>
        <li class="overflow-hidden rounded-xl outline outline-gray-200 dark:-outline-offset-1 dark:outline-white/10">
            <div
                class="flex items-center gap-x-4 border-b border-gray-900/5 bg-gray-50 p-6 dark:border-white/10 dark:bg-gray-800/50">
                <svg width="48px" height="48px" viewBox="0 0 1024 1024" class="icon" version="1.1" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M862.90625 932.1875H162.96875c-38.71875 0-70.125-31.40625-70.125-70.125V432.5c0-38.71875 31.40625-70.125 70.125-70.125h699.9375c38.71875 0 70.125 31.40625 70.125 70.125v429.5625c0 38.71875-31.40625 70.125-70.125 70.125z" fill="#00AAFF"></path><path d="M784.0625 227.5625H239.9375c-32.4375 0-58.78125 26.34375-58.78125 58.78125v45.9375h661.6875v-45.9375c0-32.53125-26.34375-58.78125-58.78125-58.78125z" fill="#FC592D"></path><path d="M721.25 91.34375H306.59375c-32.4375 0-58.78125 26.34375-58.78125 58.78125v45.9375H780.125v-45.9375c-0.09375-32.4375-26.34375-58.78125-58.875-58.78125z" fill="#FFCE00"></path></g></svg>
                <div class="text-sm/6 font-medium text-gray-900 dark:text-white">Products</div>
                <el-dropdown class="relative ml-auto">
                    <button
                        class="relative block text-gray-400 hover:text-gray-500 dark:text-gray-400 dark:hover:text-white">
                        <span class="absolute -inset-2.5"></span>
                        <span class="sr-only">Open options</span>
                        <svg viewBox="0 0 20 20" fill="currentColor" data-slot="icon" aria-hidden="true" class="size-5">
                            <path
                                d="M3 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM8.5 10a1.5 1.5 0 1 1 3 0 1.5 1.5 0 0 1-3 0ZM15.5 8.5a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3Z" />
                        </svg>
                    </button>
                    <el-menu anchor="bottom end" popover
                        class="w-32 origin-top-right rounded-md bg-white py-2 shadow-lg outline-1 outline-gray-900/5 transition transition-discrete [--anchor-gap:--spacing(0.5)] data-closed:scale-95 data-closed:transform data-closed:opacity-0 data-enter:duration-100 data-enter:ease-out data-leave:duration-75 data-leave:ease-in dark:bg-gray-800 dark:shadow-none dark:-outline-offset-1 dark:outline-white/10">
                        <a href="{{ route('admin.products.index') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">View<span
                                class="sr-only">, Products List</span></a>
                        <a href="{{ route('admin.products.create') }}"
                            class="block px-3 py-1 text-sm/6 text-gray-900 focus:bg-gray-50 focus:outline-hidden dark:text-white dark:focus:bg-white/5">Create<span
                                class="sr-only">, Product Create</span></a>
                    </el-menu>
                </el-dropdown>
            </div>
            <dl class="-my-3 divide-y divide-gray-100 px-6 py-4 text-sm/6 dark:divide-white/10">
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Last published</dt>
                    <dd class="text-gray-700 dark:text-gray-300"><time datetime="2023-01-23">January 23, 2023</time></dd>
                </div>
                <div class="flex justify-between gap-x-4 py-3">
                    <dt class="text-gray-500 dark:text-gray-400">Total products</dt>
                    <dd class="flex items-start gap-x-2">
                        <div class="font-medium text-gray-900 dark:text-white">{{ $productsCount }}</div>
                    </dd>
                </div>
            </dl>
        </li>
    </ul>
@endsection
