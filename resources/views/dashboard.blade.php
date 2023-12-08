<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!--<link rel="stylesheet" href="{{ asset('css/home.css') }}">-->

    <link rel="stylesheet" href="{{ asset('bootstrap-5.0.2-dist/css/bootstrap.min.css') }}" />
    <script src="{{ asset('bootstrap-5.0.2-dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('jquery/jquery-3.6.1.min.js') }}"></script>

    <link href="{{ asset('fontawesome/css/fontawesome.css')}}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/brands.css')}}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/solid.css')}}" rel="stylesheet">
    <link href="{{ asset('fontawesome/css/regular.css')}}" rel="stylesheet">
    <script src="{{ asset('js/preremplissage/main.js') }}"></script>
    <script src="{{ asset('jquery/validation/lead_agent_validation.js') }}"></script>
</head>
<body>

    <p>Agent</p>
        <!-- Bouton de déconnexion -->
        <div class="btn-group" role="group" aria-label="Basic example">
            <button type="submit" class="btn btn-primary" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                Déconnexion
            </button>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
        </div>
        <div>
            <small class="me-2 text-info">{{\Illuminate\Support\Facades\Auth::User()->name}}</small>
        </div>
        <div>
            <small class="me-2 text-info">{{\Illuminate\Support\Facades\Auth::User()->email}}</small>
        </div>
        <div>
            <small class="me-2 text-info">{{\Illuminate\Support\Facades\Auth::User()->password}}</small>
        </div>
        @if(session()->has('leadentre'))
            <div class="alert alert-success">
                {{ session()->get('leadentre') }}
            </div>
        @endif
        @if(session()->has('update'))
            <div class="alert alert-success">
                {{ session()->get('update') }}
            </div>
        @endif
        @if(session()->has('deleted'))
            <div class="alert alert-danger">
                {{ session()->get('deleted') }}
            </div>
        @endif
        <!-- Formulaire de déconnexion -->



        <form action="{{ route('traitement-form-agent') }}" method="POST" id="agent_form" class="ms-5 me-5 text-center">
            @csrf
            <div style="display: none;">
                <input type="text" name="Agent" value="{{\Illuminate\Support\Facades\Auth::User()->name}}">
            </div>
            <div class="row ">
                <div class="col-lg-6">
                    <div class="text-center mt-1 mb-1">
                        <h4>ÉTABLISSEMENT À ÉQUIPER </h4>
                    </div>
                    <div class="text-center mt-1 mb-1">
                        <label for="">RAISON SOCIALE</label>
                        <input type="text" name="Noms_commerciaux" class="form-control" value="{{ isset($leads->Noms_commerciaux) ? $leads->Noms_commerciaux : null }}">
                    </div>
                    <div class="text-center mt-1 mb-1">
                        <label for="">Adresse</label>
                        <input type="text" name="Adresse_postale" class="form-control" value="{{ isset($leads->Adresse_postale) ? $leads->Adresse_postale : null }}">
                    </div>
                    <div class="text-center mt-1 mb-1">
                        <label for="">CODE POSTAL</label>
                        <input type="text" name="code_postale" class="form-control" value="{{ isset($leads->code_postale) ? $leads->code_postale : null }}">
                    </div>
                  <!--  <div>
                        <label for="">Adresse postale</label>
                        <input type="text" name="Adresse_postale">
                    </div>-->
                    <div class="text-center mt-1 mb-1">
                        <label for="">Numéro SIRET</label>
                        <input type="text" name="Numero_SIRET" class="form-control" value="{{ isset($leads->Numero_SIRET) ? $leads->Numero_SIRET : null }}">
                    </div>
                    <div class="text-center mt-1 mb-1">
                        <label for="">Ville</label>
                        <input type="text" name="ville" class="form-control" value="{{ isset($leads->ville) ? $leads->ville : null }}">
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="text-center mt-1 mb-1">
                        <h4>CONTACT</h4>
                    </div>
                    <div class="text-center mt-1 mb-1">
                        <label for="">NOM</label>
                        <input type="text" name="name" class="form-control" value="{{ isset($leads->name) ? $leads->name : null }}">
                    </div>
                    <div class="text-center mt-1 mb-1">
                        <label for="">prenom</label>
                        <input type="text" name="first_name" class="form-control" value="{{ isset($leads->first_name) ? $leads->first_name : null }}">
                    </div>
                    <div class="text-center mt-1 mb-1">
                        <label for="">FONCTION</label>
                        <input type="text" name="function" class="form-control" value="{{ isset($leads->function) ? $leads->function : null }}">
                    </div>
                  <!--  <div>
                        <label for="">Adresse postale</label>
                        <input type="text" name="Adresse_postale">
                    </div>-->
                    <div class="text-center mt-1 mb-1">
                        <label for="">TELEPHONE</label>
                        <input type="text" name="phone" class="form-control" value="{{ isset($leads->phone) ? $leads->phone : null }}">
                    </div>
                    <div class="text-center mt-1 mb-1">
                        <label for="">E-mail</label>
                        <input type="email" name="email" class="form-control" value="{{ isset($leads->email) ? $leads->email : null }}">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <p>L’opération concerne-t-elle bien un éclairage extérieur ?</p>
                    <div class="form-check">
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="exterieur" id="flexRadioDefault1" value="oui" {{ isset($leads->exterieur) && $leads->exterieur === 'oui' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            OUI
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="exterieur" id="flexRadioDefault2" value="non" {{ isset($leads->exterieur) && $leads->exterieur === 'non' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault2">
                            NON
                        </label>
                      </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <p>Veuillez mentionner le type d’éclairage existant :</p>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="flexRadioDefault1" value="public" {{ isset($leads->type) && $leads->type === 'public' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault1">
                            Éclairage public extérieur existant, autoroutier, routier, urbain, dit « fonctionnel »
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="type" id="flexRadioDefault2" value="prive" {{ isset($leads->type) && $leads->type === 'prive' ? 'checked' : '' }}>
                        <label class="form-check-label" for="flexRadioDefault2">
                            Éclairage extérieur privé existant : voiries, parkings, parcs, etc.
                        </label>
                      </div>
                    </div>
            </div>

            <div class="mt-5">
                <h4>
                    ÉQUIPEMENTS À INSTALLER (Merci de renseigner la quantité souhaitée)
                </h4>
            </div>
            <table class="table">
                <thead>
                  <tr>
                    <th scope="col">REFERENCE</th>
                    <th scope="col">EAN</th>
                    <th scope="col">DESIGNATION</th>
                    <th scope="col">RESTE A PAYER HT</th>
                    <th scope="col">QUANTITE</th>
                    <th scope="col">MONTANT TOTAL HT</th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <th scope="row">PR30WMCEE</th>
                    <td>3 700 619 436 142</td>
                    <td>PROJECTEUR MURAL LED 30W - IP65 230V</td>
                    <td>0 euro</td>
                    <td><input type="text" name="PR30WMCEE" value="{{ isset($leads->PR30WMCEE) ? $leads->PR30WMCEE : null }}"></td>
                    <td>0 euro</td>

                  </tr>
                  <tr>
                    <th scope="row">PR50WMCEE</th>
                    <td >3 700 619 436 159</td>
                    <td>PROJECTEUR MURAL LED 50W - IP65 230V</td>
                    <td>0 euro</td>
                    <td><input type="text" name="PR50WMCEE" value="{{ isset($leads->PR50WMCEE) ? $leads->PR50WMCEE : null }}"></td>
                    <td>0 euro</td>

                  </tr>
                  <tr>
                    <th scope="row">PR100WMCEE</th>
                    <td >3 700 619 436 166</td>
                    <td> PROJECTEUR MURAL LED 100W - IP65 230V </td>
                    <td>0 euro</td>
                    <td><input type="text" name="PR100WMCEE" value="{{ isset($leads->PR100WMCEE) ? $leads->PR100WMCEE : null }}"></td>
                    <td>0 euro</td>

                  </tr>
                  <tr>
                    <th scope="row">HUB1600RWBCEE</th>
                    <td>3 700 619 436 609</td>
                    <td> HUBLOT LED FILAIRE 30CM IP65 </td>
                    <td>0 euro</td>
                    <td><input type="text" name="HUB1600RWBCEE" value="{{ isset($leads->HUB1600RWBCEE) ? $leads->HUB1600RWBCEE : null }}"></td>
                    <td>0 euro</td>

                  </tr>
                </tbody>
              </table>

            <button class="mt-5" type="sumbit">valider</button>
        </form>


<div>
    <a href="/lists-lead-per-agent/{{ \Illuminate\Support\Facades\Auth::user()->name }}" class="btn">List Leads</a>
</div>

</body>
</html>


<!--
           <div class="text-center mt-1 mb-1">
                <label for="">tel</label>
                <input type="text" name="tel" class="form-control">
            </div>
            <div class="text-center mt-1 mb-1">
                <label for="">email</label>
                <input type="email" name="email" class="form-control">
            </div>-->
