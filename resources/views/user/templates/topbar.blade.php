<div class="flex flex-wrap items-center gap-5 md:gap-0 md:justify-between mx-auto p-5 md:px-5 px-0 pt-3 w-full">
    <button role="button" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
        aria-controls="logo-sidebar" type="button"
        class="inline-flex group items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-200/80 focus:outline-none focus:ring-2 focus:ring-gray-200">
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6 group-hover:text-black" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd"
                d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z">
            </path>
        </svg>
    </button>
    <form class="w-4/5 max-md:mx-auto sm:w-1/2 xl:w-7/12">
        <div class="relative">
            <button role="button" type="submit"
                class="absolute z-10 inset-y-0 start-0 flex items-center justify-center ml-1 h-9 w-9 mt-[6px] ml-2 rounded-lg hover:bg-gray-200 mx-auto"
                title="Search something">
                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                </svg>
                <span class="sr-only">Enter to search</span>
            </button>
            <input type="search" id="global-search"
                class="block w-full p-4 pl-12 md:px-12 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 ring-4 ring-transparent transition placeholder:text-neutral-500 focus:border-neutral-950 focus:outline-none focus:ring-neutral-950/5 h-12"
                placeholder="Search..." value="{{ request('search') }}" name="search">
            <div
                class="absolute z-10 inset-y-0 end-0 hidden md:flex items-center ml-1 h-9 w-9 mt-[6px] mr-2 rounded-lg">
                <label for="global-search" class="mx-auto cursor-pointer flex" title="Press / to search">
                    <kbd
                        class="px-2.5 py-1.5 text-xs font-semibold text-gray-800 select-none bg-gray-100 rounded-lg ring-1 ring-gray-900/20">/</kbd>
                </label>
            </div>
        </div>
    </form>
    <div
        class="lg:flex gap-2 md:gap-7 items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse hidden min-w-[10rem] w-0 justify-end">
        @unless (request()->routeIs('notification'))
        <button role="button" type="button"
            class="relative grid place-items-center text-sm rounded-full w-5 h-5 md:me-0 focus:ring-2 focus:ring-gray-300"
            id="dropdownDefaultButton" data-dropdown-toggle="notif">
            <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                <path
                    d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
            </svg>
            @unless ($jumlahPesan == 0)
            <span
                class="absolute inline-flex items-center justify-center w-4 h-4 text-[10px] font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2">{{
                $jumlahPesan }}</span>
            @endunless
        </button>
        @endunless
        <div class="z-50 w-72 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow"
            id="notif">
            <div class="block px-3 py-2 font-medium text-center text-gray-700 rounded-t-lg bg-gray-50">
                Notifications
            </div>
            <div>
                @unless (count($pesan))
                <div class="px-3 py-4">
                    <div class="text-gray-700 text-center">
                        <span>No notification yet</span>
                    </div>
                </div>
                @endunless
                @foreach (array_slice($pesan->all(), 0, 4) as $p)
                <div class="px-3 py-2.5 flex items-center">
                    <div class="mr-3">
                        <div class="overflow-hidden">
                            <img class="w-10 aspect-square rounded-full object-cover"
                                src="{{ $p->user->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . $p->user->pp) }}"
                                alt="{{ $p->id_pengirim }}">
                        </div>
                    </div>
                    <div>
                        <div title="{{ $p->created_at }}" class="text-xs text-gray-700">
                            {{ $p->created_at->format('F d, Y h:i A') }}
                        </div>
                        <span class="text-[0.85rem]"><a href="{{ route('profile',$p->user->username) }}"
                                class="isolate text-[0.85rem] truncate w-[85%] md:w-max font-normal relative no-underline before:absolute before:inset-0 before:-z-[1] before:block before:bg-gray-300/75 before:transition-transform before:scale-x-0 before:origin-bottom-right hover:before:scale-x-100 hover:before:origin-bottom-left hover:text-black duration-150 p-0.5 pb-0">{{
                                $p->user->username }}</a> sent you a file! <a
                                href="{{ route('file.share.detail', [$p->user->username, $p->id_file]) }}"
                                class="text-gray-800 font-medium hover:underline">View file.</a></span>
                    </div>
                </div>
                @endforeach
                @if (count($pesan) > 4)
                <a href="{{ route('notification') }}"
                    class="block py-2 w-full text-xs font-medium text-center text-gray-900 rounded-b-lg bg-gray-50 hover:bg-gray-100">See
                    More Notifications</a>
                @endif
            </div>
        </div>
        <button role="button"
            class="inline-flex min-w-0 items-center hover:ring-2 duration-150 hover:ring-gray-200 focus:ring-2 focus:ring-gray-200 rounded-full ring-offset-2"
            aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom"
            data-popover-trigger="click">
            <img class="rounded-full object-cover w-8 h-8"
                src="{{ Auth::user()->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . Auth::user()->pp) }}">
        </button>
        <!-- Dropdown menu -->
        <div class="hidden z-20 my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-lg shadow-lg"
            id="user-dropdown">
            <div class="min-w-[250px] py-3">
                <div class="px-4 mb-1.5 mt-1.5">
                    <span class="block text-sm  text-gray-500 truncate">{{ Auth::user()->email }}</span>
                </div>
                <ul>
                    <li>
                        <a href="{{ route('me') }}"
                            class="inline-flex items-center w-full justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Profile
                            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M10 19a9 9 0 1 0 0-18 9 9 0 0 0 0 18Zm0 0a8.949 8.949 0 0 0 4.951-1.488A3.987 3.987 0 0 0 11 14H9a3.987 3.987 0 0 0-3.951 3.512A8.948 8.948 0 0 0 10 19Zm3-11a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                            </svg>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('account.settings') }}"
                            class="inline-flex items-center w-full justify-between px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">
                            Settings
                            <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="none" viewBox="0 0 20 20">
                                <g stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2">
                                    <path
                                        d="M19 11V9a1 1 0 0 0-1-1h-.757l-.707-1.707.535-.536a1 1 0 0 0 0-1.414l-1.414-1.414a1 1 0 0 0-1.414 0l-.536.535L12 2.757V2a1 1 0 0 0-1-1H9a1 1 0 0 0-1 1v.757l-1.707.707-.536-.535a1 1 0 0 0-1.414 0L2.929 4.343a1 1 0 0 0 0 1.414l.536.536L2.757 8H2a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1h.757l.707 1.707-.535.536a1 1 0 0 0 0 1.414l1.414 1.414a1 1 0 0 0 1.414 0l.536-.535L8 17.243V18a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-.757l1.707-.708.536.536a1 1 0 0 0 1.414 0l1.414-1.414a1 1 0 0 0 0-1.414l-.535-.536.707-1.707H18a1 1 0 0 0 1-1Z" />
                                    <path d="M10 13a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" />
                                </g>
                            </svg>
                        </a>
                    </li>
                </ul>
                <hr class="my-2.5 w-10/12 mx-auto h-px border-0 bg-gray-300">
                <ul>
                    <li>
                        <button role="button" data-modal-target="signout" data-modal-toggle="signout" type="button"
                            class="w-full block text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Log
                            Out</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div id="signout" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow">
            <button role="button" type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                data-modal-hide="signout">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to
                    log out?</h3>
                <form action="/signout" method="get" class="inline-block mr-1">
                    <div class="!w-max">
                        <x-partial.primary-button onclick="process(event)"
                            class="text-white bg-red-700 !mt-0 hover:bg-red-800 focus:ring-2 focus:ring-offset-2 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm text-center">
                            Log out
                        </x-partial.primary-button>
                    </div>
                </form>
                <x-partial.secondary-button data-modal-hide="signout">
                    No, cancel
                </x-partial.secondary-button>
            </div>
        </div>
    </div>
</div>


<div id="logo-sidebar"
    class="fixed top-0 left-0 z-40 w-64 2xl:w-[339px] h-screen overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-600"
    tabindex="-1">
    <div class="h-full px-4 py-3 overflow-y-auto bg-gray-50 rounded-e-xl">
        <div class="flex items-center justify-between gap-x-2">
            <button role="button" data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar"
                aria-controls="logo-sidebar" type="button"
                class="inline-flex group items-center p-2 text-sm text-gray-500 rounded-lg hover:bg-gray-200/80 focus:outline-none focus:ring-2 focus:ring-gray-200">
                <span class="sr-only">Open sidebar</span>
                <svg class="w-5 h-5 group-hover:text-black" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
            <div class="flex justify-center items-center gap-2">
                <a href="{{ route('me') }}" class="flex items-center group">
                    <img class="rounded-full object-cover w-7 h-7 hover:ring-2 duration-150 hover:ring-gray-200 ring-offset-2"
                        src="{{ Auth::user()->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . Auth::user()->pp) }}"
                        width="40">
                </a>

                <div class="inline-block h-8 w-0.5 self-stretch bg-gray-300 opacity-100">
                </div>

                <a href="{{ route('notification') }}"
                    class="relative grid place-items-center text-sm rounded-full w-5 h-5 md:me-0 focus:ring-2 focus:ring-gray-300">
                    <svg xmlns="http://www.w3.org/2000/svg" height="16" width="14" viewBox="0 0 448 512">
                        <path
                            d="M224 0c-17.7 0-32 14.3-32 32V51.2C119 66 64 130.6 64 208v25.4c0 45.4-15.5 89.5-43.8 124.9L5.3 377c-5.8 7.2-6.9 17.1-2.9 25.4S14.8 416 24 416H424c9.2 0 17.6-5.3 21.6-13.6s2.9-18.2-2.9-25.4l-14.9-18.6C399.5 322.9 384 278.8 384 233.4V208c0-77.4-55-142-128-156.8V32c0-17.7-14.3-32-32-32zm0 96c61.9 0 112 50.1 112 112v25.4c0 47.9 13.9 94.6 39.7 134.6H72.3C98.1 328 112 281.3 112 233.4V208c0-61.9 50.1-112 112-112zm64 352H224 160c0 17 6.7 33.3 18.7 45.3s28.3 18.7 45.3 18.7s33.3-6.7 45.3-18.7s18.7-28.3 18.7-45.3z" />
                    </svg>
                </a>
            </div>
        </div>
        @php
        $ref = match (request()->path()) {
        'publikFile' => 'publikFile',
        default => null,
        };
        @endphp
        <div class="mt-2.5">
            <x-partial.create-file :url="$ref" tabindex="-1">
                <span class="-mr-1.5 text-3xl mb-1">+</span> Baru
            </x-partial.create-file>

            <div class="block mt-5">
                <x-partial.tertiary-button href="/" :path="request()->is('/')" tabindex="-1">
                    <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 18a.969.969 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V9l4-4m-4 5h5m3-4h5V1m5 1v12a.97.97 0 0 1-.933 1H9.933A.97.97 0 0 1 9 14V5l4-4h5.067A.97.97 0 0 1 19 2Z" />
                    </svg>
                    <span>My Files</span>
                </x-partial.tertiary-button>

                <x-partial.tertiary-button href="/publikFile" :path="request()->is('publikFile')" tabindex="-1">
                    <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 21 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6.487 1.746c0 4.192 3.592 1.66 4.592 5.754 0 .828 1 1.5 2 1.5s2-.672 2-1.5a1.5 1.5 0 0 1 1.5-1.5h1.5m-16.02.471c4.02 2.248 1.776 4.216 4.878 5.645C10.18 13.61 9 19 9 19m9.366-6h-2.287a3 3 0 0 0-3 3v2m6-8a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <span style="ml-1">Public Files</span>
                </x-partial.tertiary-button>

                <x-partial.tertiary-button href="{{ route('file.trashed') }}" :path="request()->routeIs('file.trashed')"
                    tabindex="-1">
                    <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                    </svg>
                    <span style="ml-1">Trash</span>
                </x-partial.tertiary-button>

                @if (Auth::user()->status == 2)
                <x-partial.tertiary-button href="/a/users" :path="request()->is('a/*')" tabindex="-1">
                    <svg class="h-5 w-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z" />
                    </svg>
                    <span class="ml-1">User Data</span>
                </x-partial.tertiary-button>
                @endif
            </div>
            <hr class="my-2 h-px bg-gray-200 border-0" />
            <div>
                <x-partial.tertiary-button href="{{ route('account.settings') }}"
                    :path="request()->routeIs('account.settings')" tabindex="-1">
                    <svg class="w-5 h-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    <span style="ml-1">Settings</span>
                </x-partial.tertiary-button>
                <button role="button" data-modal-target="signout" data-modal-toggle="signout" tabindex="-1"
                    class="flex w-full gap-3 items-center mb-3 px-4 py-2.5 rounded-full {{ request()->routeIs('file.trashed') ? 'bg-gray-300' : 'hover:bg-gray-200' }}">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                        class="w-4 h-4">
                        <path fill-rule="evenodd"
                            d="M12 2.25a.75.75 0 01.75.75v9a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM6.166 5.106a.75.75 0 010 1.06 8.25 8.25 0 1011.668 0 .75.75 0 111.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788a.75.75 0 011.06 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <span style="ml-1">Log out</span>
                </button>
            </div>
        </div>
    </div>
</div>

{{-- @push('script')
<script>
    /**
         * Slash key listener ,to focus inputs
         */
        document.addEventListener("keydown", (event) => {
        if (event.key === "/" && event.code === "Slash") {
            event.preventDefault();
            // var globalForm = document.getElementById("global-search");
            document.getElementById("global-search").focus();
        }
        });
</script>
@endpush --}}