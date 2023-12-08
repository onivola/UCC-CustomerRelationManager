$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function enleverAccents(chaine) {
        // Utiliser la méthode JavaScript normalize pour normaliser les caractères
        chaine = chaine.normalize('NFD').replace(/[\u0300-\u036f]/g, '');
        return chaine;
    }
    function trouverCinqChiffresSuccessifs(chaine) {
        // Utiliser une expression régulière pour trouver cinq chiffres successifs dans la chaîne
        var regex = /\d{5}/g;
        var chiffres = chaine.match(regex);
        //console.log(chiffres);
        return chiffres[0];
    }
    function getVilleFromString(str) {
        // Utiliser une expression régulière pour extraire la partie de la chaîne après les 5 premiers chiffres
        const regex = /^\d{5}\s+(.*)$/; // ^\d{5} indique 5 chiffres au début, \s+ correspond à un ou plusieurs espaces, et (.*) correspond à tout le reste
        const match = str.match(regex);

        if (match && match.length >= 2) {
            return match[1];
        } else {
            // Si la chaîne ne correspond pas au format attendu, renvoyer une valeur par défaut ou null
            return null;
        }
    }

    // Exemples d'utilisation de la fonction
    console.log(getVilleFromString("93190 LIVRY-GARGAN")); // Renvoie "LIVRY-GARGAN"
    console.log(getVilleFromString("61250 CONDE SUR SARTHE"));
    var list_link = [];
    var list_postal = [];
    //var monTableau = new Array(5);
    // Effectuer la requête GET vers api.php

    //RECHERCHE RAISON SOCIAL
    $("#btn_rs_search").click(function() {


        if($("#val_rsocial").val()!="") {
            // Le code à exécuter lorsque le bouton est cliqué
            $("#sp_load").show();	//chargement
            $('#dv_results').hide(); //resultat
            //vider les champ
            $('#dv_result_api_search').html(''); //vider l'html
            $("#dv_result_api_siret").html('');
            $("#dv_societe_result").html('');
            $('#val_siret').val('');
            $('#in_addresse').val('');
            $('#val_ville').val('');
            $('#val_address_input').val('');
            $("#btn_rs_search").prop("disabled", true);
            $("#val_rsocial").prop("disabled", true);
            list_link = [];
            list_postal = [];
            var rs = enleverAccents($("#val_rsocial").val());
            $.get("/api-search?raison_social="+rs, function(response) {
                // Réponse reçue de api.php
                // Ajouter le contenu de la réponse dans le div avec l'ID "conteneur"
                //list_link = [];
                //list_postal = [];
                $("#dv_societe_result").append(response);

                // Utilisation du sélecteur descendant
                var resultDivs = $("#result_deno_societe .ResultBloc__link"); //si plusieur resultat
                // Maintenant, `resultDivs` contient tous les éléments <div> ayant la classe .ResultBloc__link
                console.log("123456789--------------------------------------------------");
                console.log("123456789--------------------------------------------------");
                console.log("123456789--------------------------------------------------");
                console.log("123456789--------------------------------------------------");
                console.log(resultDivs.length);
                if(resultDivs.length==0) { //si 1 resultat
                    resultDivs = $("#result_rs_societe .ResultBloc__link");
                }
                //console.log(resultDivs);
                // Parcours des éléments resultDivs
                var html = "";

                resultDivs.each(function(index, element) {
                    var anchorTag = $(this).find('a');

                    // Récupérer la valeur de l'attribut href du balise <a>
                    var hrefValue = "https://www.societe.com" + anchorTag.attr('href');
                    //console.log('Valeur de href : ' + hrefValue);
                    list_link.push(hrefValue);
                    var pcodepostal = $(anchorTag).children().last();
                    //console.log(pcodepostal.text());
                    html =html + "<div><span>"+hrefValue+"</span>"+pcodepostal.text()+"<span></span></div>";
                    list_postal.push(trouverCinqChiffresSuccessifs(pcodepostal.text()));
                    /*var paragraphTags = $(this).find('a p');
                    // Parcourir les balises <p> et afficher leur texte
                    paragraphTags.each(function() {
                        var paragraphText = $(this).text();
                        console.log('Texte de la balise <p> : ' + paragraphText);
                    });*/
                });
                //$('#dv_result_api_search').html(html);
                $("#sp_load").hide();
                if(list_postal.length==0) {
                    $('#dv_results').hide();
                    $('#dv_results_zero').text(list_postal.length+" résultat");
                    $('#dv_results_zero').show();
                }
                if(list_postal.length>0) {
                    $('#dv_results_zero').hide();
                    $('#dv_results').text(list_postal.length+" résultat(s)");
                    $('#dv_results').show();
                }

                //console.log(list_link);
                //console.log(list_postal);
                $("#btn_rs_search").prop("disabled", false);
                $("#val_rsocial").prop("disabled", false);

            });
        }

    });
    /////AUTO COMPLETION
    var fruits = list_postal;
    console.log(fruits);
    function AfficheTout(toeach) {
        var autocompleteItems = $('.autocomplete-items');

        autocompleteItems.empty();

        toeach.forEach(function(item) {
            var div = $('<li></li>')
            .html('<a>'+item+'</a>')
            .appendTo(autocompleteItems);

            div.on('click', function() { //rehefa misafidy code postal
                var itemIndex = $(this).index();
                //alert(list_link[itemIndex]);
                $('#val_address_input').val(item);
                autocompleteItems.empty();
                //POST REQUEST SOCIETE
                var data = {
                    url: list_link[itemIndex]
                };
                $("#sp_load_siret").show(); //chargement
                //vider les champ
                $("#dv_result_api_siret").html('');
                $('#val_siret').val('');
                $('#in_addresse').val('');
                $('#val_ville').val('');
                $("#val_address_input").prop("disabled", true);
                $.post("/api-siret", data, function(response) {
                    // Traitement réussi de la réponse
                    //console.log(response);
                    $("#dv_result_api_siret").append(response);
                    var monDiv = $("#siret_number");

                    // Utilisation de la sélection par descendant pour récupérer le span à l'intérieur du div
                    var siret = monDiv.children("span").text();
                    console.log("123456789--------------------------------------------------");
                    console.log("123456789--------------------------------------------------");
                    console.log("123456789--------------------------------------------------");
                    console.log("123456789--------------------------------------------------");
                    console.log(siret);
                    //alert(siret);
                    var raison_social = $("#identite_deno").text();
                    // Sélectionner le premier <p> à l'intérieur du div
                    var addresse = $("#adressHover p").eq(0).text();

                    // Sélectionner le deuxième <p> à l'intérieur du div
                    var cpostal = $("#adressHover p").eq(1).text();
                    $('#val_siret').val(siret);

                    $('#in_addresse').val(addresse);
                    $('#val_ville').val(getVilleFromString(cpostal));
                    // Maintenant, vous pouvez accéder au contenu des paragraphes ou effectuer des opérations sur ceux-ci
                    console.log(raison_social); // Affiche le contenu du premier <p>
                    console.log(addresse); // Affiche le contenu du premier <p>
                    console.log(cpostal); // Affiche le contenu du deuxième <p>
                    $("#sp_load_siret").hide();
                    $("#val_address_input").prop("disabled", false);
                }).fail(function(error) {
                    // Gérer les erreurs en cas d'échec de la requête
                    console.error(error);
                });

            });
        });

        autocompleteItems.show();
    }
    $('#val_address_input').on('input', function() {
        var inputVal = $(this).val();
        var autocompleteItems = $('.autocomplete-items');

        autocompleteItems.empty();

        if (inputVal.length > 0) { //rehefa misy valeur ny champ
            var matchingItems = list_postal.filter(function(fruit) {
            return fruit.toLowerCase().indexOf(inputVal.toLowerCase()) !== -1;
        });


        AfficheTout(matchingItems);
        autocompleteItems.show();
        } else { //rehefa vide ny champ
            AfficheTout(list_postal); //affichena izy rehetra
        }
    });
    //rehefa clicker ny input de miseo iwy rehetra
    $('#val_address_input').on('click', function() {
        AfficheTout(list_postal);
    });
    //rehefa miclique any ivelany ny sourie dia miala ilay autocompletion
    $(document).on('click', function(e) {
        if (!$(e.target).closest('#autocomplete').length) {
        $('.autocomplete-items').hide();
        }
    });
});



/*$(document).ready(function() {
    //3174d07c-abbf-32e2-a66b-508a0a146d91
    function AfficheTout(fruits) {
        var autocompleteItems = $('.autocomplete-items');

        autocompleteItems.empty();

        fruits.forEach(function(item) {
            var div = $('<li></li>')
            .html('<a>'+item+'</a>')
            .appendTo(autocompleteItems);

            div.on('click', function() {
                var index = fruits.indexOf(item);
                console.log("index :"+index);
                $('input[name="code_postale"]').val(table_codePostalEtablissement[index]);
                $('input[name="ville"]').val(table_libelleCommuneEtablissement[index]);
                $('input[name="Numero_SIRET"]').val(table_siret[index]);
                $('#Adresse_postale').val(table_adressPostalEtablissement[index]);
                autocompleteItems.empty();
            });
        });

        autocompleteItems.show();
    }
    var table_siret = [];
    var table_codePostalEtablissement = [];
    var table_adressPostalEtablissement = [];
    var table_libelleCommuneEtablissement = [];
    //siret,codePostalEtablissement,typeVoieEtablissement,numeroVoieEtablissement,libelleVoieEtablissement,libelleCommuneEtablissement
    $('input[name="Noms_commerciaux"]').on('keyup', function() {

        var raison_social = $('input[name="Noms_commerciaux"]').val();
        table_siret = [];
        table_codePostalEtablissement = [];
        table_adressPostalEtablissement = [];
        table_libelleCommuneEtablissement = [];
        $.ajax({
            url: 'https://api.insee.fr/entreprises/sirene/V3/siret',
            method: 'GET',
            data: {
                q: 'denominationUniteLegale:' + raison_social,
                champs: 'siret,codePostalEtablissement,typeVoieEtablissement,numeroVoieEtablissement,libelleVoieEtablissement,libelleCommuneEtablissement',
                masquerValeursNulles: false
            },
            headers: {
                'Accept': 'application/json',
                'Authorization': 'Bearer e1a74d64-a978-3853-a929-4e369802d11d'
            },
            success: function(response) {
                var etablissements = response.etablissements;
                for (var i = 0; i < etablissements.length; i++) {
                    //console.log(etablissements[i].typeVoieEtablissement);
                    table_siret.push(etablissements[i].siret);
                    table_codePostalEtablissement.push(etablissements[i].adresseEtablissement.codePostalEtablissement);
                    table_adressPostalEtablissement.push(etablissements[i].adresseEtablissement.numeroVoieEtablissement+ ' ' +etablissements[i].adresseEtablissement.typeVoieEtablissement+ ' ' + etablissements[i].adresseEtablissement.libelleVoieEtablissement);
                    table_libelleCommuneEtablissement.push(etablissements[i].adresseEtablissement.libelleCommuneEtablissement);
                }
                if(table_siret.length>0) {
                    $('#spn_result_danger').hide();
                    $('#spn_result_success').show();
                    $('#spn_result_success').text(table_siret.length+" Resultats");
                }
                if(table_siret.length==0) {
                    $('#spn_result_success').hide();
                    $('#spn_result_danger').show();
                    $('#spn_result_danger').text(table_siret.length+" Resultat");
                }
                // Utilisez les tableaux selon vos besoins
                console.log('siret :'+ table_siret.length);
                console.log('codePostalEtablissement :'+table_codePostalEtablissement.length);
                console.log('table_adressPostalEtablissement :'+table_adressPostalEtablissement.length);
                console.log(table_adressPostalEtablissement[1]);
                console.log('libelleCommuneEtablissement :'+table_libelleCommuneEtablissement.length);

                // Appeler une autre fonction et passer les tableaux en tant que paramètres
                //autreFonction(table_siret, table_codePostalEtablissement, table_typeVoieEtablissement, table_numeroVoieEtablissement, table_libelleVoieEtablissement, table_libelleCommuneEtablissement);
            },
            error: function(error) {
                // Gérer l'erreur
                $('#spn_result_success').hide();
                $('#spn_result_danger').show();
                $('#spn_result_danger').text(0+" Resultat");
                table_siret = [];
                table_codePostalEtablissement = [];
                table_adressPostalEtablissement = [];
                table_libelleCommuneEtablissement = [];
            }
        }).done(function() {
            console.log('donedone');
            //alert(1);
             //console.log('siret :'+ table_siret.length);
            var fruits = table_codePostalEtablissement;

            $('#code_postale').on('input', function() {
                var inputVal = $(this).val();
                var autocompleteItems = $('.autocomplete-items');

                autocompleteItems.empty();

                if (inputVal.length > 0) { //rehefa misy valeur ny champ
                    var matchingItems = fruits.filter(function(fruit) {
                    return fruit.toLowerCase().indexOf(inputVal.toLowerCase()) !== -1;
                });

                matchingItems.forEach(function(item) {
                    var div = $('<li></li>')
                    .html('<a>'+item+'</a>')
                    .appendTo(autocompleteItems);

                    div.on('click', function() {
                        var index = fruits.indexOf(item);
                        //console.log("index :"+index);
                        $('input[name="Adresse_postale"]').val(table_adressPostalEtablissement[index]);
                        $('input[name="ville"]').val(table_libelleCommuneEtablissement[index]);
                        $('input[name="Numero_SIRET"]').val(table_siret[index]);
                    $('#code_postale').val(item);
                    autocompleteItems.empty();
                    });
                });

                autocompleteItems.show();
                } else { //rehefa vide ny champ
                    AfficheTout(fruits); //affichena izy rehetra
                }
            });
            //rehefa clicker ny input de miseo iwy rehetra
            $('#code_postale').on('click', function() {
                AfficheTout(fruits);
            });
            //rehefa miclique any ivelany ny sourie dia miala ilay autocompletion
            $(document).on('click', function(e) {
                if (!$(e.target).closest('#autocomplete').length) {
                $('.autocomplete-items').hide();
                }
            });
        });
    });
    $('#code_postale').on('click', function() {
        console.log('donedone');
        //alert(1);
            //console.log('siret :'+ table_siret.length);
        var fruits = table_codePostalEtablissement;

        $('#code_postale').on('input', function() {
            var inputVal = $(this).val();
            var autocompleteItems = $('.autocomplete-items');

            autocompleteItems.empty();

            if (inputVal.length > 0) { //rehefa misy valeur ny champ
                var matchingItems = fruits.filter(function(fruit) {
                return fruit.toLowerCase().indexOf(inputVal.toLowerCase()) !== -1;
            });

            matchingItems.forEach(function(item) {
                var div = $('<li></li>')
                .html('<a>'+item+'</a>')
                .appendTo(autocompleteItems);

                div.on('click', function() {
                    var index = fruits.indexOf(item);
                    //console.log("index :"+index);
                    $('input[name="Adresse_postale"]').val(table_adressPostalEtablissement[index]);
                    $('input[name="ville"]').val(table_libelleCommuneEtablissement[index]);
                    $('input[name="Numero_SIRET"]').val(table_siret[index]);
                $('#code_postale').val(item);
                autocompleteItems.empty();
                });
            });

            autocompleteItems.show();
            } else { //rehefa vide ny champ
                AfficheTout(fruits); //affichena izy rehetra
            }
        });
        //rehefa clicker ny input de miseo iwy rehetra
        $('#code_postale').on('click', function() {
            AfficheTout(fruits);
        });
        //rehefa miclique any ivelany ny sourie dia miala ilay autocompletion
        $(document).on('click', function(e) {
            if (!$(e.target).closest('#autocomplete').length) {
            $('.autocomplete-items').hide();
            }
        });
    });
    $('input[name="Noms_commerciaux"]').on('click', function() {
        $('input[name="Adresse_postale"]').val("");
        $('input[name="code_postale"]').val("");
        $('input[name="ville"]').val("");
        $('input[name="Numero_SIRET"]').val("");
    });
});*/



