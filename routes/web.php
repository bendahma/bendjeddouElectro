<?php

use Illuminate\Support\Facades\Route;
use App\BonVente;
use App\Frais;

Auth::routes();

Route::middleware(['auth'])->group(function(){

   Route::redirect('/','/login');

   Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::prefix('backoffice/product')->group(function(){
        Route::name('product.')->group(function(){
            Route::get('/remove/{product}','ProductController@Remove')->name('remove');
            Route::get('/removed','ProductController@Removed')->name('removed');
            Route::get('/restore/{id}','ProductController@Restore')->name('restore');
            Route::get('/delete/{product}','ProductController@Delete')->name('delete');
            Route::get('/remise','ProductController@Remise')->name('remise');
            Route::get('/endDiscount/{product}','ProductController@endDiscount')->name('endDiscount');
            Route::post('/remise/{product}','ProductController@RemisePrix')->name('remisePrix');
        });
    });

    Route::prefix('backoffice/facture')->group(function(){
        Route::name('bonVente.')->group(function(){
            Route::get('/','BonVenteController@index')->name('index');
            Route::get('/{bonVente}/details','BonVenteController@details')->name('details');
            Route::post('/{bonVente}/versement/','BonVenteController@versement')->name('versement');
            Route::get('/removeProduct/{bonVente}/{product}','BonVenteController@removeProduct')->name('removeProduct');
            Route::post('/editQuantite/{bonVente}/{product}','BonVenteController@editQuantite')->name('editQuantite');
            Route::get('/{bonVente}/removeBon','BonVenteController@removeBonVente')->name('remove');
            Route::get('telecharger/{bonVente}','BonVenteController@Telecharge')->name('telecharge');
            Route::get('remboursement/{bonVente}','BonVenteController@Rembourse')->name('rembourse');
        });
    });

    Route::prefix('backoffice')->group(function(){
            Route::resource('/client','ClientController');
            Route::resource('/category','CategoryController');
            Route::resource('/marque','MarqueController');
            Route::resource('/product','ProductController');
            Route::resource('/stock','StockController');
            Route::resource('/statistique','StatistiqueController');
            Route::resource('/fournisseur','FournisseurController');
            Route::get('/fournisseur/{fournisseur}/transaction/list','TransactionController@List')->name('transaction.list');
            Route::resource('/fournisseur/{fournisseur}/transaction','TransactionController');

            Route::get('/client/{client}/supprime','ClientController@Supprime');
            Route::get('/marque/{marque}/supprime','MarqueController@Supprime');
            Route::get('/category/{category}/supprime','CategoryController@Supprime');
            Route::get('/fournisseur/{fournisseur}/supprime','FournisseurController@Supprime');
            Route::get('/transaction/{transaction}/supprime','TransactionController@supprime');
            Route::get('/transaction/{transaction}/supprime','TransactionController@supprime');

            Route::post('/stock/{product}/add','StockController@AddQuantite');
            Route::patch('/stock/{product}/edit','StockController@UpdateQuantite');

           Route::get('/marque/{marque}/products','MarqueController@products')->name('marque.products');
           Route::get('/category/{category}/products','CategoryController@products')->name('category.products');

    });

      Route::prefix('backoffice/magazin')->group(function(){
         Route::name('magazin.')->group(function(){
            Route::get('/profile','MagazinController@profile')->name('profile');
            Route::patch('/profile/{magazin}','MagazinController@update')->name('updateProfile');

         });

      });

      Route::get('/users/{user}/supprime','UserController@supprime')->name('user.supprime');


      Route::resource('/employee','EmployeController');
      Route::resource('/users','UserController');
      Route::resource('/frais','fraisController');

    Route::get('/frais/{frais}/supprime','fraisController@supprime')->name('frais.supprime');
    Route::get('/employee/{employe}/supprime','EmployeController@Supprime')->name('employee.supprime');

    Route::prefix('backoffice/vente')->group(function(){
        Route::name('vente.')->group(function(){
            Route::get('/','VenteController@VenteGros')->name('gros');
            Route::get('/selectProduct/client/{client}','VenteController@selectProduct')->name('selectProduct');
        });
    });

});


Route::get('/data',function(){
   dd(DB::table('bon_vente_product', 'bon_vente_product.product_id' , '=' , 1)
    ->selectRaw('product_id,sum(quantite) as qtt')
    ->groupBy('product_id')
    ->orderBy('qtt','DESC')
    ->first());
});
