<?php

namespace App\Http\Controllers;

use App\Models\CrmModel;
use App\Models\User;
use Attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use GuzzleHttp\Client;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\DB;

class StatusController extends Controller
{
    public function getAgentStatus($id){
        //$agents = User::all(); // Remplacez 'role' par le champ qui indique le rôle de l'utilisateur
        //dd($agents);
        //return response()->json($agents->id);
        //$agents = User::pluck('id','name','status');
        //$agents = User::select('id', 'name', 'status')->get();
        $agents = User::find($id);
        return response()->json($agents);
    }

    public function agent_team($id){
        $team = DB::table('users')
        ->join('teams', 'teams.id', '=', 'users.id_team')
        ->select('users.*', 'teams.team')
        ->where('users.id', $id)
        ->get();

        //dd($team[0]->team); $team[0]->team
        return response()->json($team[0]->team);
    }

    public function Leadsave($name){
        $today = Carbon::today(); // Obtient la date d'aujourd'hui

        $leadsend = CrmModel::where('Agent', $name)
            ->whereDate('created_at', '=', $today) // Filtre par la date d'aujourd'hui
            ->orderBy('created_at', 'desc')
            ->orderBy('id', 'desc')
            ->get();
        //dd($leadsend);
        $nbr_leadsend = $leadsend->count();
        return response()->json($nbr_leadsend);
    }

    private function Leadsend($name){
        $today = Carbon::today();
        $leadsend = CrmModel::where('Agent', $name)
        ->whereDate('created_at', '=', $today)
        ->orderBy('created_at', 'desc')
        ->orderBy('id', 'desc')
        ->pluck('fixe', 'id');

        $responseData = [];
        foreach ($leadsend as $id => $fixe) {
            $responseData[] = [
                'id' => $id,
                'fixe' => $fixe,
            ];
        }
        $taille = $leadsend->count();
        $data = [
            $taille,$responseData
        ];
        return $data;

    }
    public function nombre_signe($name){
        $reponsedata = $this->Leadsend($name);
        // Créez une instance de Guzzle
        $client = new Client();
        $size = $reponsedata[0];
        //dd($reponsedata[1][0]);
        $signe=0;
        $envoyer=0;
        $inconnu=0;
        if($size>=1){
            for ($i = 0; $i < $size; $i++) {
                if($reponsedata[1][$i]['fixe']){
                    // URL de la requête
                    $url = "https://api.yousign.app/v3/signature_requests/" . $reponsedata[1][$i]['fixe']; // Assurez-vous d'avoir $data2 défini
                    // Headers pour l'authentification
                    $headers = [
                        'Authorization' => 'Bearer rAaS2nEDNNvLX1Z1KAz3bQ13AqNpgEyq',
                    ];
                    try {

                        $response = $client->request('GET', $url, ['headers' => $headers]);

                        $body = $response->getBody();
                        $data = json_decode($body);
                        if($data->status == 'done'){
                            $signe++;
                        }elseif($data->status == 'ongoing'){
                            $envoyer++;
                        }else{
                            $inconnu++;
                        }
                        //return response()->json($data);
                    } catch (\Exception $e) {
                        return response()->json(['error' => $e->getMessage()], 500);
                    }
                }else{
                    $inconnu++;
                }

                 //dd($reponsedata[1][0]["fixe"]);
            }
            return response()->json([
                'signe' => $signe,
                'envoyer' => $envoyer,
                'inconnu' => $inconnu
            ]);
        }else{
            return response()->json([
                'signe' => $signe,
                'envoyer' => $envoyer,
                'inconnu' => $inconnu
            ]);
        }

    }

    public function contrat_today($Agent){
        $today = $this->today_agent_statique($Agent);
        return $today;
    }

    /*public function save_today($Agent){
        $dateAujourdhui = Carbon::today();
        $dateFormatee = $dateAujourdhui->format('Y-m-d');

        $today = CrmModel::whereDate('created_at', $dateFormatee)
        ->where('Agent','=',$Agent)
        ->get();
        $day = $today->count();
        //dd($day);

        return $day;

    }
    public function send_today($Agent) {
        $dateAujourdhui = Carbon::today();
        $dateFormatee = $dateAujourdhui->format('Y-m-d');
        $jointure = DB::table('crm_models')
        ->join('prospect_models', 'crm_models.id', '=', 'prospect_models.id_lead')
        ->whereDate('crm_models.created_at', $dateFormatee)
        ->where('crm_models.Agent', $Agent)
        ->where('prospect_models.etat_signature', '=', 'aucun_aucun')
        ->select('crm_models.*', 'prospect_models.etat_signature', 'prospect_models.id_lead')
        ->get();
        $day = $jointure->count();

        return $day;
    }

    public function signed_today($Agent){
        $dateAujourdhui = Carbon::today();
        $dateFormatee = $dateAujourdhui->format('Y-m-d');
        $jointure = DB::table('crm_models')
        ->join('prospect_models', 'crm_models.id', '=', 'prospect_models.id_lead')
        ->whereDate('crm_models.created_at', $dateFormatee)
        ->where('crm_models.Agent', $Agent)
        ->where('prospect_models.etat_signature', '!=', 'aucun_aucun')
        ->select('crm_models.*', 'prospect_models.etat_signature', 'prospect_models.id_lead')
        ->get();
        $day = $jointure->count();

        return $day;
    }*/
    /*public function getTodayStats($Agent) {
        $dateAujourdhui = Carbon::today();
        $dateFormatee = $dateAujourdhui->format('Y-m-d');

        $stats = [
            'saved_today' => 0,
            'sent_today' => 0,
            'signed_today' => 0,
        ];


        $today_saved = CrmModel::whereDate('created_at', $dateFormatee)
        ->where('Agent','=',$Agent)
        ->get();
        $day_saved = $today_saved->count();

        $day_sent = DB::table('crm_models')
        ->join('prospect_models', 'crm_models.id', '=', 'prospect_models.id_lead')
        ->whereDate('crm_models.created_at', $dateFormatee)
        ->where('crm_models.Agent', $Agent)
        ->where('prospect_models.etat_signature', '=', 'aucun_aucun')
        ->select('crm_models.*', 'prospect_models.etat_signature', 'prospect_models.id_lead')
        ->get();
        $day_sent = $day_sent->count();

        $today_signed = DB::table('crm_models')
        ->join('prospect_models', 'crm_models.id', '=', 'prospect_models.id_lead')
        ->whereDate('crm_models.created_at', $dateFormatee)
        ->where('crm_models.Agent', $Agent)
        ->where('prospect_models.etat_signature', '!=', 'aucun_aucun')
        ->select('crm_models.*', 'prospect_models.etat_signature', 'prospect_models.id_lead')
        ->get();
        $day_signed = $today_signed->count();


        $stats['saved_today'] = $day_saved;
        $stats['sent_today'] = $day_sent;
        $stats['signed_today'] = $day_signed;

        return $stats;
    }*/

    private function today_agent_statique($Agent){
        $agentName = $Agent;
        $dateAujourdhui = Carbon::today();
        $dateFormatee = $dateAujourdhui->format('Y-m-d');
        $leadsAujourdhui = CrmModel::where('Agent', $agentName)
            ->whereDate('created_at', $dateFormatee)
            ->orderBy('created_at')
            ->get();
        $day = $leadsAujourdhui->count();

        return $day;
    }



    public function getTodayStats()
    {
        $dateAujourdhui = Carbon::today();
        $dateFormatee = $dateAujourdhui->format('Y-m-d');
        $users = User::all();
        $user_t = [];

        foreach ($users as $user) {

            $status = $user->status ?? 'deconnecter'; // Utilisation de l'opérateur de coalescence nulle
            $user_t[] = [
                'id_user' => $user->id,
                'name_user' => $user->name,
                'id_team' => $user->id_team,
                'status' => $status,
            ];
        }

        $leng = count($user_t);

        for ($i = 0; $i < $leng; $i++) {
            $today_saved = CrmModel::whereDate('created_at', $dateFormatee)
                ->where('Agent', $user_t[$i]['name_user'])
                ->get();
            $day_saved = $today_saved->count();
            $user_t[$i]['saved_lead'] = $day_saved;
        }

        for ($i = 0; $i < $leng; $i++) {
            $dateAujourdhui = Carbon::today();
            $dateFormatee = $dateAujourdhui->format('Y-m-d');
            $jointure = DB::table('crm_models')
            ->join('prospect_models', 'crm_models.id', '=', 'prospect_models.id_lead')
            ->whereDate('crm_models.created_at', $dateFormatee)
            ->where('crm_models.Agent', $user_t[$i]['name_user'])
            ->where('prospect_models.etat_signature', '=', 'aucun_aucun')
            ->select('crm_models.*', 'prospect_models.etat_signature', 'prospect_models.id_lead')
            ->get();
            $day_sent = $jointure->count();
            $user_t[$i]['sent_lead'] = $day_sent;
        }
        //dd($user_t);
        for ($i = 0; $i < $leng; $i++) {
            $today_signed = DB::table('crm_models')
                ->join('prospect_models', 'crm_models.id', '=', 'prospect_models.id_lead')
                ->whereDate('crm_models.created_at', $dateFormatee)
                ->where('crm_models.Agent', $user_t[$i]['name_user'])
                ->where('prospect_models.etat_signature', '!=', 'aucun_aucun')
                ->select('crm_models.*', 'prospect_models.etat_signature', 'prospect_models.id_lead')
                ->get();
            $day_signed = $today_signed->count();
            $user_t[$i]['signed'] = $day_signed;
        }

        for ($i = 0; $i < $leng; $i++) {
            $team = DB::table('users')
                ->join('teams', 'teams.id', '=', 'users.id_team')
                ->select('users.*', 'teams.team')
                ->where('users.id', $user_t[$i]['id_user'])
                ->get();
            $user_t[$i]['team'] = $team[0]->team;
        }
        //dd($user_t);
        return response()->json($user_t);
    }


}
