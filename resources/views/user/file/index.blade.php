<x-user :$title :$jumlahPesan :$pesan :$files :$pesanGrup>

    <x-partial.flash class="!mt-1 mb-4
    " :flash="session()->all()" />

    <x-section-heading class="mb-3 mt-5 pl-4">
        <h3 class="text-2xl sm:text-3xl font-medium font-mona">Discover all files</h3>
    </x-section-heading>

    <div
        class="@if (count($files)) lg:grid-cols-4 2xl:grid-cols-5 min-[2368px]:grid-cols-6  sm:grid-cols-2 md:grid-cols-3 @else sm:grid-cols-1 md:grid-cols-1 place-items-center 2xl:grid-cols-1 min-[2368px]:grid-cols-1 lg:grid-cols-1 h-[90%] @endif grid grid-cols-1 gap-y-[20px] gap-x-[16px] p-3 sm:p-5">
        @unless (count($files))
            <h1 class="text-center mx-auto text-gray-400 font-semibold text-4xl">No files yet</h1>
        @endunless
        @foreach ($files as $file)
            @php
                $namaFile = explode('/', $file->generate_filename);
            @endphp
            <input type="hidden" value="{{ config('app.url') . 'dp/' . $file->id_user . '/' . end($namaFile) }}"
                id="link" data-id_file="{{ $file->id_file }}">
            <div
                class="flex w-full max-w-full flex-col bg-gray-100 border border-gray-200 rounded-lg shadow hover:bg-gray-200/20 duration-150 hover:shadow-md pb-2">
                {{-- dropdown menu --}}
                <div class="flex justify-end px-4">
                    <!-- Dropdown menu -->
                    <div id="file-#{{ $file->id_file }}"
                        class="z-50 hidden w-44 list-none divide-y divide-gray-100 overflow-hidden rounded-lg bg-white text-base shadow font-poppins font-light">
                        <ul lc>
                            <li>
                                <a href="{{ route('file.download', $file->id_file) }}"
                                    class="inline-flex w-full items-center px-4 py-2 text-sm hover:bg-gray-100"><svg
                                        class="mr-2 h-3 w-3 text-gray-800" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 16 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                                    </svg>Download</a>
                            </li>
                            <li>
                                <button id="salin" data-id_file="{{ $file->id_file }}"
                                    class="inline-flex items-center w-full whitespace-nowrap px-4 py-2 text-sm hover:bg-gray-100">
                                    <svg class="mr-2 h-3 w-3 text-gray-800" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 19 19">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2"
                                            d="M11.013 7.962a3.519 3.519 0 0 0-4.975 0l-3.554 3.554a3.518 3.518 0 0 0 4.975 4.975l.461-.46m-.461-4.515a3.518 3.518 0 0 0 4.975 0l3.553-3.554a3.518 3.518 0 0 0-4.974-4.975L10.3 3.7" />
                                    </svg>
                                    Share with link</button>
                            </li>
                        </ul>
                    </div>
                </div>
                {{-- Profile user --}}
                <div class="my-1 px-3 py-1">
                    <div class="flex justify-between">
                        <div class="flex items-center gap-1 flex-1 min-w-0">
                            <img alt=""
                                src="{{ $file->user->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . $file->user->pp) }}"
                                class="relative inline-block h-9 w-9 aspect-square !rounded-full  border-2 border-white object-cover object-center hover:z-10" />
                            <div class="w-[90%] sm:min-w-[inherit] lg:w-full">
                                <a href="{{ route('profile', $file->user->username) }}"
                                    class="break-all text-sm antialiased font-medium tracking-normal text-inherit line-clamp-1 w-fit isolate relative font-mona no-underline before:absolute before:inset-0 before:-z-[1] before:block before:bg-gray-300/75 before:transition-transform before:scale-x-0 before:origin-bottom-right hover:before:scale-x-100 hover:before:origin-bottom-left hover:text-black duration-150 p-0.5 pb-0">
                                    {{ $file->user->fullname }}</a>
                                <p class="block font-poppins text-xs antialiased font-light leading-normal text-gray-500 -mt-px"
                                    title="{{ $file->created_at }}">
                                    {{ $file->created_at->diffForHumans() == '1 month ago' ? $file->created_at->format('d M Y') : $file->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <button id="dropdw" data-dropdown-toggle="file-#{{ $file->id_file }}"
                            class="inline-block rounded-full ml-1 -mr-0.5 h-fit p-1.5 text-sm text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200"
                            type="button">
                            <span class="sr-only">Open dropdown</span>
                            <svg class="h-5 w-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 16 3">
                                <path
                                    d="M2 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Zm6.041 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM14 0a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3Z" />
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- <div title="Filename: {{ $file->original_filename }}">
                    <div class="mt-px cursor-default">
                        <a href="{{ route('file.detail', ['id_file' => $file->id_file, 'username' => $file->user->username]) }}"
                            class="overflow-hidden h-40 bg-white grid place-items-center relative isolate before:absolute before:inset-0 before:z-10 before:block before:origin-bottom-left before:scale-x-0 before:bg-gradient-to-r before:from-gray-200/25 before:opacity-25 before:transition-all hover:before:origin-top-left hover:before:scale-x-100 hover:before:opacity-100">
                            @php
                                $mime = explode('/', $file->mime_type);
                                $extension = $file->ekstensi_file;
                            @endphp
                            @if (explode('/', $file['mime_type'])[0] == 'image')
                                <img data-src="{{ asset('storage/' . $file->generate_filename) }}"
                                    alt="{{ $file->judul_file }}" class="object-contain h-[inherit]">
                            @else
                                <x-partial.asset.svg :ext="$extension" />
                            @endif
                        </a>
                    </div>

                    <div class="pt-1 px-3 space-y-px">
                        <a href="{{ route('file.detail', ['id_file' => $file->id_file, 'username' => $file->user->username]) }}"
                            class="line-clamp-2 font-normal text-gray-900 isolate relative font-mona no-underline after:absolute after:right-[.05em] after:bottom-0 after:left-[.05em] after:block after:-z-[1] after:h-px after:bg-gray-400 after:transition-transform after:scale-x-100 after:origin-bottom-left hover:after:scale-x-0 hover:after:origin-bottom-right before:absolute before:inset-0 before:-z-[1] before:block before:bg-gray-300/75 before:transition-transform before:scale-x-0 before:origin-bottom-right hover:before:scale-x-100 hover:before:origin-bottom-left hover:text-black duration-150 p-0.5 pb-0 w-fit"
                            title="{{ $file->judul_file }}">{{ $file->judul_file }}</a>
                        <p class="-mt-2 text-sm w-[calc(95%_+_1rem)] truncate text-gray-600/70 font-inter font-normal">
                            {{ $file->original_filename }}
                        </p>
                    </div>
                </div> --}}
            </div>
        @endforeach
    </div>

    @push('script')
        <script src="{{ asset('js/buffer.js') }}"></script>
    @endpush
</x-user>
