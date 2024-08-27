<?php
use function Livewire\Volt\{layout, title};

layout('layouts.admin');
title('Master Aset');
?>
<div>
  <div class="grid gap-4 p-2 sm:grid-cols-1 sm:gap-6">
    <button id="collapse-widget"
            type="button"
            class="hs-collapse-toggle inline-flex items-center gap-x-1 rounded-lg border border-transparent p-2 text-sm font-semibold text-blue-600 decoration-2 hover:text-blue-700 hover:underline focus:text-blue-700 focus:underline focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:text-blue-500 dark:hover:text-blue-600 dark:focus:text-blue-600"
            aria-expanded="false"
            aria-controls="collapse-widget-heading"
            data-hs-collapse="#collapse-widget-heading">
      <span class="hs-collapse-open:hidden">widget disembuyikan</span>
      <span class="hidden hs-collapse-open:block">widget ditampilkan</span>
      <x-heroicons::solid.chevron-down class="size-4 mx-3 h-4 w-4 shrink-0 hs-collapse-open:rotate-180" />
    </button>
  </div>
  <!-- Grid -->
  <div id="collapse-widget-heading"
       class="hs-collapse hidden w-full overflow-hidden transition-[height] duration-300"
       aria-labelledby="collapse-widget">
    <div class="ld:grid-cols-5 grid gap-4 p-2 sm:grid-cols-2 sm:gap-6 md:grid-cols-3">
      <!-- Card -->
      <!-- End Card -->
    </div>
  </div>
  <!-- End Grid -->

  <!-- Flex -->
  <div class="flex flex-col gap-4 p-2 sm:gap-6">
    <div class="-m-1.5 overflow-x-auto">
      <div class="inline-block min-w-full p-1.5 align-middle">
        <div
             class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-800">
          <!-- Header Table -->
          <div
               class="grid gap-3 border-b border-gray-200 px-6 py-4 dark:border-neutral-700 md:flex md:items-center md:justify-between">
            <div>
              <h2 class="text-xl font-semibold text-gray-800 dark:text-neutral-200">
                Aset
              </h2>
              <p class="text-sm text-gray-600 dark:text-neutral-400">
                Tabel Aset, edit, hapus dll.
              </p>
            </div>
            <div>
              <div class="inline-flex gap-x-2">
                <x-wireui-button type="button"
                                 label="tambah"
                                 x-on:click="$openModal('createModal')"
                                 right-icon="plus"
                                 primary />
              </div>
            </div>
          </div>
          <!-- End Header Table -->
          <div class="p-4"
               wire:ignore.self>
            <livewire:aset-table lazy
                                 wire:key="{{ uniqid() }}" />
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- End Flex -->

</div>

@once
  @push('breadcrumb')
    <x-preline.breadcrumb>
      <x-slot:content>
        <li class="flex items-center text-sm text-gray-800 dark:text-neutral-400"
            aria-current="page">
          Master
          <x-heroicons::solid.chevron-right
                                            class="size-4 mx-3 h-4 w-4 shrink-0 overflow-visible text-gray-400 dark:text-neutral-500" />
        </li>
        <li class="truncate text-sm font-semibold text-gray-800 dark:text-neutral-400"
            aria-current="page">
          Aset
        </li>
      </x-slot:content>
    </x-preline.breadcrumb>
  @endpush

  @push('customModal')
    <livewire:master-aset.aset-form lazy
                                    wire:key="{{ uniqid() }}" />
    {{-- <livewire:master-kode.kode-update-form lazy /> --}}
  @endpush

  @push('customScript')
    <script type="module" data-navigate-track>
      Livewire.on('infoNotifikasiInsert', async (event) => {
        await Livewire.dispatch('pg:eventRefresh-kode');
        $closeModal('createModal');
        $wireui.notify({
          title: event.title,
          description: event.description,
          icon: event.icon,
        });
      });
      Livewire.on('infoNotifikasi', async (event) => {
        await Livewire.dispatch('pg:eventRefresh-kode');
        $wireui.notify({
          title: event.title,
          description: event.description,
          icon: event.icon,
        });
      });

      Livewire.on('create', (event) => {
        $openModal('createModal');
      });
      Livewire.on('edit', (event) => {
        // console.log(event);
        $openModal('editModal');
      });
      Livewire.on('hapus', async (event) => {
        await Livewire.dispatch('executeHapus', {
          rowId: event
        });
        Livewire.dispatch('pg:eventRefresh-kode');
      });
      Livewire.on('pulihkan', async (event) => {
        await Livewire.dispatch('executePulihkan', {
          rowId: event
        });
        Livewire.dispatch('pg:eventRefresh-kode');
      });
      Livewire.on('closeEditModal', () => {
        $closeModal('editModal');
      });
      Livewire.on('permanenDelete', async (event) => {
        window.$wireui.confirmDialog({
          title: 'Permanent Delete',
          description: 'anda yakin ? data akan dihapus dari database & tidak dapat dikembalikan',
          icon: 'warning',
          accept: {
            label: 'iya',
            execute: () => Livewire.dispatch('executePermanentHapus', {
              rowId: event
            })
          },
          reject: {
            label: 'batal',
          }
        });
      });
    </script>
  @endpush
@endonce
