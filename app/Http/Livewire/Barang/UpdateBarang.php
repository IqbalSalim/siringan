<?php

namespace App\Http\Livewire\Barang;

use App\Models\Barang;
use Illuminate\Http\Request;
use Livewire\Component;

class UpdateBarang extends Component
{
    public $idBarang, $kategori, $nama, $satuan, $harga, $watt, $jenis, $upah;

    public function mount(Request $request)
    {
        $barang = Barang::find($request->idBarang);
        $this->idBarang = $barang->id;
        $this->nama = $barang->nama;
        $this->watt = $barang->watt;
        $this->jenis = $barang->jenis;
        $this->satuan = $barang->satuan;
        $this->harga = $barang->harga;
        $this->upah = $barang->upah;

        if ($barang->jenis == 'Lampu') {
            $this->kategori = 'Lampu';
            $this->jenis = 'String';
        } else if ($barang->jenis == 'NYMB' || $barang->jenis == 'NYMK' || $barang->jenis == 'NYA') {
            $this->kategori = 'Kabel';
            $this->watt = 0;
            $this->upah = 0;
        } else if ($barang->jenis == 'Saklar') {
            $this->kategori = 'Saklar';
            $this->watt = 0;
            $this->jenis = 'String';
        } else if ($barang->jenis == 'PET') {
            $this->kategori = 'PET';
            $this->watt = 0;
            $this->jenis = 'String';
            $this->upah = 0;
        } else if ($barang->jenis == 'PIP') {
            $this->kategori = 'PIP';
            $this->watt = 0;
            $this->jenis = 'String';
            $this->upah = 0;
        } else if ($barang->jenis == 'SKK' || $barang->jenis == 'SKB') {
            $this->kategori = 'StopKontak';
            $this->watt = 0;
        } else if ($barang->jenis == 'MCB450' || $barang->jenis == 'MCB900' || $barang->jenis == 'MCB1300' || $barang->jenis == 'MCB2200' || $barang->jenis == 'MCB3500' || $barang->jenis == 'MCB5500') {
            $this->kategori = 'MCB';
            $this->watt = 0;
            $this->upah = 0;
        } else {

            $this->kategori = null;
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

    public function render()
    {
        return view('livewire.barang.update-barang');
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
            $this->watt = 'String';
        } else {
            $this->watt = 0;
            $this->jenis = 'String';
            $this->upah = 0;
        }
    }

    public function update()
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


        $barang = Barang::find($this->idBarang);
        if ($this->kategori == 'Lampu') {
            $barang->update([
                'nama' => $this->nama,
                'watt' => $this->watt,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
                'upah' => $this->upah,
                'jenis' => $this->kategori,
            ]);
        } else if ($this->kategori == 'Kabel') {
            $barang->update([
                'nama' => $this->nama,
                'jenis' => $this->jenis,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
            ]);
        } else if ($this->kategori == 'Saklar') {
            $barang->update([
                'nama' => $this->nama,
                'jenis' => $this->kategori,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
                'upah' => $this->upah,
            ]);
        } else if ($this->kategori == 'StopKontak') {
            $barang->update([
                'nama' => $this->nama,
                'jenis' => $this->jenis,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
                'upah' => $this->upah,
            ]);
        } else if ($this->kategori == 'MCB') {
            $barang->update([
                'nama' => $this->nama,
                'jenis' => $this->jenis,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
            ]);
        } else {
            $barang->update([
                'nama' => $this->nama,
                'jenis' => $this->kategori,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
            ]);
        }

        session()->flash('message', 'Barang Berhasil diubah.');
        return redirect()->route('barang');
    }
}
