<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Http\Livewire\Field;
use App\Models\Barang;
use Illuminate\Http\Request;

class BuatRab extends Component
{
    public $panjang, $lebar, $tinggi, $ruangan, $room_id;
    public $updateMode = false;
    public $inputs = [];
    public $i = 1;

    protected $rules = [
        'ruangan.0' => 'required',
        'panjang.0' => 'required',
        'lebar.0' => 'required',
        'tinggi.0' => 'required',
        'ruangan.*' => 'required',
        'panjang.1' => 'required',
        'panjang.*' => 'required',
        'panjang.*.*' => 'required',
        'panjang' => 'required',
        'lebar.*' => 'required',
        'tinggi.*' => 'required',
    ];

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
    }

    public function remove($i)
    {
        unset($this->inputs[$i]);
    }

    private function resetInputFields()
    {
        $this->ruangan = '';
        $this->panjang = '';
        $this->lebar = '';
        $this->tinggi = '';
    }

    public function store()
    {
        $this->validate();

        // foreach ($this->account as $key => $value) {
        //     Account::create(['account' => $this->account[$key], 'username' => $this->username[$key], 'panjang' => $this->panjang[$key]]);
        // }

        // $this->inputs = [];

        // $this->resetInputFields();

        session()->flash('message', 'Account Added Successfully.');
    }

    public function render()
    {
        $panjang = 4;
        $lebar = 3;
        $tinggi = 3.25;
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

        $item[] = array(
            'id_barang' => $id_barang,
            'jumlah' => $titikMataLampu,
        );

        // End Lampu
        $kabelAtasKeLampu = ($panjang >= $lebar) ? $panjang / 2 : $lebar / 2;
        $kabelSaklarKeAtas = ($tinggi - 1.25) * 4;
        $barang = Barang::where('jenis', 'NYM')->get();
        $item[] = array(
            'id_barang' => $barang[0]->id,
            'jumlah' => $kabelAtasKeLampu,
        );
        $barang = Barang::where('jenis', 'NYA')->get();
        $item[] = array(
            'id_barang' => $barang[0]->id,
            'jumlah' => $kabelSaklarKeAtas,
        );
        // dd($item);




        // dd($kabelAtasKeLampu);

        return view('livewire.buat-rab');
    }
}
