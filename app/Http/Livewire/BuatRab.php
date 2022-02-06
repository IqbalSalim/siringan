<?php

namespace App\Http\Livewire;

use App\Models\Ruangan;
use Livewire\Component;

class BuatRab extends Component
{
    public $room_id;
    public $updateMode = false;
    public $posts;
    public $inputs = [];
    public $i = 0;

    public $aturan = [
        'posts.panjang.0' => 'required',
        'posts.lebar.0' => 'required',
        'posts.tinggi.0' => 'required',
        'posts.ruangan.0' => 'required',
    ];

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
        $this->aturan['posts.panjang.' . $i] = 'required';
        $this->aturan['posts.lebar.' . $i] = 'required';
        $this->aturan['posts.tinggi.' . $i] = 'required';
        $this->aturan['posts.ruangan.' . $i] = 'required';

        // dd($this->aturan);
    }

    public function remove($i, $j)
    {
        unset(
            $this->aturan['posts.panjang.' . $j],
            $this->aturan['posts.lebar.' . $j],
            $this->aturan['posts.tinggi.' . $j],
            $this->aturan['posts.ruangan.' . $j],
        );
        unset($this->inputs[$i]);
    }



    public function store()
    {
        // Validasi
        // dd($this->posts);
        $this->validate($this->aturan, [
            'posts.panjang.0.required' => 'Kolom Panjang Perlu diisi',
            'posts.lebar.0.required' => 'Kolom Lebar Perlu diisi',
            'posts.tinggi.0.required' => 'Kolom Tinggi Perlu diisi',
            'posts.ruangan.0.required' => 'Kolom Ruangan Perlu diisi',
            'posts.panjang.*.required' => 'Kolom Panjang Perlu diisi',
            'posts.lebar.*.required' => 'Kolom Lebar Perlu diisi',
            'posts.tinggi.*.required' => 'Kolom Tinggi Perlu diisi',
            'posts.ruangan.*.required' => 'Kolom Ruangan Perlu diisi',

        ]);


        // Perbaikan Strukrut Array
        foreach ($this->posts as $key => $value) {
            $i = 0;
            // dd(array_values($value));
            foreach ($value as $row) {
                if ($key != "ruangan") {
                    $array[$i][$key] = $row;
                } else {
                    $ruangan = json_decode($row)->ruangan;
                    $lux = json_decode($row)->lux;
                    $array[$i]["ruangan"] = $ruangan;
                    $array[$i]["lux"] = $lux;
                }
                $i++;
            }
        }


        // Pemyimpanan Array disini
        $data = json_encode($array);
        $user = auth()->user();

        Ruangan::create([
            'user_id' => $user->id,
            'data' => $data,
        ]);
        session()->flash('message', 'RAB Berhasil dibuat.');
        return redirect()->to('show-rab');
    }

    public function render()
    {

        return view('livewire.buat-rab');
    }
}
