<?php

use App\Livewire\Actions\Logout;

$logout = function (Logout $logout) {
    $logout();

    $this->redirect('/', navigate: false);
};

$profile = function () {
    $this->redirect('/profile', navigate: false);
};

?>
<nav class="mx-auto flex w-full basis-full items-center px-4 sm:px-6">
  <div class="me-5 lg:me-0 lg:hidden">
    <!-- Logo -->
    <a class="inline-block flex-none rounded-md text-xl font-semibold focus:opacity-80 focus:outline-none"
       href="#"
       aria-label="Preline">
      <span
            class="inline-flex items-center gap-x-2 text-xl font-semibold uppercase text-green-500 hover:text-green-700 dark:text-white dark:hover:text-gray-400">
        <x-heroicons::solid.presentation-chart-line class="h-auto w-auto fill-green-500 hover:fill-green-700" />
        Inventaris
      </span>
    </a>
    <!-- End Logo -->
  </div>
  <div class="ms-auto flex w-full items-center justify-end gap-x-1 md:justify-between md:gap-x-3">

    <div class="hidden md:block">
    </div>

    <div class="flex flex-row items-center justify-end gap-1">

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
            <p class="text-sm font-medium text-gray-800 dark:text-neutral-200">{{Auth::user()->npp}}</p>
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
</nav>
