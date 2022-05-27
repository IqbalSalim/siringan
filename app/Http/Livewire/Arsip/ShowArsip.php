<?php

namespace App\Http\Livewire\Arsip;

use App\Models\Barang;
use App\Models\Ruangan;
use Illuminate\Http\Request;
use Livewire\Component;

class ShowArsip extends Component
{

    public $rabs = [], $tabelUpah = [];
    public $totalHargaBarang = 0, $totalUpah = 0;
    public $idRab;

    public function mount(Request $req)
    {
        $this->idRab = $req->idRab;
    }

    public function hitungMataLampu($lux, $panjang, $lebar)
    {
        // lumen di dapat 560 dari hasil perkalian 8 watt dikali 70 yang mereupakan ketetapan lumen
        $result = round(($lux * $lebar * $panjang) / (560 * 0.8 * 0.6 * 1));
        return (int) $result;
    }

    public function render()
    {


        $result = Ruangan::find($this->idRab);
        $this->dayaRumah = $result->daya_rumah;
        $data = json_decode($result->data);


        foreach ($data as $row) {

            $ruangan = $row->ruangan;
            $panjang = $row->panjang;
            $lebar = $row->lebar;
            $tinggi = $row->tinggi;
            $jmlStopKontak = isset($row->jmlsk) ? $row->jmlsk : 0;
            $lux = $row->lux;
            $barang_watt = [];
            $barangs = Barang::all();

            // Menghitung Lampu
            $titikMataLampu = $this->hitungMataLampu($lux, $panjang, $lebar);

            // Lampu
            $barang = Barang::where('jenis', 'Lampu')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + $titikMataLampu : $titikMataLampu,
            );
            // End Lampu


            // Kabel NYM
            $kabelAtasKeLampu = (int) round(($panjang * $lebar) - $titikMataLampu);
            $jumlahKabelNYM = ($ruangan === 'Teras' || $ruangan === "Kamar Mandi") ? $kabelAtasKeLampu * 2 : $kabelAtasKeLampu;

            if ($this->dayaRumah !== null) {
                if ($this->dayaRumah == 'Daya Rendah') {
                    $barang = Barang::where('jenis', 'NYMK')->get();
                } else {
                    $barang = Barang::where('jenis', 'NYMB')->get();
                }
            }
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + $jumlahKabelNYM : $jumlahKabelNYM,
            );
            // End Kabel NYM


            // Kabel NYA
            $kabelSaklarKeAtas = ($tinggi - 1.50) * 2;

            $barang = Barang::where('jenis', 'NYA')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + $kabelSaklarKeAtas : $kabelSaklarKeAtas,
            );
            // End Kabel NYA


            // Saklar
            $barang = Barang::where('jenis', 'Saklar')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + 1 : 1,
            );
            $barang = Barang::where('jenis', 'PIP')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + ($tinggi - 1.50) : $tinggi - 1.50,
            );
            // End Saklar


            // Peteng
            $barang = Barang::where('jenis', 'PET')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + $titikMataLampu : $titikMataLampu,
            );
            // End Peteng

            // Stop Kontak AC
            if ($ruangan !== 'Teras' && $ruangan !== "Kamar Mandi") {
                $barang = Barang::where('jenis', 'SKK')->get();
                $item[$barang[0]->id] = array(
                    'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + 1 : 1,
                );

                $barang = Barang::where('jenis', 'NYA')->get();
                $item[$barang[0]->id] = array(
                    'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + (0.15 * 3) : (0.15 * 3),
                );
                $barang = Barang::where('jenis', 'PIP')->get();
                $item[$barang[0]->id] = array(
                    'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + (0.15 * 3) : (0.15 * 3),
                );
            }
            // End Stop Kontak AC

            // Stop Kontak Biasa
            if ($ruangan !== 'Teras' && $ruangan !== "Kamar Mandi") {
                $barang = Barang::where('jenis', 'SKB')->get();
                $item[$barang[0]->id] = array(
                    'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] +  $jmlStopKontak : $jmlStopKontak,
                );
                $barang = Barang::where('jenis', 'NYA')->get();
                $item[$barang[0]->id] = array(
                    'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + (($tinggi - 1.50) * 3) : (($tinggi - 1.50) * 3),
                );
                $barang = Barang::where('jenis', 'PIP')->get();
                $item[$barang[0]->id] = array(
                    'jumlah' => (isset($item[$barang[0]->id])) ? $item[$barang[0]->id]['jumlah'] + ($tinggi - 1.50) : ($tinggi - 1.50),
                );
            }
            // End Stop Kontak Biasa
        }

        // EndPipa


        $barangs = Barang::all();
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

        return view('livewire.arsip.show-arsip');
    }
}
