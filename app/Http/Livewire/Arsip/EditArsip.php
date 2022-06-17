<?php

namespace App\Http\Livewire\Arsip;

use App\Models\Ruangan;
use Illuminate\Http\Request;
use Livewire\Component;

class EditArsip extends Component
{


    public $room_id;
    public $updateMode = false;
    public $posts;
    public $inputs = [];
    public $i, $idRab;
    public $count = 1;
    public $namaBangunan, $jenisBangunan = 'Bangunan', $dayaRumah;

    protected $listeners = ['coba' => 'render'];


    public $aturan = [
        'posts.panjang.0' => 'required',
        'posts.lebar.0' => 'required',
        'posts.tinggi.0' => 'required',
        'posts.ruangan.0' => 'required',
    ];


    public function mount($id)
    {


        $this->idRab = $id;
        $rabs = Ruangan::find($id);
        $this->namaBangunan = $rabs->nama_bangunan;
        $this->jenisBangunan = $rabs->jenis_bangunan;
        $this->dayaRumah = $rabs->daya_rumah;

        $data = json_decode($rabs->data);
        $this->i = count($data) - 1;
        for ($i = 0; $i <= $this->i; $i++) {
            array_push($this->inputs, $i);
            $this->posts['ruangan'][$i] = '{"ruangan":"' . $data[$i]->ruangan . '", "lux": "' . $data[$i]->lux . '"}';
            // $this->posts['ruangan'][$i] = "Kamar";
            $this->posts['panjang'][$i] = $data[$i]->panjang;
            $this->posts['lebar'][$i] = $data[$i]->lebar;
            $this->posts['tinggi'][$i] = $data[$i]->tinggi;
            $this->posts['jmlsk'][$i] = $data[$i]->jmlsk;
        }

        // dd($this->posts);
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


    public function update()
    {
        $this->aturan['namaBangunan'] = 'required|string';
        // Validasi
        $this->validate($this->aturan, [
            'posts.panjang.0.required' => 'Kolom Panjang Perlu diisi',
            'posts.lebar.0.required' => 'Kolom Lebar Perlu diisi',
            'posts.tinggi.0.required' => 'Kolom Tinggi Perlu diisi',
            'posts.ruangan.0.required' => 'Kolom Ruangan Perlu diisi',
            'posts.panjang.*.required' => 'Kolom Panjang Perlu diisi',
            'posts.lebar.*.required' => 'Kolom Lebar Perlu diisi',
            'posts.tinggi.*.required' => 'Kolom Tinggi Perlu diisi',
            'posts.ruangan.*.required' => 'Kolom Ruangan Perlu diisi',
            'namaBangunan' => 'Nama Bangunan Perlu diisi'

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

        $rab = Ruangan::find($this->idRab);
        $rab->update([
            'data' => $data,
            'nama_bangunan' => $this->namaBangunan,
            'jenis_bangunan' => $this->jenisBangunan,
            'daya_rumah' => $this->dayaRumah,
        ]);
        session()->flash('message', 'RAB Berhasil diubah.');
        return redirect()->to('arsip-rab');
    }

    public function render()
    {
        return view('livewire.arsip.edit-arsip');
    }

    public function changeEvent()
    {
        return true;
    }
}
