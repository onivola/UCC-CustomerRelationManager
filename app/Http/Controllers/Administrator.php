<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnexionRequest;
use App\Models\Team;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class Administrator extends Controller
{
    public function index(){
        if(Auth::user() != null){
            $user = Auth::user();
            if ($user->type === 'Agent') {
                return redirect()->intended(route('agent.dashboard'));
            } elseif ($user->type === 'CQ') {
                return redirect()->intended(route('cq.dashboard'));
            }
        }
        return view('login');
    }
    public function singup(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' =>'required',
            'team' => 'required',
            'password' => 'required',
            'type' => [Rule::in(['Agent', 'CQ'])],
        ]);
        if ($validator->fails()) {
            ///dd(404);
            //return redirect()->back()->withErrors($validator)->withInput();
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->id_team= $request->team;
            $user->password = Hash::make($request->password);
            $user->type = $request->type;
            $user->save();

            //dd(2020);
            //dd($request->all());
            return redirect()->back()->with('success_type', 'La personne a été créée avec succès !');
        }
    }

    public function update_singup(Request $request) {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'id'=>'required',
            'name' => 'required',
            'email' =>'required',
            'team' => 'required',
            'password' => 'required',
            'type' => [Rule::in(['Agent', 'CQ'])],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->with('falaid_upate','Verifiez bien les champ.');
        } else {
            // Récupérer l'utilisateur à mettre à jour
            $user = User::find($request->id);

            // Vérifier si l'utilisateur existe
            if ($user) {
                $user->name = $request->name;
                $user->email = $request->email;
                $user->id_team = $request->team;
                $user->password = Hash::make($request->password);
                $user->type = $request->type;
                $user->save();

                return redirect()->back()->with('success_update', 'La personne a été mise à jour avec succès !');
            } else {
                // Gérer le cas où l'utilisateur n'a pas été trouvé
                return redirect()->back()->with('error_type', 'Utilisateur non trouvé !');
            }
        }
    }


    public function create_team(Request $request){
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'team' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $team = new Team();
            $team->team = $request->team;
            $team->save();
            return redirect()->back()->with('success_team', 'L\'équipe a été créée avec succès !');

        }
    }
    public function doLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $name = $request->input('name');
        $password = $request->input('password');

        if (Auth::attempt(['name' => $name, 'password' => $password])) {
            $user = Auth::user();
            if ($user->type === 'Agent') {
                $this->connecter($user->id);
                return redirect()->intended(route('agent.dashboard'))->with('user', $user);
            } elseif ($user->type === 'CQ') {
                $this->connecter($user->id);
                return redirect()->intended(route('cq.dashboard'))->with('user', $user);
            }
        }


        return redirect()->back()->withErrors(['name' => 'Invalid name'])->withInput($request->only('name'));
    }


    public function List(){
        return view('admin.administration',['clients' => \App\Models\User::paginate(25)]);
    }
    public function Show(string $slug,string $id){
        $client = \App\Models\User::findOrFail($id);
        return view('admin.show', compact('client'));
        //return ([$client -> name , $client -> id , $client -> birthday]);

        //return view('admin.administration',['clients' => \App\Models\FromCanada::paginate(25)]);
        /*return ([
            $client ->passport_number
        ]);*/
    }
    public function logout()
    {
        $this->deconnecter(Auth::user()->id);
        Auth::logout();
        return redirect()->route('login');
    }
    private function connecter($id)
    {
        $user_connexion = User::find($id);
        $user_connexion->status ="connecter";
        $user_connexion->save();
    }
    private function deconnecter($id)
    {
        $user_connexion = User::find($id);
        $user_connexion->status ="deconnecter";
        $user_connexion->save();
    }

    public function select_team_id(){
        $teams = User::all();
        //dd($teams);
        //return response()->json($teams[0]->id_team);
        return response()->json($teams);

    }
    public function utilisateur(){
        $teams = team::all();
        $users = DB::table('users')
        ->join('teams', 'teams.id', '=', 'users.id_team')
        ->select('users.*', 'teams.team')
        ->get();
        //dd($users);
        return view('cq.cq_utilisateur',compact('teams','users'));
        //return response()->json($teams);
    }

    public function delete_user($id) {
        $deleted = DB::table('users')->where('id', $id)->delete();

        if ($deleted) {
            return redirect()->back()->with('success_delete', 'L\'utilisateur a été supprimé avec succès !');
        } else {
            return redirect()->back()->with('error_type', 'Échec de la suppression de l\'utilisateur.');
        }
    }

}


          /* User::create([
            'name' => 'Agent1',
            'email' => 'Administrator_dev@gmail.com',
            'password' => Hash::make('Agent1'),
            'type' => 'Agent'
            'name' => 'CQ1',
            'email' => 'Administrator_cq@gmail.com',
            'password' => Hash::make('CQ1'),
            'type' => 'CQ'
        ]);*/
