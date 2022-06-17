<?php

namespace App\Http\Livewire;

use App\Models\Barang;
use App\Models\Ruangan;
use Livewire\Component;

class ShowRab extends Component
{
    public $rabs = [], $tabelUpah = [];
    public $totalHargaBarang = 0, $totalUpah = 0, $idRab;
    public $lampu;
    public $stopKontak;

    public function hitungMataLampu($lux, $panjang, $lebar)
    {
        // lumen di dapat 560 dari hasil perkalian 8 watt dikali 70 yang mereupakan ketetapan lumen
        $result = round(($lux * $lebar * $panjang) / (560 * 0.8 * 0.6 * 1));
        return (int) $result;
    }

    public function render()
    {
        $user = auth()->user();
        $result = Ruangan::where('user_id', $user->id)->orderBy('created_at', 'desc')->limit(1)->get();
        $this->idRab = $result[0]->id;
        $this->dayaRumah = $result[0]->daya_rumah;
        $jenisBangunan = $result[0]->jenis_bangunan;
        $data = json_decode($result[0]->data);
        $lampu = [];
        $stopKontak = [];

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

            array_push($lampu, [
                'ruangan' => $ruangan,
                'jumlah' => $titikMataLampu,
            ]);
            // End Lampu


            // Kabel NYM
            $kabelAtasKeLampu = (int) round(($panjang * $lebar) - $titikMataLampu);
            $jumlahKabelNYM = ($ruangan === 'Teras' || $ruangan === "Kamar Mandi") ? $kabelAtasKeLampu * 2 : $kabelAtasKeLampu;

            if ($this->dayaRumah !== null) {
                if ($this->dayaRumah == 'MCB450' || $this->dayaRumah == 'MCB900' || $this->dayaRumah == 'MCB1300') {
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
                array_push($stopKontak, [
                    'ruangan' => $ruangan,
                    'jumlah' => $jmlStopKontak,
                ]);
            }
            // End Stop Kontak Biasa


        }

        // MCB

        if ($jenisBangunan == 'Rumah Tinggal') {
            $barang = Barang::where('jenis', $this->dayaRumah)->get();
            $item[$barang[0]->id] = array(
                'jumlah' => 1,
            );
        } else {
            $barang = Barang::where('jenis', 'MCB5500')->get();
            $item[$barang[0]->id] = array(
                'jumlah' => 1,
            );
        }
        // End MCB



        // EndPipa


        foreach ($barangs as $k =>  $barang) {
            foreach ($item as $key => $value) {
                if ($key === $barang->id) {
                    $this->rabs[$k]['nama'] = $barang->nama;
                    $this->rabs[$k]['satuan'] = $barang->satuan;
                    $this->rabs[$k]['harga'] = $barang->harga;
                    $this->rabs[$k]['watt'] = $barang->watt;
                    $this->rabs[$k]['jenis'] = $barang->jenis;
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

        $this->lampu = $lampu;
        $this->stopKontak = $stopKontak;

        return view('livewire.show-rab');
    }
}
