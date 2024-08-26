<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: true);
};

$profile = function () {
    $this->redirect('/profile', navigate: true);
};

?>

  <div class="ms-auto flex w-full items-center justify-end gap-x-1 md:justify-between md:gap-x-3">

    <div class="hidden md:block">
      <!-- Search Input -->
      <div class="relative">
        <div class="pointer-events-none absolute inset-y-0 start-0 z-20 flex items-center ps-3.5">
          <svg class="size-4 shrink-0 text-gray-400 dark:text-white/60"
               xmlns="http://www.w3.org/2000/svg"
               width="24"
               height="24"
               viewBox="0 0 24 24"
               fill="none"
               stroke="currentColor"
               stroke-width="2"
               stroke-linecap="round"
               stroke-linejoin="round">
            <circle cx="11"
                    cy="11"
                    r="8" />
            <path d="m21 21-4.3-4.3" />
          </svg>
        </div>
        <input type="text"
               class="block w-full rounded-lg border-gray-200 bg-white py-2 pe-16 ps-10 text-sm focus:border-blue-500 focus:outline-none focus:ring-blue-500 disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-800 dark:text-neutral-400 dark:placeholder:text-neutral-400 dark:focus:ring-neutral-600"
               placeholder="Search">
        <div class="pointer-events-none absolute inset-y-0 end-0 z-20 flex hidden items-center pe-1">
          <button type="button"
                  class="size-6 inline-flex shrink-0 items-center justify-center rounded-full text-gray-500 hover:text-blue-600 focus:text-blue-600 focus:outline-none dark:text-neutral-500 dark:hover:text-blue-500 dark:focus:text-blue-500"
                  aria-label="Close">
            <span class="sr-only">Close</span>
            <svg class="size-4 shrink-0"
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
              <path d="m15 9-6 6" />
              <path d="m9 9 6 6" />
            </svg>
          </button>
        </div>
        <div class="pointer-events-none absolute inset-y-0 end-0 z-20 flex items-center pe-3 text-gray-400">
          <svg class="size-3 shrink-0 text-gray-400 dark:text-white/60"
               xmlns="http://www.w3.org/2000/svg"
               width="24"
               height="24"
               viewBox="0 0 24 24"
               fill="none"
               stroke="currentColor"
               stroke-width="2"
               stroke-linecap="round"
               stroke-linejoin="round">
            <path d="M15 6v12a3 3 0 1 0 3-3H6a3 3 0 1 0 3 3V6a3 3 0 1 0-3 3h12a3 3 0 1 0-3-3" />
          </svg>
          <span class="mx-1">
            <svg class="size-3 shrink-0 text-gray-400 dark:text-white/60"
                 xmlns="http://www.w3.org/2000/svg"
                 width="24"
                 height="24"
                 viewBox="0 0 24 24"
                 fill="none"
                 stroke="currentColor"
                 stroke-width="2"
                 stroke-linecap="round"
                 stroke-linejoin="round">
              <path d="M5 12h14" />
              <path d="M12 5v14" />
            </svg>
          </span>
          <span class="text-xs">/</span>
        </div>
      </div>
      <!-- End Search Input -->
    </div>

    <div class="flex flex-row items-center justify-end gap-1">
      <button type="button"
              class="size-[38px] relative inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700 md:hidden">
        <svg class="size-4 shrink-0"
             xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round">
          <circle cx="11"
                  cy="11"
                  r="8" />
          <path d="m21 21-4.3-4.3" />
        </svg>
        <span class="sr-only">Search</span>
      </button>

      <button type="button"
              class="size-[38px] relative inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
        <svg class="size-4 shrink-0"
             xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M6 8a6 6 0 0 1 12 0c0 7 3 9 3 9H3s3-2 3-9" />
          <path d="M10.3 21a1.94 1.94 0 0 0 3.4 0" />
        </svg>
        <span class="sr-only">Notifications</span>
      </button>

      <button type="button"
              class="size-[38px] relative inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white dark:hover:bg-neutral-700 dark:focus:bg-neutral-700">
        <svg class="size-4 shrink-0"
             xmlns="http://www.w3.org/2000/svg"
             width="24"
             height="24"
             viewBox="0 0 24 24"
             fill="none"
             stroke="currentColor"
             stroke-width="2"
             stroke-linecap="round"
             stroke-linejoin="round">
          <path d="M22 12h-4l-3 9L9 3l-3 9H2" />
        </svg>
        <span class="sr-only">Activity</span>
      </button>

      <!-- Dropdown -->
      <div class="hs-dropdown relative inline-flex [--placement:bottom-right]">
        <button id="hs-dropdown-account"
                type="button"
                class="size-[38px] inline-flex items-center justify-center gap-x-2 rounded-full border border-transparent text-sm font-semibold text-gray-800 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-white"
                aria-haspopup="menu"
                aria-expanded="false"
                aria-label="Dropdown">
          <img class="size-[38px] shrink-0 rounded-full"
               src="https://images.unsplash.com/photo-1568602471122-7832951cc4c5?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=320&h=320&q=80"
               alt="Avatar">
        </button>

        <div class="hs-dropdown-menu duration min-w-60 mt-2 hidden rounded-lg bg-white opacity-0 shadow-md transition-[opacity,margin] before:absolute before:-top-4 before:start-0 before:h-4 before:w-full after:absolute after:-bottom-4 after:start-0 after:h-4 after:w-full hs-dropdown-open:opacity-100 dark:divide-neutral-700 dark:border dark:border-neutral-700 dark:bg-neutral-800"
             role="menu"
             aria-orientation="vertical"
             aria-labelledby="hs-dropdown-account">
          <div class="rounded-t-lg bg-gray-100 px-5 py-3 dark:bg-neutral-700">
            <p class="text-sm text-gray-500 dark:text-neutral-500">Masuk Sebagai</p>
            <p class="text-sm font-medium text-gray-800 dark:text-neutral-200">james@site.com</p>
          </div>
          <div class="space-y-0.5 p-1.5">
            <a wire:click="profile"
               class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
               href="#">
              <x-heroicons::solid.user class="size-4 h-5 w-5 shrink-0" />
              Profile
            </a>
            <a wire:click="logout"
               class="flex items-center gap-x-3.5 rounded-lg px-3 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:text-neutral-400 dark:hover:bg-neutral-700 dark:hover:text-neutral-300 dark:focus:bg-neutral-700 dark:focus:text-neutral-300"
               href="#">
              <x-heroicons::solid.arrow-left-end-on-rectangle class="size-4 h-5 w-5 shrink-0" />
              Keluar
            </a>
          </div>
        </div>
      </div>
      <!-- End Dropdown -->
    </div>
  </div>
