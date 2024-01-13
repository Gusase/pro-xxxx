<x-user :$jumlahPesan :$pesan :$pesanGrup>

    <x-slot name="title">
        {{ $file->judul_file . " ($file->original_filename)"}}
    </x-slot>
    <!-- Page Heading -->

    <x-section-center>
        <x-section-heading>
            <h3 class="text-2xl font-mona font-medium">
                File details
            </h3>
        </x-section-heading>

        <div
            class="relative mx-auto block w-full overflow-hidden rounded-lg bg-gray-50 shadow-xl shadow-slate-200 sm:rounded-xl 2xl:w-auto lg:rounded-2xl">
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
            <div class="absolute inset-0 rounded-lg ring-1 ring-inset ring-black/10 sm:rounded-xl lg:rounded-2xl">
            </div>
        </div>
        <div class="mt-10 text-center lg:text-left">
            <div>
                <p class="text-xl font-semibold text-slate-900">{{ $file->judul_file }}</p>
            </div>
            <div class="space-y-1.5 mt-4">
                <span class="font-medium text-lg text-slate-700 font-mona mb-3">Detail umum</span>

                <div>
                    <span class="font-medium text-sm text-slate-700 font-mono mb-3">Pemilik</span>
                    <span
                        class="flex relative space-x-1 bg-gray-100 items-center overflow-hidden z-0 outline-none w-fit py-1 px-2 rounded-full">
                        <img src="{{ $file->pp === 'img/defaultProfile.svg' ? asset($file->pp) : asset('storage/' . $file->pp) }}"
                            class="flex object-cover w-6 h-6 rounded-full" alt="avatar">
                        <span class="tracking-tight text-xs font-medium text-slate-900 mr-px">
                            {{ $file->fullname ?? $file->user->fullname }}
                        </span>
                    </span>
                </div>
                @if(!is_null($file->pesan))
                <div>
                    <span class="font-medium text-sm text-slate-700 font-mono mb-3">Pesan</span>
                    <p class="tracking-tight text-base font-medium text-slate-900 mr-px">
                        {{ $file->pesan }}
                    </p>
                </div>
                @endif

                <div>
                    <span class="font-medium text-sm text-slate-700 font-mono mb-3">Nama File</span>
                    <p class="tracking-tight text-base font-medium text-slate-900 mr-px break-all">
                        {{ $file->original_filename}}
                    </p>
                </div>

                <div>
                    <span class="font-medium text-sm text-slate-700 font-mono mb-3">Ukuran</span>
                    <p class="tracking-tight text-base font-medium text-slate-900 mr-px">
                        {{ $file->file_size }}
                    </p>
                </div>

                <div>
                    <span class="font-medium text-sm text-slate-700 font-mono mb-3">Deskripsi</span>
                    <p class="tracking-tight text-base font-medium text-slate-900 mr-px">
                        @if(!$file->deskripsi) - @endif
                        {{ $file->deskripsi }}
                    </p>
                </div>
            </div>
            <div class="text-center mt-4">
                <div class="mt-3">
                    <small><a href="{{ url()->previous() }}">&laquo; Kembali</a></small>
                </div>
                {{-- <small style="">{{ $file->created_at }}</small> --}}
            </div>
            </tr>
        </div>
    </x-section-center>


    @push('script')
    <script src="{{ asset('js/buffer.js') }}"></script>
    <script src="{{ asset('js/form.js') }}"></script>
    @endpush

</x-user>