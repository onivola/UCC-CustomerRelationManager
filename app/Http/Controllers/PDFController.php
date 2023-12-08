<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\CrmModel;
use App\Models\DevisModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
require_once('Pdf/fpdf/fpdf.php');
require_once('Pdf/FPDI-2.4.1/src/autoload.php');

class PDFController extends Controller
{

    private function Initialisation($pdf) {

        // Set the source file
        $pdf->setSourceFile('bdc.pdf');

        // Get the number of pages in the source PDF
        $numPages = $pdf->setSourceFile('bdc.pdf');

        // Define the dimensions of an A4 page
        $a4Width = 210;
        $a4Height = 297;

        // Loop through each page and import it into the output PDF
        for ($pageNo = 1; $pageNo <= $numPages; $pageNo++) {
            $templateId = $pdf->importPage($pageNo);

            // Add a new page with A4 dimensions
            $pdf->AddPage('P', array($a4Width, $a4Height));

            // Use the imported page and scale it to fill the A4 page
            $pdf->useTemplate($templateId, 0, 0, $a4Width, $a4Height);
        }
    }
    private function drawCross($pdf, $crossSize, $crossX, $crossY)
    {
        $pdf->SetLineWidth(0.5);
        $pdf->Line(
            $crossX - $crossSize,
            $crossY - $crossSize,
            $crossX + $crossSize,
            $crossY + $crossSize
        );
        $pdf->Line(
            $crossX - $crossSize,
            $crossY + $crossSize,
            $crossX + $crossSize,
            $crossY - $crossSize
        );
    }
    private function drawSquare($pdf, $squareSize, $squareX, $squareY)
    {
        $pdf->SetLineWidth(0.5);
        $pdf->Rect($squareX - $squareSize / 2, $squareY - $squareSize / 2, $squareSize, $squareSize, 'D');
    }
    ////CROISS XXXXXXX
    private function OuiEclEctern($pdf) {
        $crossX = 92; // Position X au centre de la page
        $crossY = 50; // Position Y au centre de la page
        // Taille de la croix en points (ajustez selon vos besoins)
        $crossSize = 2;
        $this->drawCross($pdf, $crossSize, $crossX, $crossY);
    }
    private function NonEclEctern($pdf) {
        $crossX = 109; // Position X au centre de la page
        $crossY = 50; // Position Y au centre de la page
        // Taille de la croix en points (ajustez selon vos besoins)
        $crossSize = 2;
        $this->drawCross($pdf, $crossSize, $crossX, $crossY);
    }

    private function PublicExtern($pdf) {
        $crossX = 20; // Position X au centre de la page
        $crossY = 67; // Position Y au centre de la page
        // Taille de la croix en points (ajustez selon vos besoins)
        $crossSize = 2;
        $this->drawCross($pdf, $crossSize, $crossX, $crossY);
    }
    private function PrivateExtern($pdf) {
        $crossX = 20; // Position X au centre de la page
        $crossY = 73; // Position Y au centre de la page
        // Taille de la croix en points (ajustez selon vos besoins)
        $crossSize = 2;
        $this->drawCross($pdf, $crossSize, $crossX, $crossY);
    }
    ///////////TEXT///////////
    private function RaisonSocial($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(36, 101);
        $pdf->Write(0, $text);
    }
    private function Adresse($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(25, 109);
        $pdf->Write(0, $text);
    }
    private function CodePostal($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(32, 116);
        $pdf->Write(0, $text);
    }
    private function Ville($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(20, 124);
        $pdf->Write(0, $text);
    }
    private function Siret($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(20, 131);
        $pdf->Write(0, $text);
    }
    private function Nom($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(130, 101);
        //$pdf->Write(0, $text);
        // Spécifiez la largeur de la cellule (largeur maximale du texte sur une ligne)
        $largeurCellule = 60; // Par exemple, 60 mm

        // Utilisez Cell pour afficher le texte avec coupure automatique
        $pdf->Cell($largeurCellule, 0, $text, 0, 0, 'L');
    }
    private function Prenom($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(135, 109);
        //$pdf->Write(0, $text);
        // Spécifiez la largeur de la cellule (largeur maximale du texte sur une ligne)
        $largeurCellule = 60; // Par exemple, 60 mm

        // Utilisez Cell pour afficher le texte avec coupure automatique
        $pdf->Cell($largeurCellule, 0, $text, 0, 0, 'L');
    }
    private function Fonction($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(137, 116);
        //$pdf->Write(0, $text);
        // Spécifiez la largeur de la cellule (largeur maximale du texte sur une ligne)
        $largeurCellule = 60; // Par exemple, 60 mm

        // Utilisez Cell pour afficher le texte avec coupure automatique
        $pdf->Cell($largeurCellule, 0, $text, 0, 0, 'L');
    }
    private function Telephone($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(139, 124);
        $pdf->Write(0, $text);
    }
    private function EmailPos($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(132, 129);
        //$pdf->Write(0, $text);
        $largeurCellule = 60; // Par exemple, 60 mm
         // Utilisez MultiCell pour afficher le texte avec un saut de ligne automatique
        $pdf->MultiCell($largeurCellule, 4, $text);
    }
    //QUANTITE//
    private function QuantiteA($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(165, 166);
        $pdf->Write(0, $text);
    }
    private function QuantiteB($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(165, 174);
        $pdf->Write(0, $text);
    }
    private function QuantiteC($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(165, 183);
        $pdf->Write(0, $text);
    }
    private function QuantiteD($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(165, 191);
        $pdf->Write(0, $text);
    }
    private function DateSignature($pdf,$text) {
        $pdf->SetFont('Helvetica');
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetXY(32, 232);
        $pdf->Write(0, $text);
    }

    public function test(){
        $pdf = new \setasign\Fpdi\Fpdi();
        $this-> Initialisation($pdf);
        dd(8202);
    }
    public function generatePDF_voir($id) {
        $leads = CrmModel::find($id);
        //dd($leads);
        $nom = $leads->name;
        $prenom = $leads->first_name;
        $email = $leads->email;
        $phone_number = $leads->phone;
        $id = $leads->id;

        //$date = Carbon::now()->format('d-m-Y');
        //$this->DateSignature($pdf,$date);

        $this->devipdf($id);

        $fileName = "devis".$leads->Numero_SIRET.".pdf";
        $pdfDocumentPath = public_path("storage/documents/");
        //dd($fileName);

        try {
            // Appel de la fonction pour envoyer le document
            $sendbox = $this->sendDocument($pdfDocumentPath, $fileName, $nom, $prenom, $email, $phone_number, $id);
            //dd($sendbox);
            // Vérification du résultat de l'envoi
            if ($sendbox == 0) {
                return redirect()->back()->with('nonEnvoyer', 'Recontactez le prospect, certaines informations sont incorrectes.');
            } else {
                // Le document a été envoyé avec succès
                $this->devis_signature($id,$sendbox);
                return redirect()->back()->with('Envoyer', 'Email envoyé !');
            }
        } catch (\Exception $e) {
            // Gérer les exceptions liées à la connexion ou aux délais d'expiration ici
            return redirect()->back()->with('error', "Une erreur s'est produite lors de l'envoi du document : " . $e->getMessage());
        }

    }
    public function generatePDF_voir2($id) {
        $leads = CrmModel::find($id);

        // Configuration de DomPDF
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        // Initialise DomPDF
        $dompdf = new Dompdf($options);

        // Charger la vue dans une variable
        $view = view('commande_pdf', compact('leads'))->render();

        // Charger le contenu HTML dans DomPDF
        $dompdf->loadHtml($view);

        // Choisir le format du papier (A4 par exemple)
        $dompdf->setPaper('A4', 'portrait');

        // Rendre le PDF
        $dompdf->render();

        // Enregistrer le PDF sur le serveur
        $pdfDocumentPath = public_path("storage/documents/");
        $fileName = $leads->Numero_SIRET . ".pdf";
        $pdfFilePath = $pdfDocumentPath . $fileName;
        $OK = file_put_contents($pdfFilePath, $dompdf->output());

        $nom = $leads->name;
        $prenom = $leads->first_name;
        $email = $leads->email;
        $phone_number = $leads->phone;
        //dd($OK);
        try {

            $sendbox = $this->sendDocument($pdfDocumentPath, $fileName, $nom, $prenom, $email, $phone_number,$id);
            //dd($sendbox);
            if ($sendbox == 0) {

                return redirect()->back()->with('nonEnvoyer', 'Reappeler le prospect, il y a des informations fausses!');
            } else {
                //$this->updateFixe($id,$sendbox);
                return redirect()->back()->with('Envoyer', 'mail envoyé!');
            }
        } catch (\Exception $e) {
            // Gérer l'exception de connexion ou de délai d'expiration ici
            return redirect()->back()->with('error', "Une erreur s'est produite lors de l'envoi du document.");
        }
    }

    private function sendDocument($pdfDocumentPath, $fileName, $nom, $prenom, $email, $phone_number, $id)
    {
        // Définition de l'URL de base et de la clé d'API
        $baseUrl = 'https://api.yousign.app/v3';
        $apiKey = 'rAaS2nEDNNvLX1Z1KAz3bQ13AqNpgEyq'; // Assurez-vous de remplacer par votre propre clé API

        try {
            // Étape 1 - Créer une demande de signature
            $requestCreateData = [
                "name" => "AR PARTNERS PROD",
                "delivery_mode" => "email",
                "timezone" => "Europe/Paris"
            ];

            $initiateSignatureRequestResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json'
            ])->post($baseUrl . '/signature_requests', $requestCreateData);

            $signatureRequest = $initiateSignatureRequestResponse->json();
            $signatureRequestId = $signatureRequest['id'];

            // Mettre à jour la base de données avec l'ID de la demande de signature
            $this->updateFixe($id, $signatureRequestId);

            // Étape 2 - Ajouter un document à la demande de signature
            $documentUploadResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])->attach(
                'file',
                file_get_contents($pdfDocumentPath . $fileName),
                "document.pdf"
            )->post($baseUrl . '/signature_requests/' . $signatureRequestId . '/documents', [
                'nature' => 'signable_document',
                'parse_anchors' => 'true'
            ]);
            $document = $documentUploadResponse->json();
            $documentId = $document['id'];


            // Étape 3 - Ajouter un signataire à la demande de signature
            $signerData = [
                "info" => [
                    "first_name" => $prenom,
                    "last_name" => $nom,
                    "email" => $email,
                    "phone_number" => "+33" . $phone_number,
                    "locale" => "fr"
                ],
                "signature_authentication_mode" => "no_otp",
                "signature_level" => "electronic_signature",
                "fields" => [
                    [
                        "document_id" => $documentId,
                        "type" => "signature",
                        "height" => 82,
                        "width" => 123 ,
                        "page" => 2,
                        "x" => 92,
                        "y" => 696
                    ]
                ]
            ];
            $addSignerResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json'
            ])->post($baseUrl . '/signature_requests/' . $signatureRequestId . '/signers', $signerData)->json();


            // Étape 4 - Activer la demande de signature
            $activateSignatureRequestResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json'
            ])->post($baseUrl . '/signature_requests/' . $signatureRequestId . '/activate');

            // Vérifier si l'ajout du signataire a réussi
            if (isset($addSignerResponse["id"])) {
                // Retourner 1 pour indiquer que l'envoi a réussi
                return $addSignerResponse["id"];
            } else {
                // Retourner 0 en cas d'échec
                return 0;
            }
        } catch (\Exception $e) {
            // Gérer les exceptions ici, par exemple, journaliser l'erreur
            return 0; // Retourner 0 en cas d'erreur
        }
    }


    //satatus
    private function updateFixe($id,$sendbox)
    {
        $crmmodele = CrmModel::find($id);
        $crmmodele->fixe = $sendbox;
        $crmmodele->save();
    }

    /* fonction reecriture des donnees dans le pdf de contrat yousign*/


    //next page
    private function nextpage($pdf,$page) {
        // Define the dimensions of an A4 page
        $a4Width = 210;
        $a4Height = 297;
        $templateId = $pdf->importPage($page);

        // Add a new page with A4 dimensions
        $pdf->AddPage('P', array($a4Width, $a4Height));

        // Use the imported page and scale it to fill the A4 page
        $pdf->useTemplate($templateId, 0, 0, $a4Width, $a4Height);
    }

    //write
    private function Write($pdf,$text,$x,$y,$size,$weight,$r,$g,$b) {
        $pdf->SetFont('Helvetica', $weight, $size);
        $pdf->SetTextColor($r,$g,$b);
        //$pdf->AddPage();
        $pdf->SetXY($x,$y);
        $pdf->Write(0,iconv('UTF-8', 'windows-1252', $text));

    }
    private function WriteTotal($pdf, $text, $x, $y, $size, $weight, $r, $g, $b){
        $width=200;
        $pdf->SetFont('Helvetica', $weight, $size);
        $pdf->SetTextColor($r, $g, $b);
        //$pdf->AddPage();
        $pdf->SetXY($x, $y);
        $pdf->Cell($width,0,iconv('UTF-8','windows-1252',$text),0,0,'R');
    }
    //write proprement dit
    private function devipdf($id)
    {

        $leads = CrmModel::find($id);
        //dd($leads);
        $pdf = new \setasign\Fpdi\Fpdi();
        $pdf->setSourceFile('devi2.pdf');
        $this->nextpage($pdf,1);
        //SOCIETE INFORMATION
        $this->Write($pdf,$leads->Noms_commerciaux,104,42,11,"B",0,0,0); //raison social
        $this->Write($pdf,"Siret : " . $leads->Numero_SIRET ,104,48,8,"",0,0,0); //Siret
        $this->Write($pdf,"Adresse : " .$leads->Adresse_postale,104,51,8,"",0,0,0); //Siret
        $this->Write($pdf,"Ville : " .$leads->Adresse_postale,104,54,8,"",0,0,0); //Ville
        $this->Write($pdf,"Tél : " .$leads->phone,104,57,8,"",0,0,0); //Tel
        $this->Write($pdf,"Mail : " .$leads->email,104,60,8,"",0,0,0); //E-mail
        $this->Write($pdf, "Représenté par : " . $leads->name . " " . $leads->first_name . ", " . $leads->function, 104, 63, 8, "", 0, 0, 0);//Representer par

        //NUMERO CLIENT
        $now = Carbon::now();
        $this->Write($pdf,"DEVIS 2023-".$leads->id,8,42,11,"B",255,255,255); //Devis
        $this->Write($pdf,"Numéro Client : DJS-".$leads->id."-2023",7,48,8,"",0,0,0); //Numéro Client
        $this->Write($pdf,"Date : ".$now,7,51,8,"",0,0,0); //Date
        //ADRESSE DU SITE :
        /*$this->Write($pdf,"ADRESSE DES TRAVAUX :",7,57,8,"B",0,0,0); //Date
        $this->Write($pdf,"MAIRIE DE NERE",7,60,8,"",0,0,0); //Date
        $this->Write($pdf,"122 rue du commandant rolland",7,63,8,"",0,0,0); //Date
        $this->Write($pdf,"13008 MARSEILLE",7,66,8,"",0,0,0); //Date
        $this->Write($pdf,"Contact : Hugon Georges 06-13-24-64-45 / 06-13-24-64-45",7,69,8,"",0,0,0); //Date
        */
        //Détail
        $prix_unitaire = 13.95;
        $this->Write($pdf,"697,50 €",25,119,8,"B",0,0,0); //Date
        //HUBLOT 1620lm IP65 - 230V, Type HUBLOT 1620lm IP65 - 230V
        $this->Write($pdf,$leads->HUB1600RWBCEE,141,130,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,$prix_unitaire ." €",156,130,8,"",0,0,0); //PU
        $this->Write($pdf,$leads->HUB1600RWBCEE * $prix_unitaire." €",174,130,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,130,8,"",0,0,0); //TVA
        //PROJECTEUR MURAL LED 100W - IP65 230V, Type PROJECTEUR 100W
        $this->Write($pdf,$leads->PR100WMCEE,141,163,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,$prix_unitaire ." €",156,163,8,"",0,0,0); //PU
        $this->Write($pdf,$leads->PR100WMCEE * $prix_unitaire."€",174,163,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,163,8,"",0,0,0); //TVA
        //PROJECTEUR MURAL LED 150W - IP65 230V, Type PROJECTEUR 150W
        $this->Write($pdf,0,141,195,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,$prix_unitaire ." €",156,195,8,"",0,0,0); //PU
        $this->Write($pdf,"0 €",174,195,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,195,8,"",0,0,0); //TVA
        //PROJECTEUR MURAL LED 30W - IP65 230V, Type PROJECTEUR 30W
        $this->Write($pdf,$leads->PR30WMCEE,141,228,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,$prix_unitaire ." €",156,228,8,"",0,0,0); //PU
        $this->Write($pdf,$leads->PR30WMCEE * $prix_unitaire." €",174,228,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,228,8,"",0,0,0); //TVA
        //PROJECTEUR MURAL LED 50W - IP65 230V, Type PROJECTEUR 50W
        $this->Write($pdf,$leads->PR50WMCEE,141,260,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,$prix_unitaire ." €",156,260,8,"",0,0,0); //PU
        $this->Write($pdf,$leads->PR50WMCEE * $prix_unitaire." €",174,260,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,260,8,"",0,0,0); //TVA

        $this->nextpage($pdf,2); //PAGE 2
        //TOTAL
        $total = ($leads->HUB1600RWBCEE + $leads->PR100WMCEE + $leads->PR30WMCEE + $leads->PR50WMCEE) * $prix_unitaire;
        //dd($total);
        $tva = 0.20 * $total;
        $ttc = $total + $tva;
        //dd($ttc);
        $this->WriteTotal($pdf,$total." €",0,240.7,8,"",0,0,0); //Total H.T
        $this->WriteTotal($pdf,$tva." €",0,244.7,8,"",0,0,0); //Total TVA 20%
        $this->WriteTotal($pdf,$ttc." €",0,248.7,8,"B",0,0,0); //Total TTC
        $this->WriteTotal($pdf,"-".$ttc." €",0,252.7,8,"",0,0,0); //Montant de la prime CEE versé par
        $this->WriteTotal($pdf,"0,00 €",0,264,9,"B",255,0,0); //Reste à payer



        $pdfDocumentPath = public_path("storage/documents/devis");
        $fileName = $leads->Numero_SIRET.".pdf";
        $pdfFilePath = $pdfDocumentPath . $fileName;
        //$pdf->Output('I', $pdfFilePath);
        $pdf->Output('F', $pdfFilePath);
        //dd(202);
        //echo 1;
    }

    private function devis_signature($id,$id_signature){
        $lid = CrmModel::find($id);
        $id_lead = $lid->$id;
        $email = $lid->email;
        $agent = $lid->Agent;
        $raison_social = $lid->Noms_commerciaux;
        $numero_siret = $lid->Numero_SIRET;
        $Id_signature = $id_signature;
        $Total_led = $lid->PR30WMCEE + $lid->PR50WMCEE +$lid->PR100WMCEE + $lid->HUB1600RWBCEE;
        $total_led = $Total_led;

        $devis = DB::table('devis_models')
            ->select('id_lead', $id_lead)
            ->get();
        if(isset($devis)){
            $dataToUpdate = [
                'email' => $lid->email,
                'raison_social' => $lid->Noms_commerciaux,
                'numero_siret' => $lid->Numero_SIRET,
                'Id_signature' => $id_signature,
                'total_led' => $Total_led,
                'agent' => $agent
            ];
            $devis->update($dataToUpdate);
        }else{
            $devis = new DevisModel();
            $devis -> email = $email;
            $devis -> raison_social = $raison_social;
            $devis -> numero_siret = $numero_siret;
            $devis -> Id_signature = $Id_signature;
            $devis -> total_led = $total_led;
            $devis -> agent = $agent;
            $devis -> save();
        }
    }
}



/* public function generatePDF(){
        //$users = User::get();

        $leads =CrmModel::find(6);
        $pdf = PDF::loadView('commande_pdf',compact('leads'));
        $pdfreturn =$pdf->save(public_path("storage/documents/fichier5.pdf"));
        dd(true);
    }*/
   /* public function generatePDF_voir($id){
        $leads =CrmModel::find($id);
        $pdf = PDF::loadView('commande_pdf',compact('leads'));
        //$pdf = PDF::loadView('commande_pdf');
        $pdfreturn = $pdf->save(public_path("storage/documents/".$leads ->Numero_SIRET.".pdf"));
        //return view ('commande_pdf',compact('leads'));
        $pdfDocumentPath = "storage/documents/";
        $fileName = $leads ->Numero_SIRET.".pdf";
        $nom = $leads -> name;
        $prenom = $leads -> first_name;
        $email = $leads -> email;
        $phone_number = $leads -> phone;
        //$file = file_get_contents($pdfDocumentPath.$fileName);
        try {
            $sendbox = $this->sendDocument($pdfDocumentPath, $fileName, $nom, $prenom, $email, $phone_number);

            if ($sendbox == 0) {
                return redirect()->back()->with('nonEnvoyer', 'Reappeler le prospect, il y a des informations fausses!');
            } else {
                $this->updateFixe($id);
                return redirect()->back()->with('Envoyer', 'mail envoyé!');
            }
        } catch (\Exception $e) {
            // Gérer l'exception de connexion ou de délai d'expiration ici
            return redirect()->back()->with('error', "Une erreur s'est produite lors de l'envoi du document.");
        }
    }*/
