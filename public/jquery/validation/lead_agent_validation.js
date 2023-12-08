console.log(202);
$.getScript("https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js", function() {
    $('#agent_form').validate({
        rules: {
            Noms_commerciaux:{
                required:true,
            },
            Adresse_postale:{
                required:true,
            },
            code_postale:{
                required:true,
            },
            Numero_SIRET:{
                required:true,
            },
            ville:{
                required:true,
            },
            name:{
                required:true,
            },
            first_name:{
                required:true,
            },
            function:{
                required:true,
            },
            phone:{
                required:true,
            },
            email:{
                required:true,
            },
            PR30WMCEE:{
                required:true,
                digits:true,
            },
            PR50WMCEE:{
                required:true,
                digits:true,
            },
            PR100WMCEE:{
                required:true,
                digits:true,
            },
            HUB1600RWBCEE:{
                required:true,
                digits:true,
            },
            exterieur:{
                required:true,
            },
            type:{
                required:true,
            }
        },
        message:{
            Noms_commerciaux:{
                required:"",
            },
            Adresse_postale:{
                required:"",
            },
            code_postale:{
                required:"",
            },
            Numero_SIRET:{
                required:"",
            },
            ville:{
                required:"",
            },
            name:{
                required:"",
            },
            first_name:{
                required:"",
            },
            function:{
                required:"",
            },
            phone:{
                required:"",
            },
            email:{
                required:"",
            },
            PR30WMCEE:{
                required:"",
                digits: "Veuillez entrer une valeur entière valide",
            },
            PR50WMCEE:{
                required:"",
                digits: "Veuillez entrer une valeur entière valide",
            },
            PR100WMCEE:{
                required:"",
                digits: "Veuillez entrer une valeur entière valide",
            },
            HUB1600RWBCEE:{
                required:"",
                digits: "Veuillez entrer une valeur entière valide",
            },
            exterieur:{
                required:"",
            },
            type:{
                required:"",
            }
        },
        errorElement: 'small',
        errorPlacement: function(error, element) {
            // Empêcher l'affichage des messages d'erreur
            return true;
        },
        highlight: function(element) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element) {
            $(element).removeClass('is-invalid');
            $(element).addClass('is-valid');
        },
        submitHandler: function(form) {
            form.submit();
        }
});
});
