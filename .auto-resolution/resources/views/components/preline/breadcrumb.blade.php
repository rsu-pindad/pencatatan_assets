@props([
    'content' => '',
])
<div class="flex items-center py-2">
  <!-- Navigation Toggle -->
  <button type="button"
          class="size-8 flex items-center justify-center gap-x-2 rounded-lg border border-gray-200 text-gray-800 hover:text-gray-500 focus:text-gray-500 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:text-neutral-200 dark:hover:text-neutral-500 dark:focus:text-neutral-500"
          aria-haspopup="dialog"
          aria-expanded="false"
          aria-controls="hs-application-sidebar"
          aria-label="Toggle navigation"
          data-hs-overlay="#hs-application-sidebar">
    <span class="sr-only">Toggle Navigation</span>
    <x-heroicons::solid.bars-3 class="size-4 h-5 w-5 shrink-0" />
  </button>
  <!-- End Navigation Toggle -->

  <!-- Breadcrumb -->
  <ol class="ms-3 flex items-center whitespace-nowrap">
    <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400">
      Invetaris Aset
      <x-heroicons::solid.chevron-right
                                        class="size-4 mx-3 h-4 w-4 shrink-0 overflow-visible text-gray-400 dark:text-neutral-500" />
    </li>
    @if ($content)
      {{ $content }}
    @else
      <li class="truncate text-sm font-semibold text-gray-800 dark:text-neutral-400"
          aria-current="page">
        Beranda
      </li>
    @endif
  </ol>
  <!-- End Breadcrumb -->
</div>
