$(document).ready(function() {
    $.getScript("https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js", function() {
        //console.log(20202020202020202020);
        $.validator.setDefaults({
            errorPlacement: function (error, element) {
                // Vous pouvez personnaliser l'emplacement des messages d'erreur ici
                error.appendTo(element.parent()); // Placez le message d'erreur près de l'élément parent
            }
        });

        $('#create_team').validate({
            rules: {
                team: {
                    required: true,
                },

            },
            messages: {
                team: {
                    required: "Ce champ est obligatoire.",
                },

            },
            highlight: function(element) {
                $(element).addClass('is-invalid').removeClass('is-valid');
            },
            unhighlight: function(element) {
                $(element).removeClass('is-invalid').addClass('is-valid');
            },
            submitHandler: function(form) {
                form.submit();
            }
        });

    });

});
