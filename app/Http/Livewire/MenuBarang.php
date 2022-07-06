<?php

namespace App\Http\Livewire;

use App\Barang;
use Livewire\Component;
use Livewire\WithPagination;

class MenuBarang extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search ='';
    public function render()
    {
        return view('livewire.menu-barang',[
            'barangs' => Barang::where('nama_barang', 'like', '%'.$this->search.'%')->paginate(12)
        ]);
    }

    public function updatingSearch(){
        $this->resetPage();
    }
}
