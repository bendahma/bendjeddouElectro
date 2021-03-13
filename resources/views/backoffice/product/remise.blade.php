@extends('layouts.adminTemplate')

@section('content')
    <div class="container">
        <div class="card card-success">
            <div class="card-header">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <h5 class=""><i class="fas fa-archive mr-1"></i> Lists Des Produits</h5>
                </div>
                </div>
            <div class="card-body">
                <table class="table" id="TableRemise">
                    <thead>
                        <tr>
                            <th>N°</th>
                            <th>Nom</th>
                            <th>Prix d'achat</th>
                            <th>Prix de vente</th>
                            <th>Remise</th>
                            <th>Date Debut</th>
                            <th>Date Fin</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <td>{{$product->id}}</td>
                                <td>{{$product->name }} </td>
                                <td> {{ number_format($product->price->prixAchat,2,'.',' ')}} </td>
                                @if ($product->price->discount == true)
                                    <td>
                                       <span class="badge rounded-pill bg-danger text-light">En remise</span><br/>
                                       {{ number_format(  $product->price->prixVenteGros - ( ($product->price->prixVenteGros *  $product->price->remise) / 100 ) ,2,'.',' ')}}
                                    </td>
                                    <td>{{$product->price->remise . ' %'}}</td>
                                    <td>{{$product->price->dateDebutReduction}}</td>
                                    <td>{{$product->price->dateFinReduction}}</td>
                                    <td> <a href="{{route('product.endDiscount',$product->id)}}" class="btn btn-outline-danger">Arrète </a> </td>

                                @else
                                <td>{{ number_format($product->price->prixVenteGros,2,'.',' ')}} </td>

                                     <form action=" {{route('product.remisePrix',$product->id)}} " method="POST">
                                        @csrf
                                        <td> <input type="integer" class="form-control" name="remise" placeholder="Remise"> </td>
                                        <td> <input type="date" class="form-control" name="dateDebutReduction"> </td></td>
                                        <td> <input type="date" class="form-control" name="dateFinReduction"> </td></td>
                                        <td>
                                            <input type="submit" class="btn btn-outline-success btn-block" value="Confirmé">
                                        </td>
                                    </form>

                                @endif


                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
@endsection
