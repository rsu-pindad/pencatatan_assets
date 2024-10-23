<div wire:loading.flex
     class="absolute inset-0 z-[90] h-full w-full items-center justify-center bg-white bg-opacity-70 dark:bg-neutral-800">
  <svg class="h-10 w-10 animate-spin text-green-600"
       fill="none"
       viewBox="0 0 24 24">
    <circle class="opacity-25"
            cx="12"
            cy="12"
            r="10"
            stroke="currentColor"
            stroke-width="4"></circle>
    <path class="opacity-75"
          fill="currentColor"
          d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
    </path>
  </svg>
</div>
<div class="animate-pulse space-y-4 p-2">
  {{-- # Column --}}
  <div class="flex items-center gap-4">
    @for ($i = 0; $i < 10; $i++)
      {{-- # Row --}}
      <div>
        <div class="mb-2.5 h-2.5 w-40 rounded-full bg-gray-300 dark:bg-neutral-500"></div>
        <div class="mb-2.5 h-2.5 w-48 rounded-full bg-gray-300 dark:bg-neutral-500"></div>
      </div>
    @endfor
  </div>
  {{-- # Column --}}
  <div class="flex items-center gap-4">
    @for ($i = 0; $i < 10; $i++)
      {{-- # Row --}}
      <div>
        <div class="mb-2.5 h-2.5 w-40 rounded-full bg-gray-300 dark:bg-neutral-500"></div>
        <div class="mb-2.5 h-2.5 w-48 rounded-full bg-gray-300 dark:bg-neutral-500"></div>
      </div>
    @endfor
  </div>
  {{-- # Column --}}
  <div class="flex items-center gap-4">
    @for ($i = 0; $i < 10; $i++)
      {{-- # Row --}}
      <div>
        <div class="mb-2.5 h-2.5 w-40 rounded-full bg-gray-300 dark:bg-neutral-500"></div>
        <div class="mb-2.5 h-2.5 w-48 rounded-full bg-gray-300 dark:bg-neutral-500"></div>
      </div>
    @endfor
  </div>
</div>
