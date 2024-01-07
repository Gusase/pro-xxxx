<x-user :$jumlahPesan :$pesan :$pesanGrup>

    <x-slot name="title">
        {{ $file->judul_file . " ($file->original_filename)"}}
    </x-slot>
    <!-- Page Heading -->

    <div
        class="relative z-10 mx-auto px-4 pb-4 pt-10 sm:px-6 md:max-w-2xl md:px-4 lg:min-h-full lg:flex-auto lg:border-x lg:border-slate-200 lg:px-8 lg:py-12 xl:px-12">
        <x-section-heading>
            <h3 class="text-2xl font-mona font-medium">
                File details
            </h3>
        </x-section-heading>

        <div
            class="relative mx-auto block w-48 overflow-hidden rounded-lg bg-gray-50 shadow-xl shadow-slate-200 sm:w-64 sm:rounded-xl lg:w-auto lg:rounded-2xl">
            @php
            $mime=explode('/', $file->mime_type);
            $extension =$file->ekstensi_file;
            @endphp
            @if ($mime[0] == 'image')
            <img data-src="{{ asset('storage/' . $file->generate_filename) }}" alt="{{ $file->judul_file }}"
                class="object-contain h-full mx-auto">
            @else
            <div class="w-80 h-80 grid place-items-center mx-auto">
                <x-partial.asset.svg :ext="$extension" />
            </div>
            @endif
            <div class="absolute inset-0 rounded-lg ring-1 ring-inset ring-black/10 sm:rounded-xl lg:rounded-2xl"></div>
        </div>
        <div class="mt-10 text-center lg:text-left">
            <div>
                <p class="text-xl font-semibold text-slate-900">{{ $file->judul_file }}</p>
                <p class="-mt-1 text-lg font-normal leading-8 text-slate-700">{{ $file->original_filename }}</p>
            </div>
            <div class="">
                <span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded">{{
                    $file->status }}</span>
                <a href="{{ route('file.download',$file->id_file) }}"
                    class="block px-4 py-2 hover:bg-gray-100 flex items-center gap-3" id="download"><i
                        class="fa-solid fa-download"></i>
                    <p>Download</p>
                </a>
                <div class="">
                    Detail
                </div>
                <ul class="">
                    @if (request()->is('*/share/*'))
                    <li class=""><b>Dari</b> :
                        {{ $file->fullname }}
                    </li>
                    @endif
                    @if(!is_null($file->pesan))
                    <li class=""><b>Pesan</b> :
                        {{ $file->pesan }}
                    </li>
                    @endif
                    <li class=""><b>Nama File</b> :
                        {{ $file->original_filename }}
                    </li>
                    <li class=""><b>Size</b> :
                        {{ $file->file_size }}
                    </li>
                    <li class=""><b>Deskripsi</b> : @if(!$file->deskripsi) - @endif
                        {{ $file->deskripsi }}
                    </li>
                </ul>
            </div>
            <div class="text-center mt-4">
                <div class="mt-3">
                    <small><a href="{{ url()->previous() }}">&laquo; Kembali</a></small>
                </div>
                {{-- <small style="">{{ $file->created_at }}</small> --}}
            </div>
            </tr>
        </div>
    </div>

    @push('script')
    <script src="{{ asset('js/buffer.js') }}"></script>
    <script src="{{ asset('js/form.js') }}"></script>
    @endpush

</x-user>