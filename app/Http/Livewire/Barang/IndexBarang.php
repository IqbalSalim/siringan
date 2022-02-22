<?php

namespace App\Http\Livewire\Barang;

use App\Models\Barang;
use Livewire\Component;
use Livewire\WithPagination;

class IndexBarang extends Component
{
    use WithPagination;
    public $paginate = 10, $search, $event;
    protected $queryString = ['search'];


    public function render()
    {
        return view('livewire.barang.index-barang', [
            'barangs' => $this->search === null ?
                Barang::latest()->paginate($this->paginate) :
                Barang::where('nama', 'like', '%' . $this->search . '%')->paginate($this->paginate)
        ]);
    }

    public function add()
    {
        return route('create-barang');
    }

    public function delete($id)
    {
        $barang = Barang::find($id);
        $barang->delete();
        session()->flash('message', 'Barang Berhasil dihapus.');
    }
}
