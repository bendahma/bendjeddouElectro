<?php

namespace App\Http\Livewire;
require_once('ChiffresEnLettres.php');

use Illuminate\Support\Facades\DB;
use Livewire\WithPagination;
use Livewire\Component;
use App\Product;
use App\Client;
use App\Magazin;

class SelectProducts extends Component {

    use WithPagination;
    protected $listeners = ['refresh'=>'render'];

    public $search = "";
    public $items = 5 ;

    public $bonVente ;
    public $client_id = 0;
    public $client;

    public $selectedProducts;
    public $productToBeSelected ;

    public $qtt;
    public $oldQtt ;
    public $qttChange;
    public $editQuantite = 0 ;

    public $montantTotalBonVente = 0 ;
    public $montantTotalBonVenteSansRemise = 0 ;
    public $montantGained = 0 ;
    public $montantTotal = 0 ;
    public $remiseExist = false ;
    public $montantVerse = 0 ;

    public function mount(){
        $this->selectedProducts = [];
    }

    public function hydrate(){
        $this->selectedProducts = $this->bonVente->products ;
        $this->remiseExist = $this->montantTotalBonVente != $this->montantTotalBonVenteSansRemise ? true : false ;

    }

    public function addProductToCard(Product $product){
            if($product->checkStock($product->id,$this->qtt) == false){
               $this->qtt = 0 ;
               $this->emit('productoutOfSTock');
            } else {
               // $this->montantTotal = $product->price->discount == true ? ($product->price->prixVenteGros - (($product->price->prixVenteGros*$product->price->remise)/100))*$this->qtt : $product->price->prixVenteGros * $this->qtt;
               $this->montantTotal = $product::check_discount($product->id) ? ($product->price->prixVenteGros - (($product->price->prixVenteGros*$product->price->remise)/100))*$this->qtt : $product->price->prixVenteGros * $this->qtt;
               $this->montantTotalBonVenteSansRemise =  $product->price->prixVenteGros * $this->qtt ;
               $this->montantGained = $this->montantTotal - ( $product->price->prixAchat * $this->qtt ) ;
               $prixVente = $product->price->discount == true ? $product->price->prixVenteGros - (($product->price->prixVenteGros*$product->price->remise)/100) : $product->price->prixVenteGros ;
               $this->bonVente->products()->attach($product,['quantite'=>$this->qtt,'montantTotal'=>$this->montantTotal,'montantGained'=>$this->montantGained,'prixVente'=>$prixVente,]);
               $this->bonVente->updateMontantBonVente($this->montantTotal);
               $quantiteReste = $product->stock->quantiteReste - $this->qtt ;
               $product->stock->update(['quantiteReste' => $quantiteReste]);
               $this->qtt = 0 ;
               $this->emit('refresh');
            }


    }

    public function removeProduct(Product $product,$quantite){

            $this->montantTotal = $product->price->discount == true ? ($product->price->prixVenteGros - (($product->price->prixVenteGros*$product->price->remise)/100))*$quantite
                                                      : $product->price->prixVenteGros * $quantite;
            $this->montantTotalBonVenteSansRemise -=  $product->price->prixVenteGros * $quantite ;
            $this->bonVente->updateMontantBonVente($this->montantTotal,null,'remove');
            $this->bonVente->products()->detach($product);

            $quantiteReste =  $product->stock->quantiteReste + $quantite ;
            $outOfStock = $product->stock->quantiteReste == 0 ? 1 : 0 ;
            $product->stock()->update([
            'quantiteReste' => $quantiteReste,
            'outOfStock' => $outOfStock,
            ]);

            $this->emit('refresh');


    }

    public function changeQuantite(Product $product){
        $oldMontant = DB::table('bon_vente_product')->select('bon_vente_product.montantTotal')
                                                    ->where('bon_vente_id',$this->bonVente->id)
                                                    ->where('product_id',$product->id)
                                                    ->first();
        $oldQuantite = DB::table('bon_vente_product')->select('bon_vente_product.quantite')
                                                    ->where('bon_vente_id',$this->bonVente->id)
                                                    ->where('product_id',$product->id)
                                                    ->first();
        $this->bonVente->updateMontantBonVente($oldMontant->montantTotal,null,'remove');
        $this->montantTotal = $product->price->discount == true ? ($product->price->prixVenteGros - (($product->price->prixVenteGros*$product->price->remise)/100)) * $this->editQuantite
                                                                : $product->price->prixVenteGros * $this->editQuantite;
        $product->bonventes()->sync([$this->bonVente->id => ['quantite' => $this->editQuantite,'montantTotal'=> $this->montantTotal]]);
        $this->bonVente->updateMontantBonVente($this->montantTotal);
        $this->editQuantite = 0 ;
        $this->emit('refresh');
        $this->emit('closeModel');

    }

    public function montantPayer(){
        $this->bonVente->updateMontantBonVente(null,$this->montantVerse,null);
        $this->emit('refresh');
        $this->emit('closeModel');

    }

    // Téléchargé Bon Vente
    public function endVends(){


        // Remeve product from stock
        foreach ($this->bonVente->products as  $product) {
            $quantiteReste =  $product->stock->quantiteReste - $product->pivot->quantite;
            $outOfStock = $product->stock->quantiteReste == 0 ? 1 : 0 ;
            $product->stock()->update([
                'quantiteReste' => $quantiteReste,
                'outOfStock' => $outOfStock,
            ]);
        }

        $template = new \PhpOffice\PhpWord\TemplateProcessor(dirname(dirname(__DIR__)) . '\templates\facture.docx');


        // Magazin
        $magazin = Magazin::first();
        $template->setValue('address', $magazin->address );
        $template->setValue('commune', $magazin->commune );
        $template->setValue('telephone', $magazin->telephone );
        $template->setValue('fix', $magazin->fix );
        $template->setValue('fax', $magazin->fax );

        // update bon vente
        if ($this->client_id != 0) {
            $this->bonVente->update(['client_id'=>$this->client_id]);
            $this->client = Client::find($this->client_id);
            $template->setValue('codeClient',$this->client->id );
            $template->setValue('clinetName',$this->client->firstName . ' ' . $this->client->lastName);
            $template->setValue('clientAdresse',$this->client->address . ' ' . $this->client->commune . ' ' . $this->client->wilaya);
            $template->setValue('clientActivite',$this->client->activite ?? '');
            $output = 'facture '. $this->client->firstName . ' ' . $this->client->lastName .'.docx';
        }
        //Section Bonvente
        $template->setValue('numeroBon',$this->bonVente->id);
        $template->setValue('dateBon',$this->bonVente->get_created_at($this->bonVente->created_at));


        // Fill products info into facture.docx
        $i=1;
        $nbrProducts = $this->bonVente->products()->count();
        $template->cloneRow('predRef', $nbrProducts);
        foreach ($this->bonVente->products as $product) {
            $PU = floatval($product->pivot->montantTotal) / floatval($product->pivot->quantite) ;
            $template->setValue('predRef#'.$i,  $product->refProduit ?? '');
            $template->setValue('productName#'.$i,  $product->name);
            $template->setValue('Qtt#'.$i,  $product->pivot->quantite );
            $template->setValue('prix#'.$i, number_format($PU,2,'.',' ') );
            $template->setValue('montant#'.$i, number_format($product->pivot->montantTotal,2,'.',' ') );
            $i=$i+1;
        }
        //



        // Montant du Bon de vente

        $montantTVA = ($this->bonVente->montantTotal*19)/100;


        $template->setValue('motantTotal',  number_format($this->bonVente->montantTotal,2,'.',' '));
        $template->setValue('motantTVA',  number_format($montantTVA,2,'.',' '));
        $template->setValue('montatGlobal',  number_format($this->bonVente->montantGlobal,2,'.',' '));

        // montant en lettre
        $ChiffreEnLettre = new ChiffreEnLettres();
        $ChiffreEnLettreOutput= $ChiffreEnLettre->Conversion($this->bonVente->montantTotal);
        $template->setValue('montantPayer',  number_format($this->bonVente->montantPayer,2,'.',' '));
        $template->setValue('montantReste',  number_format($this->bonVente->montantReste,2,'.',' '));
        $template->setValue('motantLettre',  strtoupper($ChiffreEnLettreOutput));

        $output = 'facture.docx';

        ob_end_clean();
        ob_start();
        $template->saveAs(storage_path($output));
        return response()->download(storage_path($output));
    }

    public function render()
    {
        $products = Product::search($this->search)->with('price')->orderBy('id','ASC')->paginate($this->items,['id','name']);
        $clients = Client::all();
        return view('livewire.select-products')
                        ->with('clients',$clients)
                        ->with('products',$products);
    }
}
