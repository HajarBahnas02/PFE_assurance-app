<?php

use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\OptionAssistanceController;
use App\Http\Controllers\PuissanceFiscaleController;
use App\Http\Controllers\TypeMotorisationController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\VilleController;
use App\Models\Offre;
use App\Models\OptionAssistance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});






/*
  GET|HEAD        / ........................................................................................................................................
  POST            _ignition/execute-solution ................................. ignition.executeSolution › Spatie\LaravelIgnition › ExecuteSolutionController
  GET|HEAD        _ignition/health-check ............................................. ignition.healthCheck › Spatie\LaravelIgnition › HealthCheckController
  POST            _ignition/update-config .......................................... ignition.updateConfig › Spatie\LaravelIgnition › UpdateConfigController
  GET|HEAD        api/Marques ....................................................................................... Marques.index › MarqueController@index
  POST            api/Marques ....................................................................................... Marques.store › MarqueController@store
  GET|HEAD        api/Marques/create .............................................................................. Marques.create › MarqueController@create
  GET|HEAD        api/Marques/{Marque} ................................................................................ Marques.show › MarqueController@show
  PUT|PATCH       api/Marques/{Marque} ............................................................................ Marques.update › MarqueController@update
  DELETE          api/Marques/{Marque} .......................................................................... Marques.destroy › MarqueController@destroy
  GET|HEAD        api/Marques/{Marque}/edit ........................................................................... Marques.edit › MarqueController@edit
  GET|HEAD        api/TypeM ................................................................................. TypeM.index › TypeMotorisationController@index
  POST            api/TypeM ................................................................................. TypeM.store › TypeMotorisationController@store
  GET|HEAD        api/TypeM/create ........................................................................ TypeM.create › TypeMotorisationController@create
  GET|HEAD        api/TypeM/{TypeM} ........................................................................... TypeM.show › TypeMotorisationController@show
  PUT|PATCH       api/TypeM/{TypeM} ....................................................................... TypeM.update › TypeMotorisationController@update
  DELETE          api/TypeM/{TypeM} ..................................................................... TypeM.destroy › TypeMotorisationController@destroy
  GET|HEAD        api/TypeM/{TypeM}/edit ...................................................................... TypeM.edit › TypeMotorisationController@edit
  GET|HEAD        api/user .................................................................................................................................
  GET|HEAD        api/ville ............................................................................................ ville.index › VilleController@index
  POST            api/ville ............................................................................................ ville.store › VilleController@store
  GET|HEAD        api/ville/create ................................................................................... ville.create › VilleController@create
  GET|HEAD        api/ville/{ville} ...................................................................................... ville.show › VilleController@show
  PUT|PATCH       api/ville/{ville} .................................................................................. ville.update › VilleController@update
  DELETE          api/ville/{ville} ................................................................................ ville.destroy › VilleController@destroy
  GET|HEAD        api/ville/{ville}/edit ................................................................................. ville.edit › VilleController@edit
  GET|HEAD        sanctum/csrf-cookie .................................................... sanctum.csrf-cookie › Laravel\Sanctum › CsrfCookieController@show
*/



Route::resource('Marques',MarqueController::class);
Route::resource('Villes', VilleController::class);
Route::resource('Typem', TypeMotorisationController::class);
Route::resource('PuissanceFiscale', PuissanceFiscaleController::class);
Route::get('Modele', [ModeleController::class, 'index']);
Route::get('TypeM', [MarqueController::class, 'index']);
Route::get('Offres', [OffreController::class, 'index']);
Route::resource('vehicules', VehiculeController::class);
Route::get('/offres', function () {
  $offres = Offre::with('garantiesSelectionnees.garantie')->get();
  return $offres;

});
Route::get('assistances', [AssistanceController::class, 'index']);
Route::get('optionsAssistances', [OptionAssistanceController::class, 'index']);
