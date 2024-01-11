<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

  <x-partial.head.meta></x-partial.head.meta>

  <title>{{ $title }} - {{ config('app.name') }}</title>

  <x-partial.head.css></x-partial.head.css>
  {{-- <style>
    body {
      background-color: hsla(15, 0%, 100%, 1);
      background-image:
        radial-gradient(at 24% 73%, hsla(206, 17%, 94%, 1) 0px, transparent 50%),
        radial-gradient(at 7% 27%, hsla(228, 69%, 91%, 1) 0px, transparent 50%),
        radial-gradient(at 54% 80%, hsla(201, 100%, 83%, 1) 0px, transparent 50%),
        radial-gradient(at 56% 40%, hsla(240, 100%, 83%, 1) 0px, transparent 50%),
        radial-gradient(at 95% 48%, hsla(231, 100%, 83%, 1) 0px, transparent 50%);

      /* https://csshero.org/mesher/ */
    }
  </style> --}}

</head>

<body class="bg-gray-200 grid place-items-center min-h-screen">

  <!-- Content-->
  {{ $slot }}


  <!-- Additional Script -->
  <script src="{{ asset('js/script.js') }}"></script>

  <!-- CDN Script -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>

</body>

</html>