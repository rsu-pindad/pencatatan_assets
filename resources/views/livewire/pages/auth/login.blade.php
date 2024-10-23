<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;

use function Livewire\Volt\{form, layout, action};

layout('layouts.guest');

form(LoginForm::class);

$login = function () {
    $this->validate();

    $this->form->authenticate();

    Session::regenerate();

    $this->redirectIntended(default: RouteServiceProvider::HOME, navigate: true);
};

$masuk = action(function () {
    $this->redirect('/register', navigate: false);
});

?>

<div>
  <!-- Session Status -->
  <x-auth-session-status class="mb-4"
                         :status="session('status')" />

  <div class="mt-7 rounded-xl border border-gray-200 bg-white shadow-sm dark:border-neutral-700 dark:bg-neutral-900">
    <div class="p-4 sm:p-7">
      <!-- Form -->
      <form wire:submit="login">
        <div class="grid gap-y-4">
          <!-- Email Address -->
          <div>
            <x-input-label for="npp"
                           :value="__('NPP')" />
            <x-text-input id="npp"
                          wire:model="form.npp"
                          class="mt-1 block w-full"
                          type="text"
                          name="npp"
                          required
                          autofocus
                          autocomplete="npp" />
            <x-input-error :messages="$errors->get('form.npp')"
                           class="mt-2" />
          </div>

          <!-- Password -->
          <div class="mt-4">
            <x-input-label for="password"
                           :value="__('Password')" />

            <x-text-input id="password"
                          wire:model="form.password"
                          class="mt-1 block w-full"
                          type="password"
                          name="password"
                          required
                          autocomplete="current-password" />

            <x-input-error :messages="$errors->get('form.password')"
                           class="mt-2" />
          </div>

          @if (Route::has('password.request'))
            <a class="rounded-md text-sm text-gray-600 underline hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:text-gray-400 dark:hover:text-gray-100 dark:focus:ring-offset-gray-800"
               href="{{ route('password.request') }}"
               wire:navigate>
              {{ __('Lupa password?') }}
            </a>
          @endif

          <!-- Checkbox -->
          <div class="flex items-center">
            <div class="flex">
              <input id="remember-me"
                     wire:model="form.remember"
                     name="remember-me"
                     type="checkbox"
                     class="mt-0.5 shrink-0 rounded border-gray-200 text-blue-600 focus:ring-blue-500 dark:border-neutral-700 dark:bg-neutral-800 dark:checked:border-blue-500 dark:checked:bg-blue-500 dark:focus:ring-offset-gray-800">
            </div>
            <div class="ms-3">
              <label for="remember-me"
                     class="text-sm dark:text-white">Ingat saya</label>
            </div>
          </div>
          <!-- End Checkbox -->

          <button type="submit"
                  class="inline-flex w-full items-center justify-center gap-x-2 rounded-lg border border-transparent bg-blue-600 px-4 py-3 text-sm font-medium text-white hover:bg-blue-700 focus:bg-blue-700 focus:outline-none disabled:pointer-events-none disabled:opacity-50">
            Masuk
          </button>
        </div>
      </form>
      <!-- End Form -->
      <div
           class="flex items-center py-3 text-xs uppercase text-gray-400 before:me-6 before:flex-1 before:border-t before:border-gray-200 after:ms-6 after:flex-1 after:border-t after:border-gray-200 dark:text-neutral-500 dark:before:border-neutral-600 dark:after:border-neutral-600">
        Atau
      </div>

      <button wire:click="masuk"
              type="button"
              class="inline-flex w-full items-center justify-center gap-x-2 rounded-lg border border-gray-200 bg-white px-4 py-3 text-sm font-medium text-gray-800 shadow-sm hover:bg-gray-50 focus:bg-gray-50 focus:outline-none disabled:pointer-events-none disabled:opacity-50 dark:border-neutral-700 dark:bg-neutral-900 dark:text-white dark:hover:bg-neutral-800 dark:focus:bg-neutral-800">
        <x-heroicons::solid.arrow-up-right class="size-4 h-auto w-4" />
        Daftar
      </button>

    </div>

  </div>

</div>
