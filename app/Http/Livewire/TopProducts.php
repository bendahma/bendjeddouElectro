<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;

class TopProducts extends Component
{
    use WithPagination;

    public $items= 10 ;
    public $sellOrder= 'DESC' ;

    public function render()
    {
        $topProducts = DB::table('products')
                        ->join('bon_vente_product', 'products.id', '=', 'bon_vente_product.product_id')
                        ->select('products.*', DB::raw('sum(quantite) as qtt'))
                        ->groupBy('products.id')
                        ->orderBy('qtt',$this->sellOrder)
                        ->paginate($this->items);
        return view('livewire.top-products')->with('products',$topProducts);
    }
}
