<div class="flex flex-row gap-4 mb-4 justify-between">
    <div class="order-first">
        <x-wireui-mini-button sm rounded secondary icon="arrow-path" x-on:click="$dispatch('pg:eventRefresh-vendor_power_table')" spinner />
    </div>
    <div>
    </div>
    <div class="order-last gap-2">
        <x-wireui-button rounded orange label="Unduh Template Import" right-icon="arrow-down-tray" x-on:click="$dispatch('downloadImport')" spinner />
        <x-wireui-button rounded lime label="Import Vendor" x-on:click="$openModal('importModal')" right-icon="arrow-down-tray" spinner />
    </div>
</div>