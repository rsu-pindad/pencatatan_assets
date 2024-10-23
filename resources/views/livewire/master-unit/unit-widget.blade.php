<?php

use App\Models\Unit;
use function Livewire\Volt\{state, computed};

$count = computed(function () {
    return Unit::count();
});

?>

<div class="flex flex-col rounded-xl border bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
  <div class="p-4 md:p-5">
    <div class="flex items-center gap-x-2">
      <p class="text-xs uppercase tracking-wide text-gray-500 dark:text-neutral-500">
        Total Unit
      </p>
      <div class="hs-tooltip">
        <div class="hs-tooltip-toggle">
          <svg class="size-4 shrink-0 text-gray-500 dark:text-neutral-500"
               xmlns="http://www.w3.org/2000/svg"
               width="24"
               height="24"
               viewBox="0 0 24 24"
               fill="none"
               stroke="currentColor"
               stroke-width="2"
               stroke-linecap="round"
               stroke-linejoin="round">
            <circle cx="12"
                    cy="12"
                    r="10" />
            <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3" />
            <path d="M12 17h.01" />
          </svg>
          <span class="hs-tooltip-content invisible absolute z-10 inline-block rounded bg-gray-900 px-2 py-1 text-xs font-medium text-white opacity-0 shadow-sm transition-opacity hs-tooltip-shown:visible hs-tooltip-shown:opacity-100 dark:bg-neutral-700"
                role="tooltip">
            Total Data Unit
          </span>
        </div>
      </div>
    </div>

    <div class="mt-1 flex items-center gap-x-2">
      <h3 class="text-xl font-medium text-gray-800 dark:text-neutral-200 sm:text-2xl">
        {{ $this->count }}
      </h3>
      <span class="flex items-center gap-x-1 text-green-600">
        <svg class="size-4 inline-block self-center"
             xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round">
          <polyline points="22 7 13.5 15.5 8.5 10.5 2 17" />
          <polyline points="16 7 22 7 22 13" />
        </svg>
        <span class="inline-block text-sm">
          1.7%
        </span>
      </span>
      <x-wireui-mini-button rounded
                            secondary
                            icon="arrow-path"
                            wire:click="$refresh"
                            spinner />
    </div>
  </div>
</div>
