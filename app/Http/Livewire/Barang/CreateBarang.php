<?php

namespace App\Http\Livewire\Barang;

use App\Models\Barang;
use Livewire\Component;

class CreateBarang extends Component
{
    public $kategori, $nama, $satuan, $harga, $watt, $jenis, $upah;

    public function render()
    {
        return view('livewire.barang.create-barang');
    }

    public function changeEvent($value)
    {
        $this->kategori = $value;
        if ($value == 'Lampu') {
            $this->watt = null;
            $this->upah = null;
            $this->jenis = 'String';
        } else if ($value == 'Kabel' || $value == 'Saklar') {
            $this->jenis = null;
            $this->watt = 'String';
            if ($value == 'Saklar') {
                $this->upah = null;
            } else {
                $this->upah = 9999;
            }
        } else {
            $this->watt = 'String';
            $this->jenis = 'String';
            $this->upah = 9999;
        }
    }

    public function store()
    {
        $this->validate(
            [
                'kategori' => 'required',
                'nama' => 'required|string|max:255',
                'satuan' => 'required|string|max:255',
                'harga' => 'required|numeric',
                'watt' => 'required|string',
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
                'jenis' => $this->jenis,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
                'upah' => $this->upah,
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
    }
}
