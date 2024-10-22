<?php

namespace App\Livewire\Forms\Vendor;

use App\Models\Vendor;
use Livewire\Attributes\Validate;
use Livewire\Form;

class VendorForm extends Form
{
    #[Validate('required', message: 'mohon isi prefix')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    #[Validate('unique:vendor', message: 'prefix vendor sudah ada')]
    public $prefix_vendor = '';

    #[Validate('required', message: 'mohon isi nama')]
    #[Validate('min:2', message: 'minimal 2 huruf')]
    public $nama = '';

    public $keterangan = '';

    public function store()
    {
        $this->validate();
        try {
            Vendor::create([
                'prefix_vendor'     => $this->prefix_vendor,
                'nama_vendor'       => $this->nama,
                'keterangan_vendor' => $this->keterangan,
            ]);
            $this->reset();

            return true;
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }
}
