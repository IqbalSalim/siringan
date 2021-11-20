<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class IndexUser extends Component
{
    use WithPagination;
    public $paginate = 5, $search;

    public function render()
    {
        return view('livewire.user.index-user', [
            'users' => $this->search === null ?
                User::with('roles')->whereRelation('roles', 'name', 'not like', 'admin')->paginate($this->paginate) :
                User::where('name', 'like', '%' . $this->search . '%')->whereHas('roles', function ($query) {
                    $query->where('name', 'not like', 'admin');
                })->paginate($this->paginate)
        ]);
    }

    public function delete($id)
    {
        $user = User::find($id);
        $role = $user->getRoleNames();
        $user->removeRole($role[0]);
        $user->delete();
        session()->flash('message', 'User Berhasil dihapus.');
    }
}
