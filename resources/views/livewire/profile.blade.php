<?php

use function Livewire\Volt\{state, layout, title};

layout('layouts.admin');
title('Halaman Profil');

?>

<div>
  <div class="grid gap-4 p-2 sm:grid-cols-1 sm:gap-6 md:grid-cols-2">
    <div class="border-2 p-2">
      <livewire:profile.update-profile-information-form lazy />
    </div>
    <div class="border-2 p-2">
      <livewire:profile.update-password-form />
    </div>
  </div>
  <div class="grid gap-4 p-2 sm:grid-cols-1 sm:gap-6 md:grid-cols-1">
    <div class="border-2 p-2">
      <livewire:profile.delete-user-form />
    </div>
  </div>
</div>
