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

        $this->rabs = Ruangan::where('user_id', Auth::user()->id)->get();
        return view('livewire.arsip.index-arsip');
    }
}
