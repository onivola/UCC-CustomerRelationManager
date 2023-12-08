<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CrmModel;
use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;


class DashboardController extends Controller
{

    public function CQ_dashboard(){
        $today = Carbon::today(); // Obtient la date d'aujourd'hui
        $data['today'] = $this->today_all_records();
        $data['seven'] = $this->last_7_days_records();
        $data['month'] = $this->this_month_records();
        $data['last_month'] = $this->last_month_records();
        $data['nb_user']=$this->nombre_user();
        //$data['today_prospects']=$this->today_all_records_prospects();
        $data['index']=1;
        //dd($data['today']);

        return view('cq.index_cq',compact('data'));
    }
    public function Agent_dashboard(){
        $user = Auth::user();
        $data['today'] = $this->today_agent($user->name);
        $data['seven'] = $this->last_7_days_agent($user->name);
        $data['month'] = $this->this_month_agent($user->name);
        $data['last_month'] = $this->last_month_agent($user->name);

        return view('index',compact('data'));
    }

    private function today_agent($Agent){
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

    private function last_7_days_agent($Agent){
        $agentName = $Agent;
        $dateAujourdhui = Carbon::today();
        // Calculer la date il y a 7 jours à partir d'aujourd'hui
        $date7JoursAvant = $dateAujourdhui->subDays(7);
        $leads7DerniersJours = CrmModel::where('Agent', $agentName)
            ->whereDate('created_at', '>=', $date7JoursAvant) // Filtrer les enregistrements des 7 derniers jours
            ->orderBy('created_at')
            ->get();
        $seven = $leads7DerniersJours->count();

        return $seven;
    }

    private function this_month_agent($Agent){
        $agentName = $Agent;
        $dateAujourdhui = Carbon::today();
        $leadsCeMois = CrmModel::where('Agent', $agentName)
            ->whereMonth('created_at', '=', $dateAujourdhui->month)
            ->whereYear('created_at', '=', $dateAujourdhui->year) // Assurez-vous de prendre en compte l'année aussi
             // Filtrer les enregistrements du mois en cours
            ->orderBy('created_at')
            ->get();
        $month = $leadsCeMois->count();

        return $month;
    }

    private function last_month_agent($Agent){
        $agentName = $Agent;
        // Obtenez la date du mois dernier
        $dateMoisDernier = Carbon::now()->subMonth();
        $leadsMoisDernier = CrmModel::where('Agent', $agentName)
            ->whereMonth('created_at', '=', $dateMoisDernier->month) // Filtrer les enregistrements du mois dernier
            ->whereYear('created_at', '=', $dateMoisDernier->year) // Assurez-vous de prendre en compte l'année aussi
            ->orderBy('created_at')
            ->get();
        $last_month = $leadsMoisDernier->count();

        return $last_month;
    }

    //CQ
    private function today_all_records() {
        $dateAujourdhui = Carbon::today();
        $dateFormatee = $dateAujourdhui->format('Y-m-d');
        $leadsAujourdhui = CrmModel::whereDate('created_at', $dateFormatee)
            ->whereYear('created_at', '=', $dateAujourdhui->year)
            ->orderBy('created_at')
            ->get();
        $nombreLeadsAujourdhui = $leadsAujourdhui->count();

        return $nombreLeadsAujourdhui;
    }

    /*private function today_all_records_prospects(){
        $dateAujourdhui = Carbon::today();
        $dateFormatee = $dateAujourdhui->format('Y-m-d');

    }*/

    private function last_7_days_records() {
        $dateAujourdhui = Carbon::today();
        // Calculer la date il y a 7 jours à partir d'aujourd'hui
        $date7JoursAvant = $dateAujourdhui->subDays(7);
        $leads7DerniersJours = CrmModel::whereDate('created_at', '>=', $date7JoursAvant)
            ->whereYear('created_at', '=', $dateAujourdhui->year)
            ->orderBy('created_at')
            ->get();
        $nombreLeads7DerniersJours = $leads7DerniersJours->count();

        return $nombreLeads7DerniersJours;
    }

    private function this_month_records() {
        $dateAujourdhui = Carbon::today();
        $leadsCeMois = CrmModel::whereMonth('created_at', '=', $dateAujourdhui->month)
            ->whereYear('created_at', '=', $dateAujourdhui->year) // Assurez-vous de prendre en compte l'année en cours
            ->orderBy('created_at')
            ->get();
        $nombreLeadsCeMois = $leadsCeMois->count();

        return $nombreLeadsCeMois;
    }

    private function last_month_records() {
        // Obtenez la date du mois dernier
        $dateMoisDernier = Carbon::now()->subMonth();
        $leadsMoisDernier = CrmModel::whereMonth('created_at', '=', $dateMoisDernier->month)
            ->whereYear('created_at', '=', $dateMoisDernier->year) // Assurez-vous de prendre en compte l'année du mois dernier
            ->orderBy('created_at')
            ->get();
        $nombreLeadsMoisDernier = $leadsMoisDernier->count();

        return $nombreLeadsMoisDernier;
    }

    private function nombre_user(){
        $list_user = User::all();
        $nbr_response = $list_user->count();

        return $list_user;
    }
}
