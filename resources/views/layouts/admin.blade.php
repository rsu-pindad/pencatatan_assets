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

    <!-- Theme Check and Update -->
    <script>
      const html = document.querySelector('html');
      const isLightOrAuto = localStorage.getItem('hs_theme') === 'light' || (localStorage.getItem('hs_theme') ===
        'auto' && !window.matchMedia('(prefers-color-scheme: dark)').matches);
      const isDarkOrAuto = localStorage.getItem('hs_theme') === 'dark' || (localStorage.getItem('hs_theme') === 'auto' &&
        window.matchMedia('(prefers-color-scheme: dark)').matches);

      if (isLightOrAuto && html.classList.contains('dark')) html.classList.remove('dark');
      else if (isDarkOrAuto && html.classList.contains('light')) html.classList.remove('light');
      else if (isDarkOrAuto && !html.classList.contains('dark')) html.classList.add('dark');
      else if (isLightOrAuto && !html.classList.contains('light')) html.classList.add('light');
    </script>
    <!-- Scripts -->
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>

  <body class="bg-gray-50 font-sans antialiased dark:bg-neutral-900">
    <!-- ========== HEADER ========== -->
    <header
            class="sticky inset-x-0 top-0 z-[48] flex w-full flex-wrap border-b bg-white py-2.5 text-sm dark:border-neutral-700 dark:bg-neutral-800 md:flex-nowrap md:justify-start lg:ps-[260px]">
      <x-preline.navbar />
    </header>
    <!-- ========== END HEADER ========== -->

    <!-- ========== MAIN CONTENT ========== -->
    <div class="-mt-px">
      <!-- Breadcrumb -->
      <div
           class="sticky inset-x-0 top-0 z-20 border-y bg-white px-4 dark:border-neutral-700 dark:bg-neutral-800 sm:px-6 lg:hidden lg:px-8">
        @stack('breadcrumb')
      </div>
      <!-- End Breadcrumb -->
    </div>
    <!-- Sidebar -->
    <div id="hs-application-sidebar"
         class="hs-overlay fixed inset-y-0 start-0 z-[60] hidden h-full w-[260px] -translate-x-full transform border-e border-gray-200 bg-white transition-all duration-300 [--auto-close:lg] hs-overlay-open:translate-x-0 dark:border-neutral-700 dark:bg-neutral-800 lg:bottom-0 lg:end-auto lg:block lg:translate-x-0"
         role="dialog"
         tabindex="-1"
         aria-label="Sidebar">
      <div class="relative flex h-full max-h-full flex-col">
        <div class="px-6 pt-4">
          <!-- Logo -->
          <a class="inline-block flex-none rounded-xl text-xl font-semibold focus:opacity-80 focus:outline-none"
             href="#"
             aria-label="Preline">
             <span class="inline-flex items-center gap-x-2 text-xl font-semibold text-green-500 hover:text-green-700 dark:text-white dark:hover:text-gray-400 uppercase">
               <x-heroicons::solid.presentation-chart-line class="h-auto w-auto fill-green-500 hover:fill-green-700" />
               Inventaris
             </span>
          </a>
          <!-- End Logo -->
        </div>

        <!-- Content -->
        <div
             class="h-full overflow-y-auto [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-300 dark:[&::-webkit-scrollbar-thumb]:bg-neutral-500 [&::-webkit-scrollbar-track]:bg-gray-100 dark:[&::-webkit-scrollbar-track]:bg-neutral-700 [&::-webkit-scrollbar]:w-2">
          <x-preline.sidebar />
        </div>
        <!-- End Content -->
      </div>
    </div>
    <!-- End Sidebar -->

    <!-- Content -->
    <div class="w-full lg:ps-64">
      <div class="space-y-4 p-4 sm:space-y-6 sm:p-6">
        {{ $slot }}
      </div>
    </div>
    <!-- End Content -->
    <!-- ========== END MAIN CONTENT ========== -->
    <x-wireui-dialog position="center" />
    <x-wireui-notifications position="top-end" />
    <script type="module">
      document.addEventListener("livewire:navigated", () => {
        window.HSStaticMethods.autoInit();
      });
      Wireui.hook('load', () => console.log('wireui ok'));
    </script>
    @stack('customModal')
    @stack('customScript')
  </body>

</html>
