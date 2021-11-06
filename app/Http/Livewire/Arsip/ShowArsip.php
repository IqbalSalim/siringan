<?php

namespace App\Http\Livewire\Arsip;

use App\Models\Barang;
use App\Models\Ruangan;
use Livewire\Component;

class ShowArsip extends Component
{

    public $rabs = [];
    public $total = 0, $upah = 0;


    public function render()
    {

        $id_ruangan =  session('id_ruangan');

        $result = Ruangan::find($id_ruangan);
        $data = json_decode($result->data);

        for ($i = 0; $i < count($data); $i++) {

            $ruangan = $data[$i]->ruangan;
            $panjang = $data[$i]->panjang;
            $lebar = $data[$i]->lebar;
            $tinggi = $data[$i]->tinggi;
            $barang_watt = [];

            // Menghitung Lampu
            $titikMataLampu = (($panjang * $lebar) <= 9) ? 1 : 2;
            $array = [$panjang, $lebar, $tinggi];
            $luxruangan = 150;

            $flux = (array_product($array) * 0.35 * $luxruangan) / $titikMataLampu;
            // Item Lampu
            $watt = floor($flux / 70);
            $barangs = Barang::all();


            foreach ($barangs as $barang) {
                $barang_watt[$barang->watt] = [abs($barang->watt - $watt), $barang->id];
            }
            asort($barang_watt);

            $itemWatt = reset($barang_watt);
            $id_barang = $itemWatt[1];

            $item[$id_barang] = array(
                'jumlah' => (isset($item[$id_barang])) ? $item[$id_barang]['jumlah'] + $titikMataLampu : $titikMataLampu,
            );
            // End Lampu

            // Kabel
            $kabelAtasKeLampu = ($panjang >= $lebar) ? $panjang / 2 : $lebar / 2;
            if ($titikMataLampu === 2) {
                $kabelAtasKeLampu = $kabelAtasKeLampu * 1.5;
            }
            $kabelSaklarKeAtas = ($tinggi - 1.25) * ($ruangan === 'Teras' || $ruangan === "Kamar Mandi") ? 2 : 4;
            $jumlahKabel = ($ruangan === 'Teras' || $ruangan === "Kamar Mandi") ? $kabelAtasKeLampu * 2 : $kabelAtasKeLampu;
            $barang = Barang::where('jenis', 'NYM')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + $jumlahKabel : $jumlahKabel,
            );
            $barang = Barang::where('jenis', 'NYA')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + $kabelSaklarKeAtas : $kabelSaklarKeAtas,
            );
            // End Kabel

            // Saklar
            $barang = ($ruangan === 'Teras' || $ruangan === "Kamar Mandi") ? Barang::where('jenis', 'S1')->get() : Barang::where('jenis', 'S1SK1')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + 1 : 1,
            );
            // End Saklar

            // Peteng
            $barang = Barang::where('jenis', 'PET')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + $titikMataLampu : $titikMataLampu,
            );
            // End Peteng

            // Pipa
            $barang = Barang::where('jenis', 'PIP')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + $tinggi - 1.25 : $tinggi - 1.25,
            );
        }

        // EndPipa


        $barangs = Barang::all();
        foreach ($barangs as $k =>  $barang) {
            foreach ($item as $key => $value) {
                if ($key === $barang->id) {
                    $this->rabs[$k]['nama'] = $barang->nama;
                    $this->rabs[$k]['satuan'] = $barang->satuan;
                    $this->rabs[$k]['harga'] = $barang->harga;
                    $this->rabs[$k]['jumlah'] = $value['jumlah'];
                    $this->rabs[$k]['subTotal'] = $barang->harga * $value['jumlah'];
                    $this->total = $this->total + $this->rabs[$k]['subTotal'];
                    $this->upah = $this->upah + $barang->upah;
                }
            }
        }

        return view('livewire.arsip.show-arsip');
    }
}