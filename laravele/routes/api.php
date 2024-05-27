<?php
use App\Http\Controllers\WhatsAppController;
use App\Http\Controllers\AssistanceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MarqueController;
use App\Http\Controllers\VehiculeController;
use App\Http\Controllers\ModeleController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\OptionAssistanceController;
use App\Http\Controllers\PuissanceFiscaleController;
use App\Http\Controllers\TypeMotorisationController;
use App\Http\Controllers\VilleController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\MontantProposeController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\TarificationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\ResetPasswordController;
use App\Models\Offre;
use App\Http\Controllers\LogoutController;
use App\Models\OptionAssistance;
use Illuminate\Http\Request;
use App\Http\Controllers\EspaceClientController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Mailer\Transport\Smtp\Auth\LoginAuthenticator;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::resource('Marques',MarqueController::class);
Route::resource('Villes', VilleController::class);
Route::resource('Typem', TypeMotorisationController::class);
Route::resource('PuissanceFiscale', PuissanceFiscaleController::class);
Route::get('Modele', [ModeleController::class, 'index']);
Route::get('TypeM', [MarqueController::class, 'index']);
Route::get('Offres', [OffreController::class, 'index']);
//Route::resource('vehicules', VehiculeController::class);
Route::post('/vehicules', [VehiculeController::class, 'store']);

Route::get('/offres', function () {
  $offres = Offre::with('garantiesSelectionnees.garantie')->get();
  return $offres;

});
Route::get('assistances', [AssistanceController::class, 'index']);
Route::get('optionsAssistances', [OptionAssistanceController::class, 'index']);
Route::get('/assistances/{assistanceId}/optionsAssistances', [AssistanceController::class, 'optionsAssistances']);
Route::get('optionsAssistances/{id}/description', [OptionAssistanceController::class, 'getDescription']);
Route::get('clients', [ClientController::class, 'index']);
Route::post('login', [LoginController::class, 'check']);
Route::post('resetPassword', [LoginController::class, 'reset']);
Route::post('/client/login', [LoginController::class, 'check']);
Route::post('/admin/login', [LoginController::class, 'adminLogin']);
// routes/api.php
Route::post('client/password/email',[ForgotPasswordController::class, 'sendClientResetLinkEmail'])->name('client.password.email');
Route::post('admin/password/email',[ForgotPasswordController::class, 'sendAdminResetLinkEmail'])->name('admin.password.email');
Route::get('/vehicules/{id}', [VehiculeController::class, 'index']);
Route::get('/vehicules/nontraites', [VehiculeController::class,'getNonTraites']);
Route::put('/vehicules-statut/{id}', [VehiculeController::class, 'update']);
Route::get('vehicules/traitee', [VehiculeController::class, 'create']);
Route::get('devisnontraites', [ContratController::class, 'devisNonTraites']);
//Route::get('/admin/clients-contrats-non-traités', [ContratController::class, 'getContratsNonTraites']);
//Route::get('/admin/clients-contrats-traités', [ContratController::class, 'getContratsTraites']);
Route::get('/api/vehicule/{matricule}', [VehiculeController::class,'update']);
Route::get('/vehicules/{matricule}', [VehiculeController::class, 'show']);
Route::get('/clients/{id}', [ClientController::class, 'show']);
Route::get('/marques/{id}', [MarqueController::class, 'show']);
Route::post('/montants-proposes', [MontantProposeController::class, 'store']);
Route::get('/clients/{id}', [ClientController::class, 'show']);



Route::get('models/{id}/nom', [ModeleController::class, 'getModelName']);
Route::get('TypeMotorisation/{id}/nom', [TypeMotorisationController::class, 'getTypeMotorisarion']);
Route::get('Ville/{id}/nom', [VilleController::class, 'getVilleName']);
Route::post('/clients_form', [ClientController::class, 'store']);



////////////////////

Route::get('/admin/clients-devis-non-traités', [DevisController::class, 'getDevisNonTraites']);
Route::get('/admin/clients-devis-traités', [DevisController::class, 'getDevisTraites']);
Route::post('/enregistrer', [DevisController::class, 'store']);
//devis-Montants
Route::put('/devis/{id}', [DevisController::class, 'ajouter']);
Route::get('marques/{id}/nom', [MarqueController::class, 'getMarqueName']);
Route::post('/send-whatsapp', [WhatsAppController::class, 'sendMessage']);
Route::post('/send-message', 'YourController@sendMessage');
Route::post('/clients/{client}/send-whatsapp', [ClientController::class, 'sendWhatsAppMessage']);
//Email
Route::get('/tarification/{client}/{devis}', [TarificationController::class, 'show'])->name('tarification.show');
////Email 
Route::post('/send-email/{clientId}', [EmailController::class, 'sendEmailToClient']);
//Réccupération des montants
Route::get('/devis/{idDevis}/montants', [DevisController::class, 'getMontants']);

//Réccupérer le client à partir de l'url:
Route::get('clients/{clientId}/montants', [DevisController::class, 'getMontantsProposes']);


/*Mot de passe Oublié
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('password/reset', [ForgotPasswordController::class, 'reset']);
Route::post('/forgot-passwordl', [ResetPasswordController::class, 'sendResetLinkEmail']);
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
*/
Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [ResetPasswordController::class, 'reset']);



////Routes Espace Client 
//Route::middleware('auth:sanctum')->get('client', [ClientController::class, 'shows']);
//Route::middleware('auth:sanctum')->put('client', [ClientController::class, 'update']);
//Route::middleware('auth:client')->get('/client-infos', [ClientController::class, 'show']);
//Route::middleware('auth:sanctum')->get('/client', [ClientController::class, 'show']);
Route::middleware('auth:sanctum')->get('/espace-client/info', [EspaceClientController::class,'getInfoClient']);
Route::post('/logout', [LogoutController::class, 'logout']);

