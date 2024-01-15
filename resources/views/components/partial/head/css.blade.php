    <!-- Main Style-->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <!-- Tailwindcss-->
    @vite('resources/css/app.css')
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Custom Font -->
    {{-- <link href="https://fonts.cdnfonts.com/css/alliance-no1" rel="stylesheet"> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="preload" href="{{ asset('css/Mona-Sans.woff2') }}" as="font" type="font/woff2" crossorigin>

    <!-- Inline  CSS -->
    @stack('style')
