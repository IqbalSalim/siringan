<?php

namespace App\Http\Livewire\Barang;

use App\Models\Barang;
use Livewire\Component;

class CreateBarang extends Component
{
    public $kategori, $nama, $satuan, $harga, $watt, $jenis, $upah = null;

    public function render()
    {
        return view('livewire.barang.create-barang');
    }

    public function changeEvent($value)
    {
        $this->refreshForm();
        $this->resetValidation();
        $this->kategori = $value;
        if ($value == 'Lampu') {
            $this->jenis = 'String';
        } else if ($value == 'Kabel' || $value == 'MCB') {
            $this->watt = 0;
            $this->upah = 0;
        } else if ($value == 'Saklar') {
            $this->jenis = 'String';
            $this->watt = 0;
        } else if ($value == 'StopKontak') {
            $this->watt = 0;
        } else {
            $this->watt = 0;
            $this->jenis = 'String';
            $this->upah = 0;
        }
    }

    public function refreshForm()
    {
        $this->nama = null;
        $this->watt = null;
        $this->satuan = null;
        $this->jenis = null;
        $this->harga = null;
        $this->upah = null;
    }

    public function store()
    {
        $this->validate(
            [
                'kategori' => 'required',
                'nama' => 'required|string|max:255',
                'satuan' => 'required|string|max:255',
                'harga' => 'required|numeric',
                'watt' => 'required|numeric',
                'jenis' => 'required|string',
                'upah' => 'required|numeric',

            ]
        );
        if ($this->kategori == 'Lampu') {
            Barang::create([
                'nama' => $this->nama,
                'watt' => $this->watt,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
                'upah' => $this->upah,
                'jenis' => $this->kategori,
            ]);
        } else if ($this->kategori == 'Kabel') {
            Barang::create([
                'nama' => $this->nama,
                'jenis' => $this->jenis,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
            ]);
        } else if ($this->kategori == 'Saklar') {
            Barang::create([
                'nama' => $this->nama,
                'jenis' => $this->kategori,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
                'upah' => $this->upah,
            ]);
        } else if ($this->kategori == 'StopKontak') {
            Barang::create([
                'nama' => $this->nama,
                'jenis' => $this->jenis,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
                'upah' => $this->upah,
            ]);
        } else if ($this->kategori == 'MCB') {
            Barang::create([
                'nama' => $this->nama,
                'jenis' => $this->jenis,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
            ]);
        } else {
            Barang::create([
                'nama' => $this->nama,
                'jenis' => $this->kategori,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
            ]);
        }

        session()->flash('message', 'Barang Berhasil ditambahkan.');
        return redirect()->route('barang');
        dd('oke');
    }
}
