<x-user :$jumlahPesan :$files :$pesan :$pesanGrup>

    <x-slot:title>
        Dashboard - {{ config('app.name') }}
    </x-slot>

    <x-partial.flash class="!my-2 shadow-md" :flash="session()->all()" />

    <div class="@if (count($files)) lg:grid-cols-4 2xl:grid-cols-5 min-[2368px]:grid-cols-6  sm:grid-cols-2 md:grid-cols-3 @else sm:grid-cols-1 md:grid-cols-1 place-items-center 2xl:grid-cols-1 min-[2368px]:grid-cols-1 lg:grid-cols-1 h-[90%] @endif grid grid-cols-1 gap-y-[20px] gap-x-[16px] p-3 sm:p-5">
    @if ($files->isEmpty())
        <h1 class="text-center mx-auto text-gray-400 font-semibold text-4xl">No files yet</h1>
    @endif
        @foreach ($files as $file)
        @php
        $namaFile = explode('/', $file->generate_filename);
        @endphp
        <input type="hidden" value="{{ config('app.url') . 'd/' . $file->id_user . '/' . end($namaFile) }}" id="link"
            data-id_file="{{ $file->id_file }}">

        <!-- Dropdown menu -->
        <div id="file-#{{ $file->id_file }}"
            class="z-50 hidden w-44 list-none divide-y divide-gray-100 overflow-hidden rounded-lg bg-white text-base shadow dropdownUserIndex">
            <ul>
                <li>
                    <a href="{{ route('file.edit', $file->id_file) }}"
                        class="inline-flex w-full items-center px-4 py-2 text-sm hover:bg-gray-100">
                        <svg class="mr-2 h-3 w-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="currentColor" viewBox="0 0 20 18">
                            <path
                                d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z" />
                            <path
                                d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z" />
                        </svg>
                        <span>Edit</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('file.download', $file->id_file) }}"
                        class="inline-flex w-full items-center px-4 py-2 text-sm hover:bg-gray-100">
                        <svg class="mr-2 h-3 w-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 16 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                        </svg>
                        <span>Download</span>
                    </a>
                </li>
                <li>
                    <button
                        class="inline-flex items-center whitespace-nowrap px-4 py-2 text-sm hover:bg-gray-100 w-full"
                        id="salin" data-id_file="{{ $file->id_file }}">
                        <svg class="mr-2 h-3 w-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 19 19">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.013 7.962a3.519 3.519 0 0 0-4.975 0l-3.554 3.554a3.518 3.518 0 0 0 4.975 4.975l.461-.46m-.461-4.515a3.518 3.518 0 0 0 4.975 0l3.553-3.554a3.518 3.518 0 0 0-4.974-4.975L10.3 3.7" />
                        </svg>
                        <span>Share with link</span>
                    </button>
                </li>
                <li>
                    <button class="inline-flex items-center whitespace-nowrap px-4 py-2 text-sm hover:bg-gray-100"
                        id="buttonShowModalShare" data-user="{{ Auth::user()->username }}"
                        data-modal-target="modalShareAnotherUser" data-modal-toggle="modalShareAnotherUser"
                        data-id_file="{{ $file->id_file }}">
                        <svg class="mr-2 h-4 w-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                        </svg>
                        <span>Share with user</span>
                    </button>
                </li>
                <li>
                    <button data-modal-target="modalDeleteFile" data-modal-toggle="modalDeleteFile"
                        id="buttonShowModalDelete" data-id_file="{{ $file->id_file }}"
                        class="inline-flex w-full items-center bg-red-500 px-4 py-2 text-left text-sm text-white hover:bg-red-600">
                        <svg class="mr-2 h-3 w-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 18 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                        </svg>
                        <span>Hapus</span>
                    </button>
                </li>
            </ul>
        </div>

        <div title="{{ $file->original_filename }}"
            class="flex w-full max-w-full flex-col bg-gray-100 border border-gray-200 rounded-lg shadow hover:bg-gray-200/20 duration-150 hover:shadow-md pb-2 card-file"
            data-id_file="{{ $file->id_file }}">

            <div class="flex justify-between px-2 mt-2 my-1">
                <a href="{{ route('file.detail', ['username' => Auth::user()->username, 'id_file' => $file->id_file]) }}"
                    class="w-full">
                    <span
                        class="line-clamp-1 break-all font-medium text-gray-800 w-fit isolate relative font-mona no-underline after:absolute after:right-[.05em] after:bottom-0 after:left-[.05em] after:block after:-z-[1] after:h-px after:bg-gray-400 after:transition-transform after:scale-x-100 after:origin-bottom-left hover:after:scale-x-0 hover:after:origin-bottom-right before:absolute before:inset-0 before:-z-[1] before:block before:bg-gray-300/75 before:transition-transform before:scale-x-0 before:origin-bottom-right hover:before:scale-x-100 hover:before:origin-bottom-left hover:text-black duration-150 p-0.5 pb-0 text-base sm:text-lg font-mona"
                        title="{{ $file->original_filename }}">{{ $file->original_filename }}</span>
                </a>
                <button data-dropdown-toggle="file-#{{ $file->id_file }}" data-modal-byclick
                    class="inline-block rounded-full ml-1 h-max mt-0.5 -mr-0.5 p-1.5 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                    type="button">
                    <span class="sr-only">Open dropdown</span>
                    <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 16 3">
                        <path
                            d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                    </svg>
                </button>
            </div>

            <a href="{{ route('file.detail', ['username' => Auth::user()->username, 'id_file' => $file->id_file]) }}"
                class="overflow-hidden h-40 mt-px cursor-pointer bg-white grid place-items-center relative isolate before:absolute before:inset-0 before:z-10 before:block before:origin-bottom-left before:scale-x-0 before:bg-gradient-to-r before:from-gray-200/25 before:opacity-25 before:transition-all hover:before:origin-top-left hover:before:scale-x-100 hover:before:opacity-100">
                @php
                $mime = explode('/', $file->mime_type);
                $extension = $file->ekstensi_file;
                @endphp
                @if ($mime[0] == 'image')
                <img data-src="{{ asset('storage/' . $file->generate_filename) }}" alt="{{ $file->judul_file }}"
                    class="object-contain h-[inherit]">
                @else
                <x-partial.asset.svg :ext="$extension" />
                @endif
            </a>
        </div>
        @endforeach
    </div>


    <!-- 
            Dropdown menu based on oright click
        -->

    <div id="dropdown" class="absolute hidden z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
        <ul class="py-2 text-sm text-gray-700">
            <li>
                <a href="" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-3" id="edit">
                    <svg class="h-4 w-4 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 18">
                        <path
                            d="M12.687 14.408a3.01 3.01 0 0 1-1.533.821l-3.566.713a3 3 0 0 1-3.53-3.53l.713-3.566a3.01 3.01 0 0 1 .821-1.533L10.905 2H2.167A2.169 2.169 0 0 0 0 4.167v11.666A2.169 2.169 0 0 0 2.167 18h11.666A2.169 2.169 0 0 0 16 15.833V11.1l-3.313 3.308Zm5.53-9.065.546-.546a2.518 2.518 0 0 0 0-3.56 2.576 2.576 0 0 0-3.559 0l-.547.547 3.56 3.56Z">
                        </path>
                        <path
                            d="M13.243 3.2 7.359 9.081a.5.5 0 0 0-.136.256L6.51 12.9a.5.5 0 0 0 .59.59l3.566-.713a.5.5 0 0 0 .255-.136L16.8 6.757 13.243 3.2Z">
                        </path>
                    </svg>
                    <span>Edit</span>
                </a>
            </li>
            <li>
                <a href="" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-3" id="download">
                    <svg class="mr-1 h-3 w-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 16 18">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                    </svg>
                    <span>Download</span>
                </a>
            </li>
            <li>
                <button class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-3 w-full" id="rcCopy">
                    <svg class="mr-1 h-3 w-3 text-gray-800" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 19 19">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11.013 7.962a3.519 3.519 0 0 0-4.975 0l-3.554 3.554a3.518 3.518 0 0 0 4.975 4.975l.461-.46m-.461-4.515a3.518 3.518 0 0 0 4.975 0l3.553-3.554a3.518 3.518 0 0 0-4.974-4.975L10.3 3.7" />
                    </svg>
                    <span class="ms-px">Share with link</span>
                </button>
            </li>
            <li>
                <button id="bSearch" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-3 w-full"
                    data-id_file="" data-user="{{ Auth::user()->username }}" data-modal-toggle="modalShareAnotherUser">
                    <svg class="mr-0.5 h-4 w-4 text-gray-800" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                    </svg>
                    <span>Share with user</span>
                </button>
            </li>
            <li>
                <button
                    class="inline-flex items-center gap-3 w-full bg-red-500 px-4 py-2 text-left text-sm text-white hover:bg-red-600"
                    data-modal-target="modalDeleteFile" data-modal-toggle="modalDeleteFile">
                    <svg class="mr-1 h-3 w-3 text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="none" viewBox="0 0 18 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 5h16M7 8v8m4-8v8M7 1h4a1 1 0 0 1 1 1v3H6V2a1 1 0 0 1 1-1ZM3 5h12v13a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V5Z" />
                    </svg>
                    <span>Hapus</span>
                </button>
            </li>
        </ul>
    </div>


    <!--
            Main modal fol sharing file
        -->

    <div id="modalShareAnotherUser" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Share Another User
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 focus:bg-gray-200 focus:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="modalShareAnotherUser">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5 space-y-4">
                    <form id="formShareFile" method="POST">
                        @csrf
                        <div class="mb-3 -mt-2 space-y-1">
                            <h5 class="font-medium">Now sharing: </h5>
                            <span class="font-mono fileshrnm truncate inline-block w-[calc(95%_+_1rem)]">~</span>
                        </div>
                        <div class="space-y-4">
                            <div class="relative">
                                <label for="searchUser" class="block mb-2 text-sm font-medium text-gray-900">To
                                    user</label>
                                <input type="text" id="searchUser" name="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="someone..." required>
                                <small id="notfon" class="block text-sm font-medium text-gray-800 my-1.5"></small>
                                <ul id="result"
                                    class="hidden absolute z-20 shadow w-full py-2 text-sm text-gray-700 bg-white border-2 rounded-b-lg border-x border-gray-500">
                                </ul>
                            </div>
                            <div>
                                <label for="pesan" class="block mb-2 text-sm font-medium text-gray-900">Your
                                    message</label>
                                <textarea rows="2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="From {{ Auth::user()->username }}..." name="pesan"
                                    id="pesan"></textarea>
                            </div>
                        </div>
                        <div class="flex flex-col items-center border-t border-gray-200 rounded-b mt-2">
                            <x-partial.primary-button onclick="process(event)" id="sendFile" disabled
                                class="!w-full text-white bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300 font-medium rounded-lg focus:ring-offset-2 text-sm px-5 py-2.5 text-center">
                                Send
                            </x-partial.primary-button>
                            <x-partial.secondary-button class="justify-center w-full text-center mt-2"
                                data-modal-hide="modalShareAnotherUser">
                                Cancel
                            </x-partial.secondary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- 
            Modal for sharing a file (sebelumnya)
        -->

    {{-- <div id="shareModal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Share another user
                    </h3>
                    <button type="button"
                        class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="shareModal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <form id="form" method="POST">
                        @csrf
                        <div class="mb-3 -mt-2 space-y-1">
                            <h5 class="font-medium">Now sharing: </h5>
                            <span class="font-mono filenm truncate inline-block w-[calc(95%_+_1rem)]">~</span>
                        </div>
                        <div class="space-y-4">
                            <div class="relative">
                                <label for="searchUser" class="block mb-2 text-sm font-medium text-gray-900">To
                                    user</label>
                                <input type="text" id="searchUser" autofocus name="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5"
                                    placeholder="..." required>
                                <small id="notfon" class="block text-sm font-medium text-gray-800 my-1.5"></small>
                                <ul id="result"
                                    class="hidden w-full py-2 text-sm text-gray-700 bg-white border-2 rounded-b-lg border-x border-blue-500">
                                </ul>
                            </div>
                            <div>
                                <label for="pesan" class="block mb-2 text-sm font-medium text-gray-900">Your
                                    message</label>
                                <textarea id="pesan" rows="2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="From {{ Auth::user()->username }}..." required name="pesan"
                                    id="pesan"></textarea>
                            </div>
                            <button type="submit" id="kirimUser"
                                class="w-full text-white bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- 
            Modal for deleting a file
        -->

    <div id="modalDeleteFile" tabindex="-1"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <div class="relative bg-white rounded-lg shadow">
                <button type="button"
                    class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                    data-modal-hide="modalDeleteFile">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
                <div class="p-4 md:p-5 text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-12 h-12" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <h3 class="mb-5 text-lg font-normal text-gray-500">Are you sure you want to
                        delete this file?</h3>
                    <form action="" id="formDeleteFile" class="inline" method="post">
                        @method('delete')
                        @csrf
                        <button data-modal-hide="modalDeleteFile" type="submit"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                            Delete
                        </button>
                    </form>
                    <button data-modal-hide="modalDeleteFile" type="button"
                        class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No,
                        cancel</button>
                </div>
            </div>
        </div>
    </div>

    <!-- 
            Modal for notification button
        -->

    <div id="allNotifications" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed pt-3 top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-md h-full">
            <div class="relative bg-white rounded-lg shadow h-full overflow-y-auto">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t">
                    <h3 class="text-lg font-semibold text-gray-900">
                        All Message
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center"
                        data-modal-toggle="allNotifications">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5">
                    <ul class="space-y-4">
                        @foreach ($pesan as $p)
                        <li>
                            <a href="{{ route('file.share.detail', [$p->user->username, $p->id_file]) }}"
                                class="inline-flex items-center justify-between w-full p-3 px-5 text-gray-900 bg-white border border-gray-200 rounded-lg cursor-pointer  hover:text-gray-900 hover:bg-gray-100">
                                <img class="w-10 aspect-square rounded-full object-cover"
                                    src="{{ $p->user->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . $p->user->pp) }}"
                                    alt="{{ $p->id_pengirim }}">
                                <div class="block">
                                    <div title="{{ $p->created_at }}" class="text-xs text-gray-700">
                                        {{ $p->created_at->format('F d, Y h:iA') }}
                                    </div>
                                    <span class="text-base"><b>{{ $p->user->username }}</b> sent you a file! View
                                        file.</span>
                                </div>
                                <svg class="w-4 h-4 ms-3 rtl:rotate-180 text-gray-500"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>


    @push('script')
    <script src="{{ asset('js/buffer.js') }}"></script>
    @endpush
</x-user>