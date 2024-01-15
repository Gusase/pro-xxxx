@php
    $ref = match (request()->path()) {
        'publikFile' => 'publikFile',
        default => null,
    };
@endphp
<div class="mt-1.5 hidden lg:block">
    <x-partial.create-file :url="$ref" class="!w-full !p-2" data-tooltip-target="nf">
        <span class="text-3xl text-center block w-full mb-px">+</span>
    </x-partial.create-file>
    <div data-tooltip="nf" data-tooltip-placement="right" tabindex="-1"
        class="absolute z-30 whitespace-normal opacity-0 break-words rounded-lg inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200  shadow-sm">
        <span class="text-xs">New file</span>
    </div>


    <div class="block mt-5">
        <div>

            <x-partial.tertiary-button class="flex-col justify-center w-full aspect-square !mb-1" data-tooltip-target="fs" href="/" :path="request()->is('/')">
                <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 18a.969.969 0 0 1-.933 1H1.933A.97.97 0 0 1 1 18V9l4-4m-4 5h5m3-4h5V1m5 1v12a.97.97 0 0 1-.933 1H9.933A.97.97 0 0 1 9 14V5l4-4h5.067A.97.97 0 0 1 19 2Z" />
                </svg>
            </x-partial.tertiary-button>
            <div data-tooltip="fs" data-tooltip-placement="right" tabindex="-1"
                class="absolute z-30 whitespace-normal opacity-0 break-words rounded-lg inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200  shadow-sm">
                <span class="text-xs">My Files</span>
            </div>
        </div>

        <div>
            <x-partial.tertiary-button class="flex-col justify-center w-full aspect-square !mb-1" data-tooltip-target="pf" href="/publikFile" :path="request()->is('publikFile')">
                <svg class="w-4 h-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 21 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M6.487 1.746c0 4.192 3.592 1.66 4.592 5.754 0 .828 1 1.5 2 1.5s2-.672 2-1.5a1.5 1.5 0 0 1 1.5-1.5h1.5m-16.02.471c4.02 2.248 1.776 4.216 4.878 5.645C10.18 13.61 9 19 9 19m9.366-6h-2.287a3 3 0 0 0-3 3v2m6-8a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
            </x-partial.tertiary-button>
            <div data-tooltip="pf" data-tooltip-placement="right" tabindex="-1"
                class="absolute z-30 whitespace-normal opacity-0 break-words rounded-lg inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200  shadow-sm">
                <span class="text-xs">Public Files</span>
            </div>
        </div>

        @if (Auth::user()->status == 2)
        <div>
            <x-partial.tertiary-button class="flex-col justify-center w-full aspect-square !mb-1" data-tooltip-target="du" href="/a/users" :path="request()->is('a/*')">
                <svg class="w-5 h-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M15 19.128a9.38 9.38 0 002.625.372 9.337 9.337 0 004.121-.952 4.125 4.125 0 00-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 018.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0111.964-3.07M12 6.375a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zm8.25 2.25a2.625 2.625 0 11-5.25 0 2.625 2.625 0 015.25 0z">
                    </path>
                </svg>
            </x-partial.tertiary-button>
            <div data-tooltip="du" data-tooltip-placement="right" tabindex="-1"
                class="absolute z-30 whitespace-normal opacity-0 break-words rounded-lg inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200  shadow-sm">
                <span class="text-xs">User Data</span>
            </div>
        </div>
        @endif
    </div>
    <hr class="my-2 h-px bg-gray-200 border-0" />
    <div>
        <div>
            <x-partial.tertiary-button class="flex-col justify-center w-full aspect-square !mb-1" data-tooltip-target="acc" href="{{ route('account.settings') }}" :path="request()->routeIs('account.settings')">
                <svg class="w-5 h-5 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                    stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                </svg>
            </x-partial.tertiary-button>
            <div data-tooltip="acc" data-tooltip-placement="right" tabindex="-1"
                class="absolute z-30 whitespace-normal opacity-0 break-words rounded-lg inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200  shadow-sm">
                <span class="text-xs">Settings</span>
            </div>
        </div>

        <div>
            <button data-modal-target="signout" data-modal-toggle="signout"
                class="flex flex-col gap-3 w-full aspect-square justify-center items-center mb-1 px-4 py-2.5 rounded-full hover:bg-gray-200"
                data-tooltip-target="lg">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" aria-hidden="true"
                    class="w-4 h-4">
                    <path fill-rule="evenodd"
                        d="M12 2.25a.75.75 0 01.75.75v9a.75.75 0 01-1.5 0V3a.75.75 0 01.75-.75zM6.166 5.106a.75.75 0 010 1.06 8.25 8.25 0 1011.668 0 .75.75 0 111.06-1.06c3.808 3.807 3.808 9.98 0 13.788-3.807 3.808-9.98 3.808-13.788 0-3.808-3.807-3.808-9.98 0-13.788a.75.75 0 011.06 0z"
                        clip-rule="evenodd"></path>
                </svg>
            </button>
            <div data-tooltip="lg" data-tooltip-placement="right" tabindex="-1"
                class="absolute z-30 whitespace-normal opacity-0 break-words rounded-lg inline-block px-3 py-2 text-sm font-normal text-gray-900 bg-white border border-gray-200  shadow-sm">
                <span class="text-xs">Log Out</span>
            </div>
        </div>

    </div>
</div>
