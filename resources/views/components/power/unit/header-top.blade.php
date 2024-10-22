<div class="flex flex-row gap-4 mb-4 justify-between">
    <x-wireui-mini-button sm rounded secondary icon="arrow-path" x-on:click="$dispatch('pg:eventRefresh-unit_power_table')" spinner />
    <x-wireui-button rounded primary label="Unduh Template Import" right-icon="arrow-down-tray" spinner />
    <x-wireui-button rounded lime label="Import Unit" x-on:click="$openModal('importModal')" right-icon="arrow-down-tray" spinner />
</div>