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

        if ($barang->watt !== null) {
            $this->kategori = 'Lampu';
            $this->jenis = 'String';
        } else if ($barang->jenis == 'NYM' || $barang->jenis == 'NYA') {
            $this->kategori = 'Kabel';
            $this->watt = 'String';
            $this->upah = 9999;
        } else if ($barang->jenis == 'S1SK1' || $barang->jenis == 'S1') {
            $this->kategori = 'Saklar';
            $this->watt = 'String';
        } else if ($barang->jenis == 'PET') {
            $this->kategori = 'PET';
            $this->watt = 'String';
            $this->jenis = 'String';
            $this->upah = 9999;
        } else if ($barang->jenis == 'PIP') {
            $this->kategori = 'PIP';
            $this->watt = 'String';
            $this->jenis = 'String';
            $this->upah = 9999;
        } else {
            $this->kategori = null;
        }
    }

    public function render()
    {
        return view('livewire.barang.update-barang');
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

    public function update()
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

        $barang = Barang::find($this->idBarang);
        if ($this->kategori == 'Lampu') {
            $barang->update([
                'nama' => $this->nama,
                'watt' => $this->watt,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
                'upah' => $this->upah,
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
                'jenis' => $this->jenis,
                'satuan' => $this->satuan,
                'harga' => $this->harga,
                'upah' => $this->upah,
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
