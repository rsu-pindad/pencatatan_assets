<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

  <head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect"
          href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap"
          rel="stylesheet" />

    <wireui:scripts />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="font-sans text-gray-900 antialiased">
    <div class="flex min-h-screen flex-col items-center bg-gray-100 pt-6 dark:bg-gray-900 sm:justify-center sm:pt-0">
      <div>
        <a href="/"
           wire:navigate>
          <x-heroicons::solid.building-library class="h-20 w-20 fill-current text-gray-500" />
        </a>
      </div>

      {{ $slot }}
    </div>
    <script type="module">
      document.addEventListener("livewire:navigated", () => {
        window.HSStaticMethods.autoInit();
      });
    </script>
  </body>

</html>
