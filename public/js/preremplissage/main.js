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
    function checkString(str,motRecherche) {

        // Utilisation de indexOf() pour vérifier si le mot recherché est présent dans la chaîne
        if (str.indexOf(motRecherche) !== -1) {
            return true;
        } else {
            return false;
        }
    }
    function clearHref(str) {

        var debutMot = "url?q=";
        var finMot = ".html";

        // Trouver les positions de début et de fin des mots recherchés
        var debutIndex = str.indexOf(debutMot);
        var finIndex = str.indexOf(finMot, debutIndex + debutMot.length);

        // Extraire la sous-chaîne entre les mots recherchés
        var sousChaine = str.substring(debutIndex + debutMot.length, finIndex);

        return sousChaine+'.html';
    }
    function obtenirAdresseAvantCinqChiffres(chaine) {
        // Trouver l'index des 5 premiers chiffres dans la chaîne
        var indexCinqChiffres = chaine.search(/\d{5}/);

        // Extraire la partie avant les 5 premiers chiffres à l'aide de .slice()
        var adresseAvantCinqChiffres = chaine.slice(0, indexCinqChiffres).trim();

        return adresseAvantCinqChiffres;
    }
    function recupererCinqChiffres(chaine) {
        // Utilisation d'une expression régulière pour rechercher les 5 chiffres consécutifs
        var regex = /\d{5}/;
        var resultat = chaine.match(regex);

        // Vérifier si on a trouvé les 5 chiffres
        if (resultat && resultat.length > 0) {
            return resultat[0]; // Renvoie les 5 chiffres trouvés
        } else {
            return null; // Renvoie null si les 5 chiffres n'ont pas été trouvés
        }
    }
    function recupererDernierApresCinqChiffres(chaine) {
        // Utilisation d'une expression régulière pour rechercher les 5 chiffres consécutifs
        var regex = /\d{5}/;
        var resultat = chaine.match(regex);

        // Vérifier si on a trouvé les 5 chiffres
        if (resultat && resultat.length > 0) {
            // Trouver l'index du début du dernier groupe de caractères après les 5 chiffres
            var indexDebut = chaine.lastIndexOf(resultat[0]) + resultat[0].length;

            // Extraire le dernier groupe de caractères après les 5 chiffres
            var dernierApresCinqChiffres = chaine.slice(indexDebut).trim();

            return dernierApresCinqChiffres;
        } else {
            return null; // Renvoie null si les 5 chiffres n'ont pas été trouvés
        }
    }
    // Exemples d'utilisation de la fonction
    
    var list_link = [];
    var list_postal = [];
    //PROGRAMMABLE GOOGLE SEARCH
    window.addEventListener('load', function () {
        $("#___gcse_0").bind("click", function (event) { //desactiver les redirections
            event.preventDefault();
            console.log(event.target.tagName);
            var societe_href = ''
            if (event.target.tagName === 'A') {
                event.preventDefault(); // Empêche la navigation vers le lien
                
                // Récupère la valeur de l'attribut href du lien <a>
                var hrefValue = event.target.getAttribute('data-ctorig');
                societe_href =hrefValue;
                // Utilisez la variable hrefValue comme bon vous semble
                
              }
              if (event.target.tagName === 'B') {
                event.preventDefault(); // Empêche la navigation vers le lien <a>
                
                // Récupère l'élément parent <a> de l'élément <b> actuel
                var parentAnchor = event.target.closest('a');
                
                if (parentAnchor) {
                  // Récupère la valeur de l'attribut href de l'élément parent <a>
                  var hrefValue = parentAnchor.getAttribute('data-ctorig');
                  societe_href=hrefValue;
                }
              }
              if(societe_href!='') { //scrap societe
                  console.log('La valeur de href est : ' + societe_href);
                    // Votre logique pour l'événement click ici
                    var link = $('.dvresult').find('.in_societe');
                    var issociete = $('.dvresult').find('.in_issociete').val();
                    
                    console.log(link.val());

                    //POST REQUEST SOCIETE
                    var data = {
                        url: societe_href
                    };
                    console.log(data);
                    $("#___gcse_0").css("pointer-events", "none");
                    
                    $("#sp_load_siret").show(); //chargement
                    //vider les champ
                    $("#dv_result_api_siret").html('');
                    $('#val_rsocial').val('');
                    $('#val_siret').val('');
                    $('#in_addresse').val('');
                    $('#val_ville').val('');
                    $('#val_address_input').val('');
                    //$("#val_address_input").prop("disabled", true);
                    $('#dv_statut').html('');
                    $.post("/api-siret", data, function(response) {
                        // Traitement réussi de la réponse
                        //console.log(response);
                        $("#dv_result_api_siret").append(response);
                        
                        var isin =  checkString(societe_href,'https://www.societe.com/societe/');
                        var isinetab =  checkString(societe_href,'https://www.societe.com/etablissement/');
                        console.log(isin);
                        var issociete = 1;
                        if(isinetab) {
                            issociete=0;
                        }
                        //alert(12);
                        if(issociete==1) { //societe
                            var monDiv = $("#siret_number");

                            // Utilisation de la sélection par descendant pour récupérer le span à l'intérieur du div
                            var siret = monDiv.children("span").text();
                            
                            //alert(siret);
                            var raison_social = $("#identite_deno").text();
                            //alert(raison_social);
                            //chili 65120

                            var fullAddresse = $("#rensjur").find('.Lien.secondaire').text();
                            //alert(fullAddresse);
                            var Addresse = obtenirAdresseAvantCinqChiffres(fullAddresse)
                            //alert(Addresse);
                            var CodePostal = recupererCinqChiffres(fullAddresse);
                            //alert(CodePostal);
                            var Ville = recupererDernierApresCinqChiffres(fullAddresse);

                            
                            if ($('.soChip.small.positive.responsive').length > 0) {
                                // L'élément #dv_test existe, vous pouvez effectuer des opérations ici
                                $('#dv_statut').html('<span class="text-success">Active</span>');
                            } else if ($('.soChip.error.small.responsive').length > 0) {
                                // L'élément #dv_test existe, vous pouvez effectuer des opérations ici
                                $('#dv_statut').html('<span class="text-danger">Fermée définitivement</span>');
                            }
                            //alert(Ville);
                        } else { //etablissement
                            // Utilisation de la sélection par descendant pour récupérer le span à l'intérieur du div
                            var siret = $('#identite-siret').attr('data-siret');
                            
                            //alert(siret);
                            var raison_social = $("#identite_deno").text();
                            //alert(raison_social);
                            //chili 65120

                            var fullAddresse = $("#etab").find('.Lien.secondaire').text();
                            //alert(fullAddresse);
                            var Addresse = obtenirAdresseAvantCinqChiffres(fullAddresse)
                            //alert(Addresse);
                            var CodePostal = recupererCinqChiffres(fullAddresse);
                            //alert(CodePostal);
                            var Ville = recupererDernierApresCinqChiffres(fullAddresse);
                            if ($("#etab").find('.soSecondaryColor5').length > 0) {
                                // L'élément #dv_test existe, vous pouvez effectuer des opérations ici
                                $('#dv_statut').html('<i class="fa fa-circle text-danger i_active" aria-hidden="true"></i><span class="text-danger">'+$("#etab").find('.soSecondaryColor5').text()+' définitivement</span>');
                            }
                        }
                        //alert(raison_social);
                        $('#val_rsocial').val(raison_social);
                        $('#val_siret').val(siret);
                        
                        $('#in_addresse').val(Addresse);
                        $('#val_ville').val(Ville);
                        // Maintenant, vous pouvez accéder au contenu des paragraphes ou effectuer des opérations sur ceux-ci
                        //console.log(raison_social); // Affiche le contenu du premier <p>
                        //console.log(addresse); // Affiche le contenu du premier <p>
                        //console.log(cpostal); // Affiche le contenu du deuxième <p>
                        
                        //var code = cpostal.slice(0, 5);
                        
                        $('#val_address_input').val(CodePostal);
                        //alert(code);
                        $("#sp_load_siret").hide();
                        //$("#val_address_input").prop("disabled", false);
                        $("#___gcse_0").css("pointer-events", 'auto');
                        
                    }).fail(function(error) {
                        // Gérer les erreurs en cas d'échec de la requête
                        console.error(error);
                    });
              }
          });
         $('a.gs-title').on('click', function() {
            //alert($(this).attr('href'));
        });
    });
    //PROGRAMMABLE GOOGLE SEARCH

    //var monTableau = new Array(5);
    // Effectuer la requête GET vers api.php

    //RECHERCHE RAISON SOCIAL
    /*$("#btn_rs_search").click(function() {
        // Le code à exécuter lorsque le bouton est cliqué

        $('#dv_results').hide(); //resultat
        //vider les champ
        $('#dv_result_api_search').html(''); //vider l'html
        $("#dv_result_api_siret").html('');
        $("#dv_societe_result").html('');
        $("#dv_res_google").html('');
        $('#val_siret').val('');
        $('#in_addresse').val('');
        $('#val_ville').val('');
        $('#val_address_input').val('');
        $('#dv_statut').html('');
        list_link = [];
        list_postal = [];
        var html = "";
        if($("#val_rsocial").val()!="") {
            $("#sp_load").show();	//chargement
            $("#dv_res_google").hide();

            $("#val_rsocial").prop("disabled", true);
            $("#btn_rs_search").prop("disabled", true);
            var rs = enleverAccents($("#val_rsocial").val());
            $.get("/gle-search?raison_social="+rs, function(response) {

                $("#dv_societe_result").append(response);
                $('#dv_societe_result>style').remove();
                $("#sp_load").hide();

                resultDivsTitre = $("#main .vvjwJb:not(:hidden)");
                resultDivsLien = $("#main .UPmit:not(:hidden)");
                resultDivsParagraphe = $("#main .s3v9rd .s3v9rd:not(:hidden)");
                

                resultDivRow = $('.Gx5Zad.fP1Qef.xpd.EtOod.pkphOe');
                resultDivAlink = $('.egMi0.kCrYT a');
                console.log(555555555555555555555555555555);
                console.log(resultDivRow);
                console.log(555555555555555555555555555555);
                console.log(resultDivAlink);
                resultDivRow.each(function(index, element) {
                    var anchorTag = $(this).find('a');

                    var isin =  checkString($(this).find('a')[0].href,'https://www.societe.com/societe/');
                    var isinetab =  checkString($(this).find('a')[0].href,'https://www.societe.com/etablissement/');
                    console.log(isin);
                    if(isin || isinetab) {
                        var clrHref = clearHref($(this).find('a')[0].href);
                        //console.log(clrHref);
                        $(this).find('a').attr("href", clrHref);
                        list_link.push(clrHref);
                        var issociete = 1;
                        if(isinetab) {
                            issociete=0;
                        }
                        //html = html+$(this).html();
                        $(this).find('a').replaceWith(function() {
                            return '<div class="dvresult">' + $(this).html() + '<input class="in_societe" type="hidden" value="'+clrHref+'"/><input class="in_issociete" type="hidden" value="'+issociete+'"/></div>';
                        });
                        $('#dv_res_google').append($(this));
                        //appendTo($('#dv_res_google'));
                    }
                    //console.log($(this).find('a'));
                    //console.log($(this).find('a')[0].href);
                    //apres click d'un resultat

                });

                $("#dv_res_google").show();
                $("#val_rsocial").prop("disabled", false);
                $("#btn_rs_search").prop("disabled", false);
                $('.dvresult').on('click', function() {
                    // Votre logique pour l'événement click ici
                    $("#dv_res_google").addClass('noevent');
                    //var link = $(this).find('input');
                    var link = $(this).find('.in_societe');
					var issociete = $(this).find('.in_issociete').val();
                    console.log(link.val());

                    //POST REQUEST SOCIETE
                    var data = {
                        url: link.val()
                    };
                    console.log(data);
                    $("#sp_load_siret").show(); //chargement
                    //vider les champ
                    $("#dv_result_api_siret").html('');
                    $('#val_siret').val('');
                    $('#in_addresse').val('');
                    $('#val_ville').val('');
                    $('#val_address_input').val('');
                    $('#dv_statut').html('');
                    //$("#val_address_input").prop("disabled", true);
                    $.post("/api-siret", data, function(response) {
                        // Traitement réussi de la réponse
                        //console.log(response);
                        $("#dv_result_api_siret").append(response);

                        if(issociete==1) { //societe
                            var monDiv = $("#siret_number");

                            // Utilisation de la sélection par descendant pour récupérer le span à l'intérieur du div
                            var siret = monDiv.children("span").text();

                            //alert(siret);
                            var raison_social = $("#identite_deno").text();
                            //alert(raison_social);
                            //chili 65120

                            var fullAddresse = $("#rensjur").find('.Lien.secondaire').text();
                            //alert(fullAddresse);
                            var Addresse = obtenirAdresseAvantCinqChiffres(fullAddresse)
                            //alert(Addresse);
                            var CodePostal = recupererCinqChiffres(fullAddresse);
                            //alert(CodePostal);
                            var Ville = recupererDernierApresCinqChiffres(fullAddresse);

                            if ($('.sirenStatus.active').length > 0) {
                                // L'élément #dv_test existe, vous pouvez effectuer des opérations ici
                                $('#dv_statut').html('<i class="fa fa-circle text-success i_active" aria-hidden="true"></i><span class="text-success">Active</span>');
                            } else if ($('.sirenStatus.inactive').length > 0) {
                                // L'élément #dv_test existe, vous pouvez effectuer des opérations ici
                                $('#dv_statut').html('<i class="fa fa-circle text-danger i_active" aria-hidden="true"></i><span class="text-danger">Fermée définitivement</span>');
                            }
                            //alert(Ville);
                        } else { //etablissement
                            // Utilisation de la sélection par descendant pour récupérer le span à l'intérieur du div
                            var siret = $('#identite-siret').attr('data-siret');

                            //alert(siret);
                            var raison_social = $("#identite_deno").text();
                            //alert(raison_social);
                            //chili 65120

                            var fullAddresse = $("#etab").find('.Lien.secondaire').text();
                            //alert(fullAddresse);
                            var Addresse = obtenirAdresseAvantCinqChiffres(fullAddresse)
                            //alert(Addresse);
                            var CodePostal = recupererCinqChiffres(fullAddresse);
                            //alert(CodePostal);
                            var Ville = recupererDernierApresCinqChiffres(fullAddresse);
                            if ($("#etab").find('.soSecondaryColor5').length > 0) {
                                // L'élément #dv_test existe, vous pouvez effectuer des opérations ici
                                $('#dv_statut').html('<i class="fa fa-circle text-danger i_active" aria-hidden="true"></i><span class="text-danger">'+$("#etab").find('.soSecondaryColor5').text()+' définitivement</span>');
                            }
                        }
                        //alert(raison_social);
                        $('#val_rsocial').val(raison_social);
                        $('#val_siret').val(siret);

                        $('#in_addresse').val(Addresse);
                        $('#val_ville').val(Ville);

                        $('#val_address_input').val(CodePostal);
                        //alert(code);
                        $("#sp_load_siret").hide();
                        //$("#val_address_input").prop("disabled", false);
                        $("#dv_res_google").removeClass('noevent');

                    }).fail(function(error) {
                        // Gérer les erreurs en cas d'échec de la requête
                        console.error(error);
                    });
                });
            });
        }

    });*/

});
