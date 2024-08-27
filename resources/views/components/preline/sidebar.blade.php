<nav class="hs-accordion-group flex w-full flex-col flex-wrap p-3"
     data-hs-accordion-always-open>
  <ul class="flex flex-col space-y-1">
    <li>
      <a class="@if (request()->routeIs('beranda')) underline decoration-blue-500 @endif flex items-center gap-x-3.5 rounded-lg bg-gray-100 px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-700 dark:text-white"
         href="{{ route('beranda') }}">
        <x-heroicons::solid.home class="size-4 h-5 w-5 shrink-0" />
        Beranda
      </a>
    </li>
    <li>
      <a class="@if (request()->routeIs('aset')) underline decoration-blue-500 @endif flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-900 dark:hover:text-neutral-300"
         href="{{ route('aset') }}">
        <x-heroicons::solid.inbox class="size-4 h-5 w-5 shrink-0" />
        Aset
      </a>
    </li>
    <li id="master-data-accordion"
        class="hs-accordion @if (request()->routeIs(['kode', 'satuan', 'vendor', 'tipe-merek', 'tipe', 'merek', 'unit'])) active @endif">
      <button class="hs-accordion-toggle flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700"
              type="button"
              aria-expanded="true"
              aria-controls="master-data-accordion-child">
        <x-heroicons::solid.circle-stack class="size-4 mt-0.5 h-5 w-5 shrink-0" />
        Master Data

        <x-heroicons::solid.chevron-up class="size-4 ms-auto hidden h-4 w-4 hs-accordion-active:block" />
        <x-heroicons::solid.chevron-down class="size-4 ms-auto block h-4 w-4 hs-accordion-active:hidden" />
      </button>

      <div id="master-data-accordion-child"
           class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
           role="region"
           aria-labelledby="master-data-accordion"
           style="@if (request()->routeIs(['kode', 'satuan', 'vendor', 'tipe-merek', 'tipe', 'merek', 'unit'])) display:block; @endif">
        <ul class="hs-accordion-group space-y-1 ps-8 pt-1"
            data-hs-accordion-always-open>
          <li>
            <a class="@if (request()->routeIs('kode')) underline decoration-blue-500 @endif flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200"
               href="{{ route('kode') }}">
              Kode
            </a>
          </li>
          <li>
            <a class="@if (request()->routeIs('satuan')) underline decoration-blue-500 @endif flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200"
               href="{{ route('satuan') }}">
              Satuan
            </a>
          </li>
          <li>
            <a class="@if (request()->routeIs('vendor')) underline decoration-blue-500 @endif flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200"
               href="{{ route('vendor') }}">
              Vendor
            </a>
          </li>
          <li id="master-data-accordion-sub-1"
              class="hs-accordion @if (request()->routeIs(['tipe-merek', 'tipe', 'merek'])) active @endif">
            <button class="hs-accordion-toggle flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-start text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200 dark:hover:bg-neutral-700"
                    type="button"
                    aria-expanded="true"
                    aria-controls="master-data-accordion-sub-1-child">
              Tipe - Merek

              <svg class="size-4 ms-auto hidden hs-accordion-active:block"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="m18 15-6-6-6 6" />
              </svg>

              <svg class="size-4 ms-auto block hs-accordion-active:hidden"
                   xmlns="http://www.w3.org/2000/svg"
                   width="24"
                   height="24"
                   viewBox="0 0 24 24"
                   fill="none"
                   stroke="currentColor"
                   stroke-width="2"
                   stroke-linecap="round"
                   stroke-linejoin="round">
                <path d="m6 9 6 6 6-6" />
              </svg>
            </button>

            <div id="master-data-accordion-sub-1-child"
                 class="hs-accordion-content hidden w-full overflow-hidden transition-[height] duration-300"
                 role="region"
                 aria-labelledby="users-accordion-sub-1"
                 style="@if (request()->routeIs(['tipe-merek', 'tipe', 'merek'])) display:block; @endif">
              <ul class="space-y-1 pt-1">
                <li>
                  <a class="@if (request()->routeIs('tipe-merek')) underline decoration-blue-500 @endif flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200"
                     href="{{ route('tipe-merek') }}">
                    Master Tipe - Merek
                  </a>
                </li>
                <li>
                  <a class="@if (request()->routeIs('merek')) underline decoration-blue-500 @endif flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200"
                     href="{{ route('merek') }}">
                    Merek
                  </a>
                </li>
                <li>
                  <a class="@if (request()->routeIs('tipe')) underline decoration-blue-500 @endif flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200"
                     href="{{ route('tipe') }}">
                    Tipe
                  </a>
                </li>
              </ul>
            </div>
          </li>
          <li>
            <a class="@if (request()->routeIs('unit')) underline decoration-blue-500 @endif flex items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 focus:bg-gray-100 focus:outline-none dark:bg-neutral-800 dark:text-neutral-200"
               href="{{ route('unit') }}">
              Unit
            </a>
          </li>
        </ul>
      </div>
    </li>

    <li>
      <a class="flex w-full items-center gap-x-3.5 rounded-lg px-2.5 py-2 text-sm text-gray-800 hover:bg-gray-100 dark:text-neutral-200 dark:hover:bg-neutral-900 dark:hover:text-neutral-300"
         href="#">
        <x-heroicons::solid.book-open class="size-4 h-5 w-5 shrink-0" />
        Dokumentasi
      </a>
    </li>
  </ul>
</nav>
