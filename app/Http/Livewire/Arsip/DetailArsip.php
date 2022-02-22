<?php

namespace App\Http\Livewire\Arsip;

use App\Models\Ruangan;
use Livewire\Component;

class DetailArsip extends Component
{
    public $ruangans;
    protected $listeners = ['getRuangan'];

    public function render()
    {
        return view('livewire.arsip.detail-arsip');
    }

    public function getRuangan($id)
    {
        $ruangans =  Ruangan::find($id);
        $data = json_decode($ruangans->data, true);
        $this->ruangans = collect($data);
        // dd($this->ruangans);
    }
}
