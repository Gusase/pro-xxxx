@push('style')
<style>
    @media (min-width:768px) {
        .header-img::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #000;
            background-image: radial-gradient(at 96.9% 8.3%, #3d3d3d 0px, transparent 50%), radial-gradient(at 1850.0% 1647.1%, #f8ffe3 0px, transparent 50%), radial-gradient(at 34.7% 83.7%, #0f0f0f 0px, transparent 50%);
            z-index: -1;
        }
    }

    .header-sec::after {
        /* background: linear-gradient(90deg, #191616 28%, hsla(0, 0%, 2%, 0.98) 20%, hsla(0, 0%, 6.3%, 0.97) 25%, hsla(0, 0%, 9%, .95) 35%, hsla(0, 0%, 9%, .94) 40%, hsla(0, 3%, 6.5%, 0.92) 45%, hsla(0, 0%, 9%, .9) 50%, hsla(0, 0%, 9%, .87) 55%, hsla(0, 0%, 9%, .82) 60%, hsla(0, 0%, 9%, .75) 65%, hsla(0, 0%, 9%, .63) 70%, hsla(0, 0%, 9%, .45) 75%, hsla(0, 0%, 9%, .27) 80%, hsla(0, 0%, 9%, .15) 85%, hsla(0, 0%, 9%, .08) 90%, hsla(0, 0%, 9%, .03) 95%, hsla(0, 0%, 9%, 0)); */
        background: linear-gradient(to left, transparent 0%, #000000 69%);
        bottom: 0;
        content: "";
        left: 0;
        position: absolute;
        right: -200px;
        top: 0;
        z-index: -1;
    }
</style>
@endpush

<x-user :$title :$user :$jumlahPesan :$pesan>

    <x-partial.flash class="!my-2" :flash="session()->all()" />

    <section class="bg-[#191616] isolate relative min-[2368px]:px-12 py-9 -mx-1 sm:-mx-4 no-scrollbar">
        <div class="flex items-center flex-col md:flex-row header-img justify-between ">
            <div
                class="w-full flex items-center sm:items-start flex-col sm:flex-row gap-x-4 sm:gap-x-6 xl:pl-6 max-w-xl lg:max-w-full">
                <div class="min-w-0">
                    <img src="{{ $user->pp === 'img/defaultProfile.svg' ? asset('img/defaultProfile.svg') : asset('storage/' . $user->pp) }}"
                        loading="lazy" decoding="async" alt="{{ $user->username }}"
                        class="w-24 p-1 object-cover aspect-square border-2 border-gray-300 rounded-full sm:block sm:w-[8.3rem] sm:h-[8.3rem]">
                </div>
                <div
                    class="w-full flex items-center sm:text-left text-center sm:items-start justify-center gap-y-3 flex-col flex-1 sm:mt-2 z-10 md:gap-y-2.5">
                    <div class="mt-1 md:mt-0">
                        @php
                        $usr = strlen($user->username) > 15;
                        $fl = strlen($user->fullname) > 36;
                        @endphp
                        <a href="#flnm" data-sr="" class="sr-only focus:not-sr-only text-gray-100 text-sm">Open
                            fullname</a>
                        <h1 {{ $fl ? 'id=flnm' : '' }} @class([ 'mt-2' , 'sm:mt-0' , 'text-white' , 'sm:text-4xl'
                            , 'tracking-tight' , 'leading-tight' , 'text-2xl' , 'break-all' , 'font-semibold'
                            , 'duration-150' , 'font-mona' , 'line-clamp-1'=> $fl,
                            'w-9/12 mx-auto sm:mx-0' => $fl,
                            'cursor-pointer' => $fl,
                            'hover:text-gray-50/95' => $fl,
                            ])>{{ $user->fullname }}</h1>
                        <p @class([ 'font-light' , 'font-poppins' , '-mt-px' , 'text-gray-300' , 'pl-px' , 'text-sm'=>
                            $usr,
                            ])>{{ $user->username }}
                        </p>
                    </div>
                    <p
                        class="text-xs md:text-sm text-slate-200 inline-flex items-center gap-x-0.5 sm:gap-x-1 font-light">
                        Joined on {{ $user->created_at->format('M d, Y') }}
                    </p>
                    @if ($user->id_user == Auth::id() && $user->username == Auth::user()->username)
                    <a class="inline-flex rounded-full px-4 py-1.5 text-sm font-inter w-[calc(100%_-_2.5rem)] min-[414px]:w-48 sm:w-max font-normal z-10 transition bg-white text-neutral-950 hover:bg-neutral-200"
                        href="{{ route('account.settings') }}"><span class="relative top-px mx-auto">Edit</span>
                    </a>
                    @endif
                </div>
            </div>
            @unless ($user->files->isEmpty())
            <div
                class="p-4 hidden md:block lg:w-auto mt-8 sm:w-full max-w-xl sm:mt-12 md:mt-0 relative md:before:hidden md:after:hidden before:absolute after:absolute before:bg-gray-200 after:bg-gray-200/70 before:left-0 before:top-0 before:h-px before:w-6 after:left-8 after:right-0 after:top-0 after:h-px">
                <div class="flex items-center max-md:justify-around w-full max-md:gap-x-3">
                    <div
                        class="text-center sm:py-5 sm:pl-8 sm:pr-7 rounded-lg max-md:ring-1 max-md:ring-gray-50/30 w-full p-4 relative before:hidden after:hidden md:before:block md:after:block before:absolute after:absolute before:bg-white after:bg-white/30 before:left-0 before:top-0 before:h-6 before:w-px after:bottom-0 after:left-0 after:top-8 after:w-px">
                        <h1 class="text-2xl font-semibold sm:text-4xl text-white font-mona"
                            style='font-variation-settings: "wdth" 125;'>{{ $user->files->count() }}</h1>
                        <p class="text-[0.7rem] mt-2 sm:text-sm text-gray-100 font-poppins font-light">File{{ ($user->files->count() == 1) ? null : 's' }}</p>
                    </div>
                    <div
                        class="text-center sm:pl-8 sm:pr-0 pl-4 relative before:hidden after:hidden md:before:block md:after:block before:absolute after:absolute before:bg-white after:bg-white/30 before:left-0 before:top-0 before:h-6 before:w-px after:bottom-0 after:left-0 after:top-8 after:w-px">
                        <a href="{{ route('file.detail', [$user->username, $user->files[0]->id_file]) }}"
                            title="Title: {{ $user->files[0]->judul_file }}"
                            class="rounded-lg overflow-hidden relative block group">
                            @php
                            $mime = explode('/', $user->files[0]->mime_type);
                            $extension = $user->files[0]->ekstensi_file;
                            @endphp
                            <div class="w-40 h-[calc(4rem_+_1.5rem)] sm:w-52 sm:h-28">
                                @if (explode('/', $user->files[0]['mime_type'])[0] == 'image')
                                <img data-src="{{ asset('storage/' . $user->files[0]->generate_filename) }}"
                                    alt="{{ $user->files[0]->judul_file }}"
                                    class="object-cover w-[inherit] h-[inherit] bg-slate-100">
                                @else
                                <div class="w-[inherit] h-[inherit] bg-white grid place-items-center">
                                    <x-asset.svg :ext="$extension" />
                                </div>
                                @endif
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-t from-black to-black/0 to-70% sm:to-65%"></div>
                            <div class="absolute bottom-3 left-3 text-left">
                                <p class="text-[0.7rem] mt-2 sm:text-sm font-poppins font-normal text-gray-100">Newest:
                                </p>
                                <p class="text-sm text-white line-clamp-1">{{ $user->files[0]->judul_file }}</p>
                            </div>
                            <span
                                class="font-poppins absolute inset-0 bg-white/70 backdrop-blur-md flex justify-center items-center text-lg capitalize text-gray-800 opacity-0 invisible group-hover:opacity-100 group-hover:visible duration-300">View
                                file
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            @endunless
        </div>
    </section>

    <section class="mt-2 py-6 px-2 space-y-8">
        <div>
            <x-section-heading>
                <h2 class="text-2xl font-medium font-mona leading-7 text-gray-900">Overview</h2>
            </x-section-heading>
            <ul role="list"
                class="grid max-w-2xl grid-cols-1 gap-x-6 gap-y-3 text-sm sm:grid-cols-2 md:gap-y-10 lg:max-w-none lg:grid-cols-3">
                <li class="rounded-2xl border border-gray-200 p-7 flex flex-col items-start gap-x-1.5">
                    <div class="w-8 h-8">
                        <h2 class="text-3xl font-semibold font-mona" style='font-variation-settings: "wdth" 125;'>
                            {{ $imageFile }}</h2>
                    </div>
                    <h3 class="font-mona font-normal text-gray-900 mt-2">Image files</h3>
                </li>
                <li class="rounded-2xl border border-gray-200 p-7 flex flex-col items-start gap-x-1.5">
                    <div class="w-8 h-8">
                        <h2 class="text-3xl font-semibold font-mona" style='font-variation-settings: "wdth" 125;'>
                            {{ $videoFile }}</h2>
                    </div>
                    <h3 class="font-mona font-normal text-gray-900 mt-2">Video files</h3>
                </li>
                <li class="rounded-2xl border border-gray-200 p-7 flex flex-col items-start gap-x-1.5">
                    <div class="w-8 h-8">
                        <h2 class="text-3xl font-semibold font-mona" style='font-variation-settings: "wdth" 125;'>
                            {{ $otherFile }}</h2>
                    </div>
                    <div>
                        <h3 class="inline-block font-mona font-normal text-gray-900 mt-2">Other files</h3>
                        <span class="ml-px text-xs font-normal font-mona text-gray-500/80">Excluding Image and Video
                            files
                        </span>
                    </div>
                </li>
            </ul>
        </div>

        <div>
            <x-section-heading>
                <h2 class="text-2xl font-medium font-mona leading-7 text-gray-900">
                    All file
                </h2>
            </x-section-heading>

            <div class="flex flex-wrap gap-y-4 -mx-px md:-mx-6">
                @unless (count($user->files))
                <p>Tidak ada file</p>
                @endunless
                @foreach ($user->files as $file)
                <div class="w-full sm:w-2/4 md:w-3/12 2xl:w-2/12 px-0 md:px-8">
                    <!-- main menu -->
                    <div class="flex-col border-b border-gray-300 py-6 h-full">
                        <div class="mt-px cursor-default">
                            <a href="{{ route('file.detail', ['id_file' => $file->id_file, 'username' => $file->user->username]) }}"
                                class="overflow-hidden h-40 group bg-white grid place-items-center">
                                @php
                                $mime = explode('/', $file->mime_type);
                                $extension = $file->ekstensi_file;
                                @endphp
                                @if (explode('/', $file['mime_type'])[0] == 'image')
                                <img data-src="{{ asset('storage/' . $file->generate_filename) }}"
                                    alt="{{ $file->judul_file }}" class="object-contain h-[inherit]">
                                @else
                                <x-asset.svg :ext="$extension" />
                                @endif
                            </a>
                        </div>
                        <div class="py-2 mt-2 px-3 space-y-1.5">
                            <a href="{{ route('file.detail', ['id_file' => $file->id_file, 'username' => $file->user->username]) }}"
                                class="font-medium text-gray-800 w-fit isolate relative font-mona no-underline after:absolute after:right-[.05em] after:bottom-0 after:left-[.05em] after:block after:-z-[1] after:h-px after:bg-gray-400 after:transition-transform after:scale-x-100 after:origin-bottom-left hover:after:scale-x-0 hover:after:origin-bottom-right before:absolute before:inset-0 before:-z-[1] before:block before:bg-gray-300/75 before:transition-transform before:scale-x-0 before:origin-bottom-right hover:before:scale-x-100 hover:before:origin-bottom-left hover:text-black duration-150 p-0.5 pb-0 text-lg line-clamp-2"
                                title="{{ $file->judul_file }}">{{ $file->judul_file }}</a>
                            <p class="-mt-2 text-base w-full text-gray-600 font-light line-clamp-2 font-mona">
                                {{ $file->deskripsi }}
                            </p>
                            <p class="font-mono text-base antialiased font-light leading-relaxed text-gray-500/80
                            " title="{{ $file->created_at->format('l, d F Y h:m:s') }}">
                                {{ $file->created_at->format('F d, Y') }}
                            </p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    @push('script')
    <script src="{{ asset('js/buffer.js') }}"></script>
    <script>
        const toggleClasses = (el, ...cls) => cls.map(cl => el.classList.toggle(cl));

            sr = document.querySelector('[data-sr=""]');
            expanNm = document.querySelector("#flnm") || false;

            if (expanNm) {
                sr.addEventListener('keypress', (e) => {
                    e.preventDefault()
                    if (e.keyCode === 13) {
                        toggleClasses(expanNm, 'line-clamp-1', 'w-9/12');
                    }
                })
                expanNm.addEventListener('click', () => {
                    expanNm.classList.toggle('line-clamp-1')
                    expanNm.classList.toggle('w-9/12')
                })
            }
    </script>
    @endpush

</x-user>