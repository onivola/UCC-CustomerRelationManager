<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Merci de votre confiance</title>
    <!-- Inclure jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Inclure Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Inclure Bootstrap 5 JS (Popper.js est nécessaire) -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.10.2/dist/umd/popper.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+YSCBz2F5ViFZwEBPz9z9zLB2FgF1x5r5TIlkQQ5l5P3I1z4" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/popper.js@2.10.2/dist/umd/popper.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+YSCBz2F5ViFZwEBPz9z9zLB2FgF1x5r5TIlkQQ5l5P3I1z4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
</head>
<body style="background-image:url('https://ci4.googleusercontent.com/proxy/2XFd7y03rj0Lqr_kImTiWecMcfvc6FlglLZoHprxSgq2DlL6CDmaFs0DqM0VuWuxDYxKoX3IyAOGalZGm8E9FmWg_PKVWm5MVvvAWul434icOpwCzY3P8ziPnN68q3ZLr_caJWEhRoVnt51C=s0-d-e1-ft#https://ys-storage-public-content-bucket.s3.eu-west-3.amazonaws.com/v3/img/bg-pattern.gif');">
    <div class="modal" tabindex="-1" id="modal-user-signed">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="text-center text-success" style="text-align: center !important;">Tout est signé</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Nous vous remercions de votre confiance. Une copie du contrat <strong class="text-success"> DH ENERGIE</strong> vous a été envoyée par mail.</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        //window.close();
        $(document).ready(function() {
            // Activer la boîte modale dès que la page se charge
            $('#modal-user-signed').modal('show');
            //console.log("1");
            //window.close();
            setTimeout(function() {
                // Votre code JavaScript à exécuter après l'attente de 2 secondes
                //alert("Le code JavaScript s'exécute après 2 secondes.");
                window.close();

            }, 3000);


        });
    </script>

</body>
</html>
