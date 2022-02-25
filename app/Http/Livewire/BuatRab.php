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
    public $i = -1;

    public $aturan = [];

    public function mount()
    {
    }

    public function add($i)
    {
        $i = $i + 1;
        $this->i = $i;
        array_push($this->inputs, $i);
        $this->aturan['posts.panjang.' . $i] = 'required';
        $this->aturan['posts.lebar.' . $i] = 'required';
        $this->aturan['posts.tinggi.' . $i] = 'required';
        $this->aturan['posts.ruangan.' . $i] = 'required';
        $this->aturan['posts.cheklist.' . $i] = '';

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

        // dd($this->posts['cheklist']);
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


        $new_array = [];
        foreach ($array as $row) {
            if (isset($row['cheklist']) && $row['cheklist'] == true) {
                array_push($new_array, $row);
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

    public function cheklist($i)
    {
        $jumlah = 0;
        if (isset($this->posts['cheklist'])) {
            foreach ($this->posts['cheklist']  as $row) {
                if ($row == true) {
                    $jumlah++;
                }
            }
        } else {
            return $this->dispatchBrowserEvent('close-simpan');
        }

        if ($jumlah == 0) {
            return $this->dispatchBrowserEvent('close-simpan');
        } else {
            return $this->dispatchBrowserEvent('open-simpan');
        }
        // dd($this->posts);
        // if (isset($this->posts['cheklist'])) {
        // }
        // foreach ($this->posts['cheklist'] as $row) {
        //     dd($row);
        // }
        // if($this->posts['cheklist'][$i] == true)
    }

    public function render()
    {
        return view('livewire.buat-rab');
    }
}
