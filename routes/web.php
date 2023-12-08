<?php

use App\Http\Controllers\Administrator;
use App\Http\Controllers\AgentFormController;
use App\Http\Controllers\BdcController;
use App\Http\Controllers\ContratController;
use App\Http\Controllers\CqController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\ProspectController;
use App\Http\Controllers\SignatureController;
use App\Http\Controllers\SocieteController;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TestCotroller;
use App\Models\ProspectModel;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;
use App\Http\Controllers\PHPMailerController;
use App\Http\Controllers\SendImageController;
use Spatie\LaravelIgnition\FlareMiddleware\AddJobs;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*Route::get('/', function () {
    return view('login');
});*/
Route::post('/login-administration',[Administrator::class,'doLogin']);

Route::get('/',[Administrator::class,'index'])->name('login'); //if 'login-page change change Authenticate in the middleware'
Route::get('/registration',function(){
    return view("registre");
});

//acien traitement-enregistrement
//Route::post('/traitement-enregistrement',[Administrator::class,'singup']);


Route::group(['middleware' => ['auth','auth.session']], function() {
    Route::post('/deconnexion', [Administrator::class, 'logout'])->name('logout');

    //Agent
    //Route::get('/dashbord-crm-ucc',function(){return view('index');})->name('agent.dashboard');  lists-devis-all
    Route::get('/dashbord-crm-ucc',[DashboardController::class,'Agent_dashboard'])->name('agent.dashboard');

    Route::post('/traitement-formulaire-agent',[AgentFormController::class,'index'])->name('traitement-form-agent');
    //Route devis par agent
    Route::get('/lists-devis-per-agent/{Agent}',[AgentFormController::class,'Quote_list_by_agent']);
    //Route tous les devis cote CQ
    Route::get('/lists-devis-all',[CqController::class,'Quote_all'])->name('lists-devis-all');
    Route::get('/lists-lead-per-agent/{Agent}',[AgentFormController::class,'list_leads']);
    Route::get('/delete-lead/{id}' ,[AgentFormController::class , 'delete_lead']);
    Route::get('/update-lead/{id}' ,[AgentFormController::class , 'update_lead']);
    Route::get('/insertion-lead',function(){return view('contrat');})->name('contrat');
    Route::get('/list-leads',function(){return view('list_leads');})->name('list_contrats');
    Route::get('/contrat-lead',function(){return view('commande');})->name('commande');
    Route::get('/commande-lead/{id}',[AgentFormController::class,'voir']);
    Route::get('/commande-lead-de-list/{id}',[AgentFormController::class,'voir_list']);//de la list
    //yousign send mail
    Route::get('/yousign-send-pdf/{id}',[PDFController::class,'generatePDF_voir']);
    //Route::get('/commande-pdf-for-send',[PDFController::class,'generatePDF']);

    /* Devis */
    //Route vers le voir du devis
    //Route::get('/list-to-review-page/{id}',[CqController::class,'list_to_review']);
    //Route::get('/update-lead-list-to-command/{id}',[CqController::class,'list_to_update']);
    Route::get('/devis-lead-cq',function(){return view('cq.cq_voir_devis');})->name('devisCQ');

    Route::post('/traitement-formulaire-cq-devis',[DevisController::class,'indexController_devis'])->name('traitement-devis');

    Route::get('/see-quote-before-sending-it/{id}',[DevisController::class,'VoirCQ']);
    Route::get('/update-lead-list-to-devis/{id}',[DevisController::class,'UpdateCqDevis']);
    //fake yousign send mail c'est le route vers envois email BDC
    Route::get('/send-pdf/{id}',[BdcController::class,'generatePDF_voir_bdc']);
    Route::get('/commande-pdf-for-send',[BdcController::class,'generatePDF']);
    Route::get('/test',[TestCotroller::class,'index']);
    Route::get('/test_test',[PDFController::class,'test']);
    //cq

    //page d'acceuil commandeCQ
    //Route::get('/cq-dashboard',function(){return view('cq.index_cq');})->name('cq.dashboard');
    Route::get('/cq-dashboard',[DashboardController::class,'CQ_dashboard'])->name('cq.dashboard');
    //insertion contrat par le cq
    Route::get('/insertion-lead-cq',function(){return view('cq.cq_contrat');})->name('cq.contrat');
    //cq list de tous les leads
    Route::get('/all-leads',[CqController::class,'index']);
    //view list to review
    Route::get('/list-to-review-page/{id}',[CqController::class,'list_to_review']);
    //view list to update page
    Route::get('/update-lead-list-to-command/{id}',[CqController::class,'list_to_update']);
    //change for devis
    Route::get('/contrat-lead-cq',function(){return view('cq.cqcommande');})->name('commandeCQ');
    Route::post('/traitement-formulaire-cq',[CqController::class,'indexController'])->name('traitement-form-agent');

    //societe.com v
    Route::get("/api-search",[SocieteController::class,'api_search_raison_social']);
    Route::post('/api-siret',[SocieteController::class,'api_search_siret']);
    Route::get("/gle-search",[SocieteController::class,'google']);
    Route::get("/gle-search-test",[SocieteController::class,'google_test']);

    //status des agents connecter
    Route::get('/get-agent-status/{id}', [StatusController::class,'getAgentStatus']);
    //team in the dashboard
    Route::get('/get-team-agent/{id}',[StatusController::class,'agent_team']);
    //nombre de leads par agent  yousign
    Route::get('/get-leads-save/{name}',[StatusController::class,'Leadsave']);
    //etats des leads par agent yousign
    Route::get('/get-leads-send/{name}',[StatusController::class,'nombre_signe']);

    //filtre
    Route::post('/filter' ,[StatusController::class , 'filter']);

    //ROUTE UTILISATEUR CRM
    //Route::get('/utilisateur-crm', function(){return view('cq.cq_utilisateur');})->name('cq-utilisateur');
    Route::get('/utilisateur-crm',[Administrator::class,'utilisateur'])->name('cq-utilisateur');

    //list_contrat
    Route::get('/contrat-liste',[ContratController::class,'index']);
    //list vrai contrat par agent
    Route::get('/contrat_list_par_agent/{name}',[ContratController::class,'index_agent']);



    //statistique Prospect sur le dashboard de CQ
    Route::get('/stats-to-day',[StatusController::class,'getTodayStats']);



    //tratement-enregistration
    Route::post('/traitement-enregistrement',[Administrator::class,'singup']);
    Route::post('/traitement-creation-team',[Administrator::class,'create_team']);
    //mise a jour de tratement update_singup update enregistrement
    Route::post('/update-traitement-enregistrement',[Administrator::class,'update_singup']);
    Route::get('/delete-user/{id}',[Administrator::class,'delete_user']);

    //send image
    Route::get('/send-image-hublot/{id}',[SendImageController::class,'index']);
});

//generation de url vers le BDC
Route::get('/signature/c/{id}/a0baffb9-b636-4f76-bbfa-f6440571b540/{siret}',[ProspectController::class,'index'])->name('bdc-signer');
Route::get('/test-email', [AgentFormController::class, 'sendEmail']);
Route::get('/send-mail',[MailController::class,'send_mail_after_signe']);
//fake yousign
Route::post('/sign-email', [SignatureController::class,'signEmail']);
Route::post('/check-link-signature', [SignatureController::class, 'checkLinkSignature'])->name('check-link-signature');
Route::post('/get-signature', [SignatureController::class, 'getSignature'])->name('get-signature');


//Route signature du prospect


Route::post('/check_signature',[ProspectController::class,'Signature']);
//ajax
Route::get('/check-signature/{siret}',[ProspectController::class,'checkSign']);

//Route::get('/modal',function(){return view('prospects.modal_after_signe');});
Route::get('/modal',[ProspectController::class,'aftersign']);

Route::get("/email", [PHPMailerController::class, "email"])->name("email");
Route::get("/send-emailphpmailer", [PHPMailerController::class, "composeEmail"]);



//carte
//Route::get('/carte-itineraire',)


//Route::get('/notification-sarika/{siret}',[ProspectController::class,"notification_email"]);



///Route::get('/stats-to-day/{agent}',[StatusController::class,'getTodayStats']);


Route::get('/stat-to-day-all',[StatusController::class,'GetStatsToday']);
