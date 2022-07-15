<?php

namespace App\Http\Livewire;

use App\Barang;
use App\Keranjang;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class MenuBarang extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $search ='';
    public function render(){
        $barangs = new Barang();
        $barangs = $barangs->getBarangMenu($this->search);
        $items = Keranjang::get()->where('user_id', Auth::user()->id);
        // dd($items);
        return view('livewire.menu-barang')->with('barangs', $barangs)->with('items', $items);
    }

    public function updatingSearch(){
        $this->resetPage();
    }
}
