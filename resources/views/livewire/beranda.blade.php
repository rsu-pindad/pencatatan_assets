<?php

use function Livewire\Volt\{state,layout,title};
layout('layouts.admin');
title('Beranda')
?>

<div>
    <div class="ld:grid-cols-5 grid gap-4 p-2 sm:grid-cols-2 sm:gap-6 md:grid-cols-3">
        <!-- Card -->
        {{-- <livewire:master-aset.aset-widget wire:key="{{ uniqid() }}" /> --}}
        <livewire:master-kode.kode-widget wire:key="{{ uniqid() }}" />
        <!-- End Card -->
      </div>
</div>
