<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="smooth-scroll" dir="ltr">

<head>
    <x-partial.head.meta />

    <title>{{ $title }}</title>

    <x-partial.head.css />

</head>

<body class="antialiased bg-gray-100">

    <div class="bg-[inherit] h-screen md:pe-3 px-3 md:px-0 pb-4 2xl:pb-2 md:min-w-[1000px] md:max-w-[2000px] mx-auto">

        <header class="h-[70px]">
            <nav class="flex md:justify-between items-center gap-6 md:gap-0">
                @include('user.templates.topbar')
            </nav>
        </header>

        <div class="flex w-full h-[90%]">
            <aside class="hidden lg:block h-full w-24 py-1 px-5">
                @include('user.templates.sidebar')
            </aside>


            <main class="bg-white rounded-2xl h-full overflow-y-auto parent px-1.5 sm:px-4 w-full md:mx-3 lg:ml-0 no-scrollbar">
                {{ $slot }}
            </main>

        </div>
    </div>



    <!-- Main Script -->
    <script src="{{ asset('js/script.js') }}"></script>

    <!-- Additonal Script -->
    @stack('script')

    <!-- CDN Script -->
    <script type="module" src="https://unpkg.com/@material-tailwind/html@latest/scripts/tooltip.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
</body>

</html>