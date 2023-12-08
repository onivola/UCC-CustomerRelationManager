
<!DOCTYPE html>
<html lang="fr" style="height: 87%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bonde de commande</title>
    <!-- Stylesheets -->
        <!-- Bootstrap is included in its original form, unaltered -->
        <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

        <!-- Related styles of various icon packs and plugins -->
        <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">

        <!-- The main stylesheet of this template. All Bootstrap overwrites are defined in here -->
        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

        <!-- Include a specific file here from css/themes/ folder to alter the default theme of the template -->

        <!-- The themes stylesheet of this template (for using specific theme color in individual elements - must included last) -->
        <link rel="stylesheet" href="{{ asset('css/themes.css') }}">
        <!-- END Stylesheets -->
		<script src="{{ asset('js/vendor/modernizr.min.js') }}"></script>
</head>
<style>
	#pdf-container {
		text-align:center;
		background-color: #00000008;
	}
	.dv_signer {
		text-align: center;
		background: white;
		padding: 25px 0;
		border-top: 2px solid #1bbae1;
	}
</style>
@php
    //dd($contrat);
@endphp
<body style="background-color: white !important; height: 100%; ">
    <div id="pdf-container" style="height: 100%;">
        <!--- remember to add the PDF here  --->
        <!--<embed src="https://crm-ucc.online/crm/public/storage/documents/{{ $contrat->Numero_SIRET }}.pdf" alt="PDF" width="1000" height="555" type="application/pdf">-->
        <!--<object data="mypdf.pdf" type="application/pdf" frameborder="0" width="100%" height="600px" style="padding: 20px;">
			<embed src="https://crm-ucc.online/crm/public/storage/documents/{{ $contrat->Numero_SIRET }}.pdf" width="1000" height="555"/> 
		</object>--->
		<iframe src="https://docs.google.com/viewer?url=https://crm-ucc.online/crm/public/storage/documents/{{ $contrat->Numero_SIRET }}.pdf&embedded=true" style="width:80%; height:100%;" frameborder="0"></iframe>

	</div>
	<div id="dv_issigner">
		<div id="dv_non_signer" style="display:none;" class="dv_signer">
			<button type="button" onclick="$('#modal-user-signer').modal('show');" class="btn btn-sm btn-primary">Signer</button>
		</div>
		<div id="dv_signer" style="display:none;" class="dv_signer">
			<i class="fa fa-check fa-2x text-success"></i>
			<div style="display: inline-block; vertical-align: top; margin: 5px 8px 0 11px;">Terminer</div>
			<a id="telecharger-pdf" style=" vertical-align: top;"  href="https://crm-ucc.online/crm/public/storage/documents/{{ $contrat->Numero_SIRET }}.pdf" class="btn btn-sm btn-primary">Télécharger le document</a>
		</div>
	</div>
	
	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		var siret = @json($contrat->Numero_SIRET);
		function appelAjax() {
			$.ajax({
				url: '/check-signature/'+ siret,
				type: 'GET',
				dataType: 'json',
				success: function(data) {
					console.log('Résultat de la requête AJAX :', data);
					if(data==0) { //nonn signer
						console.log('non signer');
						$("#dv_signer").hide();
						$("#dv_non_signer").show();
					} else if(data==1) { //signer
						console.log('signer');
						$("#dv_non_signer").hide();
						$("#dv_signer").show();

					}
				},
				error: function(xhr, status, error) {
					console.error('Erreur AJAX :', error);
				}
			});
		}

		// Appelez la fonction AJAX toutes les 3000 secondes (5 minutes)
		setInterval(appelAjax, 3000); // 300000 ms = 300 secondes = 5 minutes
	</script>
    


	<script src="{{ asset('js/vendor/jquery.min.js') }}"></script>
	<script src="{{ asset('js/vendor/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/plugins.js') }}"></script>
	<script src="{{ asset('js/app.js') }}"></script>
	<!-- User Settings, modal which opens from Settings link (found in top right user menu) and the Cog link (found in sidebar user info) -->
	<div id="modal-user-signer" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<!-- Modal Header -->
				<div class="modal-header text-center">
					<h2 class="modal-title"><i class="fa fa-pencil"></i> Il ne vous reste plus qu'à signer !</h2>
				</div>
				<!-- END Modal Header -->

				<!-- Modal Body -->
				<div class="modal-body">
					<form action="/check_signature" method="post" enctype="multipart/form-data" class="form-horizontal form-bordered" id="signatureForm">
						@csrf
                        <fieldset>
							<div style="padding: 35px 23px;" class="form-group">
								<label id="lb" style="margin: 0 0 23px 0;"  class="control-label" for="signature">Voici la signature qui apparaîtra sur le document :</label>
								<div class="">
									<input type="text" id="inputText" name="signature" class="form-control" placeholder="" value="{{ $contrat->first_name }} {{ $contrat->name }}">
								</div>
								<div id="outputText"></div>
							</div>
						</fieldset>
                        <input type="text" hidden name="id_lead" value="{{ $contrat->id }}">
                        <input type="text" hidden name="Numero_SIRET" value="{{ $contrat->Numero_SIRET }}">
                        <input type="text" hidden name="email" value="{{ $contrat->email }}">
						<div class="form-group form-actions">
							<div class="col-xs-12 text-right">
								<button type="submit" class="btn btn-sm btn-primary">Signer</button>
							</div>
						</div>
					</form>
                    <script>
                        $(document).ready(function() {
                            // Validation jQuery pour le champ requis
                            $("#signatureForm").submit(function(event) {
                                var inputTextValue = $("#inputText").val();
                                if (inputTextValue.trim() === "") {
                                    // Annule la soumission du formulaire si le champ est vide
                                    event.preventDefault();
                                    alert("Le champ de signature est requis.");
                                }
                            });
                        });
                    </script>
				</div>
				<!-- END Modal Body -->
				<style>
					@font-face {
						font-family: signature;
						src: url({{ asset('css/signature.ttf') }});
					}

					#inputText {
						width: 100%;
						padding: 10px;
						font-size: 16px;
						margin-bottom: 10px;
					}

					#outputText {
						font-size: 30px;
						text-align: center;
						font-family: signature;
						margin: 57px 0 0 0;
						color: #1bbae1;
					}

				</style>
				<script>
					$(document).ready(function () {
						var initialText = $('#inputText').val();
						if (initialText) {
							$('#outputText').text(initialText);
						}
						$('#inputText').on('input', function () {
							var userInput = $(this).val();
							$('#outputText').text(userInput);
						});
					});
				</script>
			</div>
		</div>
	</div>
	<!-- END User Settings -->
</body>

</html>
