<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use App\Models\Ruangan;
use Livewire\Component;

class ShowRab extends Component
{
    public $rabs = [], $tabelUpah = [];
    public $totalHargaBarang = 0, $totalUpah = 0, $idRab;

    public function render()
    {
        $user = auth()->user();
        $result = Ruangan::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(1)->get();
        $this->idRab = $result[0]->id;
        $data = json_decode($result[0]->data);

        foreach ($data as $row) {

            $ruangan = $row->ruangan;
            $panjang = $row->panjang;
            $lebar = $row->lebar;
            $tinggi = $row->tinggi;
            $lux = $row->lux;
            $barang_watt = [];

            // Menghitung Lampu
            $titikMataLampu = (($panjang * $lebar) <= 9) ? 1 : 2;
            $array = [$panjang, $lebar];

            $flux = (array_product($array) * 0.35 * $lux) / $titikMataLampu;
            // Item Lampu
            $watt = floor($flux / 70);

            $barangs = Barang::all();
            $watts = Barang::where('watt', '!=', null)->orderBy('watt')->get();

            for ($i = 0; $i < count($watts); $i++) {
                if ($watt > $watts[$i]->watt and isset($watts[$i + 1])) {
                    $id_barang = $watts[$i + 1]->id;
                }
            }
            if ($watt <= $watts[0]->watt) {
                $id_barang = $watts[0]->id;
            }




            $item[$id_barang] = array(
                'jumlah' => (isset($item[$id_barang])) ? $item[$id_barang]['jumlah'] + $titikMataLampu : $titikMataLampu,
            );
            // dd($item[$id_barang]);
            // End Lampu

            // Kabel
            $kabelAtasKeLampu =  ($panjang >= $lebar) ? $panjang / 2 : $lebar / 2;
            if ($titikMataLampu === 2) {
                $kabelAtasKeLampu = $kabelAtasKeLampu * 1.5;
            }

            $kabelSaklarKeAtas = ($tinggi - 1.25) * (($ruangan === 'Teras' || $ruangan === "Kamar Mandi") ? 2 : 4);
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


        $wattsbarangs = Barang::all();
        foreach ($barangs as $k =>  $barang) {
            foreach ($item as $key => $value) {
                if ($key === $barang->id) {
                    $this->rabs[$k]['nama'] = $barang->nama;
                    $this->rabs[$k]['satuan'] = $barang->satuan;
                    $this->rabs[$k]['harga'] = $barang->harga;
                    $this->rabs[$k]['watt'] = $barang->watt;
                    $this->rabs[$k]['jumlah'] = $value['jumlah'];
                    $this->rabs[$k]['subTotal'] = $barang->harga * $value['jumlah'];
                    if ($barang->upah !== null) {
                        $this->tabelUpah[$k]['nama'] = $barang->nama;
                        $this->tabelUpah[$k]['watt'] = $barang->watt;
                        $this->tabelUpah[$k]['jumlah'] = $value['jumlah'];
                        $this->tabelUpah[$k]['upah'] = $barang->upah;
                        $this->tabelUpah[$k]['subTotal'] = $barang->upah * $value['jumlah'];
                        $this->totalUpah = $this->totalUpah + $this->tabelUpah[$k]['subTotal'];
                    }
                    $this->totalHargaBarang = $this->totalHargaBarang + $this->rabs[$k]['subTotal'];
                }
            }
        }


        return view('livewire.show-rab');
    }
}
