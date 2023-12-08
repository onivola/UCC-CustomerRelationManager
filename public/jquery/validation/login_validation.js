$.getScript("https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js", function() {
    $('#id_login').validate({
        rules: {
            name:{
                required:true,
            },
            password:{
                required:true,
            },

        },
        message:{
            name:{
                required:" Veuillez entrer votre pseudo pour continuer",
            },
            password:{
                required:"Veuillez entrer votre mot de passe pour continuer",
            },
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
