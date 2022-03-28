<?php

namespace App\Http\Livewire\Arsip;

use App\Models\Ruangan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Redirect;
use Livewire\Component;

class IndexArsip extends Component
{
    public $rabs;

    public function render()
    {

        $this->rabs = Ruangan::where('user_id', Auth::user()->id)->latest()->get();
        return view('livewire.arsip.index-arsip');
    }

    public function delete($id)
    {
        $rabs = Ruangan::find($id);
        if ($rabs->user_id == auth()->user()->id) {
            $rabs->delete();
            session()->flash('message', 'RAB Berhasil dihapus.');
        } else {
            session()->flash('message', 'Anda tidak berhak menghapus RAB ini.');
        }
    }
}
