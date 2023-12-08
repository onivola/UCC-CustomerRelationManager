<?php

namespace App\Http\Controllers;

use App\Models\CrmModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class CqController extends Controller
{
    public function index()
    {
        //$leads = CrmModel::all();
        $leads = DB::table('crm_models')
        ->leftJoin('prospect_models', 'prospect_models.Numero_SIRET', '=', 'crm_models.Numero_SIRET')
        ->selectRaw('
            *,
            crm_models.created_at as _crm_models_created_at,
            crm_models.updated_at as _crm_models_updated_at,
            crm_models.id as crm_id,
            IFNULL(crm_models.Numero_SIRET, prospect_models.Numero_SIRET) as Numero_SIRET
        ')
        ->get();
        //dd($leads);
        return view('cq.cq_liste_leads', compact('leads'));
    }

    public function Quote_all(){
        $leads = DB::table('crm_models')
        ->leftJoin('prospect_models', 'prospect_models.Numero_SIRET', '=', 'crm_models.Numero_SIRET')
        ->selectRaw('
            *,
            crm_models.created_at as _crm_models_created_at,
            crm_models.updated_at as _crm_models_updated_at,
            crm_models.id as crm_id,
            IFNULL(crm_models.Numero_SIRET, prospect_models.Numero_SIRET) as Numero_SIRET
        ')
        ->get();
        return view('cq.quote_list_all', compact('leads'));

    }
    public function list_to_review($id){
        $leads = CrmModel::find($id);
        return view('cq.list_to_view_command',compact('leads'));
    }
    public function list_to_update($id){
        $leads = CrmModel::find($id);
        return view('cq.cq_contrat',compact('leads'));
    }
    public function indexController(Request $request){
        $validator = Validator::make($request->all(), [
            'Noms_commerciaux' => 'required',
            'Adresse_postale' =>'required',
            'code_postale' => 'required',
            'Numero_SIRET' => 'required',
            'ville' => 'required',
            'name' => 'required',
            'first_name' => 'required',
            'function' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'exterieur' => [Rule::in(['oui', 'non'])],
            'type' => 'required',
            'Agent' => 'required',
            'PR30WMCEE' => 'required',
            'PR50WMCEE' => 'required',
            'PR100WMCEE' => 'required',
            'HUB1600RWBCEE' => 'required',
        ]);
        //dd($request);

        if ($validator->fails()) {
            ///dd(404);
            //return redirect()->back()->withErrors($validator)->withInput();

            return redirect()->back()->withErrors($validator)->withInput();
        }
        $numero_siret = $request -> Numero_SIRET;
        $siret_exist = CrmModel::where('Numero_SIRET',$numero_siret)->first();
        if(isset($siret_exist)){
            $dataToUpdate = [
                'Noms_commerciaux' => $request->Noms_commerciaux,
                'Adresse_postale' => $request->Adresse_postale,
                'code_postale' => $request->code_postale,
                'Numero_SIRET' => $request->Numero_SIRET,
                'ville' => $request->ville,
                'name' => $request->name,
                'first_name' => $request->first_name,
                'function' => $request->function,
                'phone' => $request->phone,
                'fixe' => $request->fixe,
                'email' => $request->email,
                'exterieur' => $request->exterieur,
                'type' => $request->type,
                'Agent' => $request->Agent,
                'PR30WMCEE' => $request->PR30WMCEE,
                'PR50WMCEE' => $request->PR50WMCEE,
                'PR100WMCEE' => $request->PR100WMCEE,
                'HUB1600RWBCEE' => $request->HUB1600RWBCEE,
                // Ajoutez d'autres champs ici au besoin
            ];
            // Mettre à jour le modèle avec les données du formulaire
            $siret_exist->update($dataToUpdate);
            $request->session()->put('Noms_commerciaux', $request->Noms_commerciaux);
            $request->session()->put('Adresse_postale', $request->Adresse_postale);
            $request->session()->put('code_postale', $request->code_postale);
            $request->session()->put('Numero_SIRET', $request->Numero_SIRET);
            $request->session()->put('ville', $request->ville);
            $request->session()->put('name', $request->name);
            $request->session()->put('first_name', $request->first_name);
            $request->session()->put('function', $request->function);
            $request->session()->put('phone', $request->phone);
            $request->session()->put('fixe', $request->fixe);
            $request->session()->put('email', $request->email);
            $request->session()->put('exterieur', $request->exterieur);
            $request->session()->put('type', $request->type);
            $request->session()->put('PR30WMCEE', $request->PR30WMCEE);
            $request->session()->put('PR50WMCEE', $request->PR50WMCEE);
            $request->session()->put('PR100WMCEE', $request->PR100WMCEE);
            $request->session()->put('HUB1600RWBCEE', $request->HUB1600RWBCEE);
            $siret_exist -> update();
            //return redirect()->back()->with('update','Modification du lead réussie !');
            return redirect()->intended(route('commandeCQ'))->with('update','Modification du lead réussie !');
        }else{
            $crm = new CrmModel();

            $crm -> Noms_commerciaux = $request->Noms_commerciaux;
            $crm -> Adresse_postale = $request->Adresse_postale;
            $crm -> code_postale = $request->code_postale;
            $crm -> Numero_SIRET = $request->Numero_SIRET;
            $crm -> ville = $request->ville;
            $crm -> name = $request->name;
            $crm -> first_name = $request->first_name;
            $crm -> function = $request->function;
            $crm -> phone = $request->phone;
            $crm -> fixe = $request->fixe;
            $crm -> email = $request->email;
            $crm -> exterieur = $request->exterieur;
            $crm -> type = $request->type;
            $crm -> Agent = $request->Agent;
            $crm -> PR30WMCEE = $request->PR30WMCEE;
            $crm -> PR50WMCEE = $request->PR50WMCEE;
            $crm -> PR100WMCEE = $request->PR100WMCEE;
            $crm -> HUB1600RWBCEE = $request->HUB1600RWBCEE;
            $request->session()->put('Noms_commerciaux', $request->Noms_commerciaux);
            $request->session()->put('Adresse_postale', $request->Adresse_postale);
            $request->session()->put('code_postale', $request->code_postale);
            $request->session()->put('Numero_SIRET', $request->Numero_SIRET);
            $request->session()->put('ville', $request->ville);
            $request->session()->put('name', $request->name);
            $request->session()->put('first_name', $request->first_name);
            $request->session()->put('function', $request->function);
            $request->session()->put('phone', $request->phone);
            $request->session()->put('fixe', $request->fixe);
            $request->session()->put('email', $request->email);
            $request->session()->put('exterieur', $request->exterieur);
            $request->session()->put('type', $request->type);
            $request->session()->put('PR30WMCEE', $request->PR30WMCEE);
            $request->session()->put('PR50WMCEE', $request->PR50WMCEE);
            $request->session()->put('PR100WMCEE', $request->PR100WMCEE);
            $request->session()->put('HUB1600RWBCEE', $request->HUB1600RWBCEE);

            $crm -> save();
            //return redirect()->back()->with('leadentre','Lead bien enregistré!');

            return redirect()->intended(route('commandeCQ'))->with('leadentre','Lead bien enregistré!');
        }
        return redirect()->back()->with('erreur','verifier bien les informations!');

        //return redirect()->intended(route('contrat'))->with('erreur','verifier bien les informations!');

    }
}
