<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Product;
use App\BonVente;

class VenteController extends Controller
{
    public function VenteGros(){
        $bonVente = BonVente::create();
        $products = Product::all();
        return view('backoffice.ventes.gros.selectProducts')
                                    ->with('products',$products)
                                    ->with('bonVente',$bonVente);
    }

    public function selectProduct(Client $client){

        $bonVente = BonVente::create([
            'client_id' => $client->id,
        ]);

        $products = Product::all();

        return view('backoffice.ventes.gros.selectProducts')
                                    ->with('products',$products)
                                    ->with('bonVente',$bonVente);
    }



}
