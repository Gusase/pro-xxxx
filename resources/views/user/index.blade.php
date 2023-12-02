<x-user :$jumlahPesan :$files :$pesan :$pesanGrup>

    <x-slot:title>
        Beranda
        </x-slot>

        <x-partial.flash class="!my-2" :flash="session()->all()"></x-partial.flash>

        @section('salam')
        <div class="py-3">
            <h3 class="text-3xl font-semibold">{{ $salam . ', ' . Auth::user()->fullname }}</h3>
        </div>
        @endsection
        <!-- DataTales Example -->
        <div class="grid grid-cols-3 gap-y-[20px] gap-x-[16px] xl:grid-cols-5 lg:grid-cols-4 mt-6">

            @foreach ($files as $file)
            @php
                $namaFile = explode('/', $file->generate_filename);
            @endphp

            <input type="hidden" value="{{ config('app.url') . 'd/' . $file->id_user . '/' . end($namaFile) }}"
                id="link" data-id_file="{{ $file->id_file }}">

            <a href="{{ route('file.detail',['username'=> Auth::user()->username,'id_file' =>$file->id_file]) }}"
                title="{{ $file->original_filename }}"
                class="w-full h-full max-w-sm p-2 bg-gray-100 border border-gray-200 rounded-lg shadow decoration-blue-500 decoration-2 hover:underline hover:underline-offset-2 hover:bg-gray-200/20 duration-150 hover:shadow-md card-file"
                data-id_file="{{ $file->id_file }}">

                <div class="flex justify-between items-center px-2 mb-2">
                    <h2 class="inline-block w-[139px] truncate font-medium text-gray-900 lg:w-full"
                        title="{{ $file->original_filename }}">{{ $file->original_filename }}</h2>
                </div>

                <div class="overflow-hidden h-40 mt-px cursor-pointer bg-white grid place-items-center">
                    @if (explode('/', $file['mime_type'])[0] == 'image')
                    <img src="{{ asset('storage/' . $file->generate_filename) }}" alt="{{ $file->judul_file }}"
                        class="object-contain h-full">
                    @else
                    <x-partial.asset.svg></x-partial.asset.svg>
                    @endif
                </div>
            </a>


            @endforeach


            <div id="dropdown" class="absolute hidden z-10 bg-white divide-y divide-gray-100 rounded-lg shadow w-52">
                <ul class="py-2 text-sm text-gray-700">
                    <li>
                        <a href="" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-3" id="edit"><i
                                class="fa-regular fa-pen-to-square"></i>
                            <p>Edit</p>
                        </a>
                    </li>
                    <li>
                        <a href="" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-3" id="download"><i
                                class="fa-solid fa-download"></i>
                            <p>Download</p>
                        </a>
                    </li>
                    <li>
                        <button class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-3 w-full" id="salin"><i
                                class="fa-solid fa-paperclip"></i>
                            <p class="ms-px">Bagikan dengan link</p>
                        </button>
                    </li>
                    <li>
                        <button id="bSearch" class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-2 w-full"
                            data-id_file="" data-user="{{ Auth::user()->username }}"
                            data-modal-target="authentication-modal" data-modal-toggle="authentication-modal"><i
                                class="fa-solid fa-users"></i>Bagikan dengan
                            user</button>
                    </li>
                    <li>
                        <button class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-3 w-full"
                            data-modal-target="deleteFile" data-modal-toggle="deleteFile"><i
                                class="fa-solid fa-trash"></i>
                            <p>Hapus</p>
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div id="authentication-modal" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Share another user
                        </h3>
                        <button type="button"
                            class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="authentication-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5">
                        <form class="space-y-4" id="form">
                            <div class="relative">
                                <label for="searchUser"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">To user</label>
                                <input type="text" id="searchUser" autofocus name="username"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"
                                    placeholder="{{ Auth::user()->username }}" required>
                                <small id="notfon"
                                    class="block ms-2 text-sm font-medium text-gray-900 dark:text-gray-300"></small>
                                <ul id="result"
                                    class="hidden absolute w-full z-10 py-2 text-sm text-gray-700 bg-white border-2">
                                </ul>
                            </div>
                            <div>
                                <label for="pesan"
                                    class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your
                                    message</label>
                                <textarea id="pesan" rows="2"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "
                                    placeholder="Write a message..." required name="pesan" id="pesan"></textarea>
                            </div>
                            <button type="submit" id="kirimUser"
                                class="w-full cursor-not-allowed text-white bg-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>


        <div id="deleteFile" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center"
                        data-modal-hide="deleteFile">
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
                        <form action="" id="formDelete" class="inline" method="post">
                            @method('delete')
                            @csrf
                            <button data-modal-hide="deleteFile" type="submit"
                                class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center me-2">
                                Yes, I'm sure
                            </button>
                        </form>
                        <button data-modal-hide="deleteFile" type="button"
                            class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">No,
                            cancel</button>
                    </div>
                </div>
            </div>
        </div>
</x-user>



<div class="fixed md:hidden end-6 bottom-6 group">
    <a href="/file/create"
        class="flex items-center justify-center text-white bg-gray-900 rounded-full w-14 h-14 hover:bg-white hover:text-gray-900 hover:border-2 hover:border-gray-900 ease-linear focus:ring-4 focus:ring-gray-300 focus:outline-none">
        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M9 1v16M1 9h16" />
        </svg>
    </a>
</div>


<div id="logo-sidebar"
    class="md:hidden fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full md:translate-x-0"
    aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
        <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
            <img src="\vendor\fontawesome-free\svgs\solid\box.svg" alt="{{ env('APP_NAME') }}"
                class="flex justify-center items-center w-8">
            <p class="text-xl font-semibold mx-3">{{ env('APP_NAME') }} <sup>❤</sup></p>
        </a>
        <ul class="space-y-2 font-medium">
            <li>
                <a class="flex gap-3 items-center mb-3 px-4 py-2.5 rounded-full {{ request()->is('/') ? 'bg-gray-300' : 'hover:bg-gray-200' }}"
                    href="/">
                    <img src="\vendor\fontawesome-free\svgs\solid\folder-closed.svg" alt="{{ env('APP_NAME') }}"
                        width="20">
                    <span>File Saya</span>
                </a>
            </li>
            <li>
                <a class="flex gap-3 items-center mb-3 px-4 py-2.5 rounded-full {{ request()->is('publikFile') ? 'bg-gray-300' : 'hover:bg-gray-200' }}"
                    href="/publikFile">
                    <i class="fa-solid fa-earth-americas"></i>
                    <span style="margin-left: 2px">Publik File</span>
                </a>
            </li>
            @if (Auth::user()->status == 2)
            <li>
                <a class="flex gap-3 items-center mb-3 px-4 py-2.5 rounded-full {{ request()->is('a/*') ? 'bg-gray-300' : 'hover:bg-gray-200' }}"
                    href="/a/users">
                    <i class="fa-regular fa-user"></i>
                    <span class="ml-1">Data User</span>
                </a>
            </li>
            @endif
        </ul>
    </div>
</div>