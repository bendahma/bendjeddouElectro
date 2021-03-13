<?php

declare(strict_types = 1);

namespace App\Charts;

use Chartisan\PHP\Chartisan;
use ConsoleTVs\Charts\BaseChart;
use Illuminate\Http\Request;
use App\BonVente;
use Carbon\Carbon;
use DB;
use Illuminate\Support\Arr;

class SalesChart extends BaseChart
{

   public $dateDebut;
   public $dateFin;

    /**
     * Handles the HTTP request for the given chart.
     * It must always return an instance of Chartisan
     * and never a string or an array.
     */
    public function handler(Request $request): Chartisan
    {

      //  if(isset($request->dateDebut) && !is_null($request->dateDebut)) {
      //     $dateDebut = $request->dateDebut . ' 00:00:00';
      //  }else{
      //    $datedebut = date('Y-m');

      //  }

      // if( isset($request->dateFin) && !is_null($request->dateFin) ) {
      //    $dateFin = $request->dateFin . ' 23:59:59';
      // }

      $dateDebut = $request->dateDebut . ' 00:00:00';
      $dateFin = $request->dateFin . ' 23:59:59';

        $vente = BonVente::select(DB::raw('DATE(created_at) as date'), DB::raw('sum(montantTotal) as montant'))
                              ->whereBetween('created_at',[$dateDebut,$dateFin])
                              ->groupBy('date')
                              ->pluck('montant','date');



        return Chartisan::build()
                     ->labels($vente->keys()->toArray())
                     ->dataset('Revenu', $vente->values()->toArray());
    }
}
