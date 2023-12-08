<?php

namespace App\Http\Controllers;

use App\Models\DevisModel;
use Illuminate\Http\Request;

class ContratController extends Controller
{
    public function index(){
        $contrats = DevisModel::all();
        //dd($contrats);
        if ($contrats->isEmpty()) {
            return view('erreur_contrat_non_trouve');
        }
        return view('cq.list_contrat',compact('contrats'));
    }

    public function index_agent($agent){
        $contrats = DevisModel::where('agent', $agent)->get();

        if ($contrats->isEmpty()) {
            return view('erreur_contrat_non_trouve');
        }
        return view('list_contrat_par_agent', compact('contrats'));
    }

}
