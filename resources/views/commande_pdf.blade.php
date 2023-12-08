<!DOCTYPE html>
<!--[if IE 9]>         <html class="no-js lt-ie10" lang="en"> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">

        <title>ProUI - Responsive Bootstrap Admin Template</title>

        <meta name="description" content="ProUI is a Responsive Bootstrap Admin Template created by pixelcave and published on Themeforest.">
        <meta name="author" content="pixelcave">
        <meta name="robots" content="noindex, nofollow">
        <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0">
        <!-- Stylesheets -->

    </head>
    <body style="font-family: arial; color:#000000eb; font-size: 12px;">

        <div class="block full">
            <!-- Invoice Content -->
            <!-- 2 Column grid -->
			<h1 style="text-align: center; margin: 0;padding: 20px 0;background: #69826b;color: white;">BON DE COMMANDE</h1>
			<table width="100%">
				<tr>
					<td>
						<!-- Company Info -->
						<div class="col-sm-6">
							<h2><strong>ÉTABLISSEMENT À ÉQUIPER</strong></h2>
							<address>
								RAISON SOCIALE : {{ $leads -> Noms_commerciaux  }}<br>
								ADRESSE : {{ $leads -> Adresse_postale }}<br>
								CODE POSTAL : {{ $leads -> code_postale }}<br>
								VILLE : {{ $leads -> ville }}<br>
								SIRET : {{ $leads -> Numero_SIRET }}
							</address>
						</div>
						<!-- END Company Info -->
					</td>
					<td style="text-align: right">
						<!-- Client Info -->
						<div class="col-sm-6 text-right">

							<h2><strong>CONTACT</strong></h2>
							<address>
								NOM : {{ $leads -> name }}<br>
								PRENOM : {{ $leads -> first_name }}<br>
								FONCTION : {{ $leads -> function }}<br>
								Tel : +33 {{ $leads -> phone }} <i class="fa fa-phone"></i><br>
								<a href="javascript:void(0)">{{ $leads -> email }}</a> <i class="fa fa-envelope-o"></i>
							</address>
						</div>
						<!-- END Client Info -->
					</td>
				</tr>
			</table>
			<hr style="color: #0006; margin: 20px 0 27px 0;">
            <!-- END 2 Column grid -->

            <!-- Table -->
            <div class="table-responsive">
                <table id="tb-designation" class="table table-vcenter" style="font-size:12px;">
                    <thead style="background-color: #00000024; border-top: 1px solid black;">
                        <tr>
                            <th></th>
                            <th style="padding: 13px;">REFERENCE</th>
                            <th>EAN</th>
                            <th style="width: 35%;">DESIGNATION</th>
                            <th class="text-center">RESTE A PAYER HT</th>
                            <th class="text-center">QUANTITÉ</th>

                            <th class="text-right">MONTANT TOTAL HT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center">1</td>
                            <td class="text-center">PR30WMCEE</td>
                            <td class="text-center">3 700 619 436 142</td>
                            <td>
                                <h4 style="text-align: center;">PROJECTEUR MURAL LED 30W - IP65 230V</h4>

                            </td>
                            <td class="text-center"><strong>€ 0</strong></td>
                            <td class="text-center"><strong>x <span class="badge">{{ $leads -> PR30WMCEE }}</span></strong></td>

                            <td style="text-align: center;" class="text-right"><span class="label label-primary">€ 0</span></td>
                        </tr>
                        <tr>
                            <td class="text-center">2</td>
                            <td class="text-center">PR50WMCEE</td>
                            <td class="text-center">3 700 619 436 159</td>
                            <td>
                                <h4 style="text-align: center;">PROJECTEUR MURAL LED 50W - IP65 230V </h4>

                            </td>
                            <td class="text-center"><strong>€ 0</strong></td>
                            <td class="text-center"><strong>x <span class="badge">{{ $leads -> PR50WMCEE }}</span></strong></td>

                            <td style="text-align: center;" class="text-right"><span class="label label-primary">€ 0</span></td>
                        </tr>
                        <tr>
                            <td class="text-center">3</td>
                            <td class="text-center">PR100WMCEE</td>
                            <td class="text-center">3 700 619 436 166</td>
                            <td>
                                <h4 style="text-align: center;">PROJECTEUR MURAL LED 100W - IP65 230V</h4>

                            </td>
                            <td class="text-center"><strong>€ 0</strong></td>
                            <td class="text-center"><strong>x <span class="badge">{{ $leads -> PR100WMCEE }}</span></strong></td>

                            <td style="text-align: center;" class="text-right"><span class="label label-primary">€ 0</span></td>
                        </tr>
                        <tr>
                            <td class="text-center">4</td>
                            <td class="text-center">HUB1600RWBCEE</td>
                            <td class="text-center">3 700 619 436 609</td>
                            <td>
                                <h4 style="text-align: center;">HUBLOT LED FILAIRE 30CM IP65</h4>

                            </td>
                            <td class="text-center"><strong>€ 0</strong></td>
                            <td class="text-center"><strong>x <span class="badge">{{ $leads -> HUB1600RWBCEE }}</span></strong></td>

                            <td style="text-align: center;" class="text-right"><span class="label label-primary">€ 0</span></td>
                        </tr>
                        <tr class="active"  style="background-color: #00000024; border-top: 1px solid black;">
                            <td  style="padding: 13px;" colspan="6" class="text-right"><span class="h3"><strong>TOTAL</strong></span></td>
                            <td  style="text-align: center;" class="text-right"><span class="h3"><strong>€ 0</strong></span></td>
                        </tr>
                    </tbody>
                </table>
				<style>
					#tb-designation {
					  border-collapse: collapse;
					}
					#tb-designation tr {
						border-bottom: 1px solid #0006;
					}
				</style>
            </div>
            <!-- END Table -->
            <div>
                <div class="form-group" style="padding-left: 50px; margin: 23px 0 0 0;">
                    <label class="control-label" for="val_siret">L’opération concerne-t-elle bien un éclairage extérieur ?<span class="text-danger">*</span></label>
                    <div style="padding: 10px 0 0 30px;">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline1" name="exterieur" class="custom-control-input" value="oui" {{ (isset($leads->exterieur)) && $leads->exterieur === 'oui'  ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadioInline1">Oui</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline2" name="exterieur" class="custom-control-input" value="non" {{ (isset($leads->exterieur)) && $leads->exterieur === 'non'  ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadioInline2">Non</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="padding-left: 50px;">
                    <label class="control-label" for="val_siret">Veuillez mentionner le type d’éclairage existant :<span class="text-danger">*</span></label>
                    <div style="padding: 10px 0 0 30px;">
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" checked id="customRadioInline3" name="type" class="custom-control-input" value="public"{{ (isset($leads->type)) && $leads->type === 'public'  ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadioInline3">Éclairage public extérieur existant, autoroutier, routier,...</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                            <input type="radio" id="customRadioInline4" name="type" class="custom-control-input" value="prive" {{ (isset($leads->type)) && $leads->type === 'prive'  ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customRadioInline4">Éclairage extérieur privé existant : voiries, parkings,...</label>
                        </div>
                    </div>
                </div>
                <div class="form-group" style="padding-left: 50px;">
                    <div class="control-label" for="val_siret">Je déclare que toutes ces informations sont exactes.</div>
                    <div class="control-label" for="val_siret">Je m'engage à installer les luminaires CEE, dans un délai de 30 jours à réception.</div>
                    <div class="control-label" for="val_siret">Je certifie commander les quantités exactes nécessaires à cette opération.</div>

                </div>
                <div>
                    <table  style="margin: 23px 0 50px 50px;">
                        <tr>
                            <td><strong>Date :</strong></td>
                            @php
                                use Carbon\Carbon;
                                $date = Carbon::now()->format('d-m-Y');
                                echo '<td style="width: 120px; padding: 0 0 0 10px">'.$date.'</td>';
                            @endphp
                            <td><strong>Signature :</strong></td>
                        </tr>
                    </table>
                </div>
            </div>
            <!-- END Invoice Content -->
        </div>
    </body>
    </html>
