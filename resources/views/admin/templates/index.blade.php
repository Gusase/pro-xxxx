<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="smooth-scroll">

<head>

    @if (session('download'))
        <meta http-equiv="refresh" content="0; url={{ url('/download/' . session('download')) }}">
    @endif
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/logo.ico') }}">
    <meta name="author" content="">

    <title>{{ config('app.name') }} | {{ $title }}</title>

    <!-- Main Style-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Tailwindcss-->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Font Awesome-->
    <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- Custom Font -->
    <link href="https://fonts.cdnfonts.com/css/alliance-no1" rel="stylesheet">

    @stack('style')


</head>

<body>

    <div class="bg-gray-100 h-screen md:pe-3 px-3 pb-4 md:min-w-[1000px] md:max-w-[2000px]">

        <header class="h-[70px]">
            <nav class="flex md:justify-between items-center gap-6 md:gap-0">
                @include('admin.templates.topbar')
            </nav>
        </header>

        <div class="flex w-full h-[90%]">
            {{-- <aside class="hidden h-full w-60 py-3 px-5">
                @include('admin.templates.sidebar')
            </aside> --}}


            <main class="bg-white rounded-2xl h-full overflow-y-auto parent px-4 w-full">
                @yield('content')
            </main>

        </div>
        <div class="hidden">
            @include('admin.templates.modal')
        </div>
    </div>


    @stack('script')

    <!-- Main Script -->
    <script src="{{ asset('/js/script.js') }}"></script>
    <!-- CDN Script -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <!-- JQuery-->
    <script src="/vendor/jquery/jquery.min.js"></script>
</body>

</html>