
$(document).ready(function() {
    $.getScript("https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js", function() {
        //console.log(20202020202020202020);
        $.validator.setDefaults({
            errorPlacement: function (error, element) {
                // Vous pouvez personnaliser l'emplacement des messages d'erreur ici
                error.appendTo(element.parent()); // Placez le message d'erreur près de l'élément parent
            }
        });

        $('#registration_form').validate({
            rules: {
                email: {
                    required: true,
                    email: true,
                },
                name:{
                    required: true,
                },
                password: {
                    required: true,
                },
                register_confirmation:{
                    equalTo: '#password',
                    required:true,
                },
                type:{
                    required: true,
                },
                team:{
                    required: true,
                }
            },
            messages: {
                email: {
                    required: "Ce champ est obligatoire.",
                },
                name:{
                    required: "Ce champ est obligatoire.",
                    email: "exemple@gmail.com"
                },
                password: {
                    required: "Ce champ est obligatoire.",
                },
                register_confirmation:{
                    equalTo: 'Ce champ doit être comme email.',
                    required:"Ce champ est obligatoire.",
                },
                type:{
                    required: "Ce champ est obligatoire.",
                },
                team:{
                    required: "Ce champ est obligatoire.",
                }
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
