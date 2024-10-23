<div class="mb-4 flex flex-row justify-between gap-4">
  <div class="order-first">
    <x-wireui-mini-button sm
                          rounded
                          secondary
                          icon="arrow-path"
                          x-on:click="$dispatch('pg:eventRefresh-satuan_power_table')"
                          spinner />
  </div>
  <div>
  </div>
  <div class="order-last gap-2">
    <x-wireui-button rounded
                     orange
                     label="Unduh Template Import"
                     right-icon="arrow-down-tray"
                     x-on:click="$dispatch('downloadImport')"
                     spinner />
    <x-wireui-button rounded
                     lime
                     label="Import Satuan"
                     x-on:click="$openModal('importModal')"
                     right-icon="arrow-down-tray"
                     spinner />
  </div>
</div>
