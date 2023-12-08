<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConnexionRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Client\ConnectionException;
use App\Models\CrmModel;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
use App\Models\ProspectModel;
use Illuminate\Support\Facades\Storage;
require_once('Pdf/fpdf/fpdf.php');
require_once('Pdf/FPDI-2.4.1/src/autoload.php');
//onligne
//require_once("Pdf/PHPMailer.php");
//require_once("Pdf/Exception.php");
//require_once("Pdf/SMTP.php");

use Illuminate\Mail\Mailables\Attachment;


use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class BdcController extends Controller
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

        // Spécifiez l'encodage UTF-8
        $pdf->Write(0, utf8_decode($text));

        // Si cela ne fonctionne pas, essayez également :
        // $pdf->Write(0, iconv('UTF-8', 'windows-1252', $text));
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
    public function generatePDF_voir_bdc($id) {
        $leads = CrmModel::find($id);
        $pdf = new \setasign\Fpdi\Fpdi();
        $this-> Initialisation($pdf);

        $squareSize = 5;
        $this->drawSquare($pdf, $squareSize, 92, 50);
        $this->drawSquare($pdf, $squareSize, 109, 50);
        $this->drawSquare($pdf, $squareSize, 20, 67);
        $this->drawSquare($pdf, $squareSize, 20, 73);

        if($leads->exterieur=='oui') {
            $this->OuiEclEctern($pdf);
        } else {
            $this->NonEclEctern($pdf);
        }
        if($leads->type=='public') {
            $this->PublicExtern($pdf);
        } else {
            $this->PrivateExtern($pdf);
        }
        // text
        $this->RaisonSocial($pdf,$leads->Noms_commerciaux);

        $this->Adresse($pdf,$leads->Adresse_postale);
        $this->CodePostal($pdf,$leads->code_postale);
        $this->ville($pdf,$leads->ville);
        $this->Siret($pdf,$leads->Numero_SIRET);
        $this->Nom($pdf,$leads->name);
        $this->Prenom($pdf,$leads->first_name);
        $this->Fonction($pdf,$leads->function);
        $this->Telephone($pdf,"+33 ".$leads->phone);
        $email = $leads->email;
        $this->EmailPos($pdf,$email);

        //Quantite
        $this->QuantiteA($pdf,$leads->PR30WMCEE);
        $this->QuantiteB($pdf,$leads->PR50WMCEE);
        $this->QuantiteC($pdf,$leads->PR100WMCEE);
        $this->QuantiteD($pdf,$leads->HUB1600RWBCEE);

        $date = Carbon::now()->format('d-m-Y');
        $this->DateSignature($pdf,$date);
        //$pdf->Output('I', 'generated.pdf');
        $pdfDocumentPath = public_path("storage/documents/");
        $fileName = $leads->Numero_SIRET . ".pdf";
        $pdfFilePath = $pdfDocumentPath . $fileName;
        //$pdf->Output('I', $pdfFilePath);
        $pdf->Output('F', $pdfFilePath);

        //$file_path = '/generated.pdf'; // Chemin relatif depuis le répertoire 'storage/app'
        $nom = $leads->name;
        $prenom = $leads->first_name;
        $email = $leads->email;
        $phone_number = $leads->phone;
        $id = $leads->id;
        $siret = $leads->Numero_SIRET;


        try {
            $sendbox = $this->send_BDC_document($nom, $prenom, $email, $id, $siret);

            if ($sendbox != 1) {
                return redirect()->back()->with('nonEnvoyer', 'Reappeler le prospect, il y a des informations fausses!');
            } else {
                $this->insertProspect($id, $siret);
                return redirect()->back()->with('Envoyer', 'Mail envoyé!');
            }
        } catch (ConnectionException $e) {
            return redirect()->back()->with('error', "Erreur de connexion lors de l'envoi du document.");
        }

    }


    private function send_BDC_document($nom, $prenom, $email, $id, $siret) {
        try {

            $mail = new PHPMailer(true);

            $mail->SMTPDebug = SMTP::DEBUG_OFF;
            $mail->isSMTP();
            $mail->Host       = 'smtp.titan.email';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'signature@crm-ucc.online';
            $mail->Password   = '@Aa!!12@';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port       = 465;

            // Recipients
            $mail->setFrom('signature@crm-ucc.online', 'DH Energie');
            $mail->addAddress($email);

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'DH Energie';

            $mailData = [
                'title' => 'DH Enerigie',
                'body' => 'DH Enerigie',
                'nom' => $nom,
                'prenom' => $prenom,
                'id' => $id,
                'siret' => $siret,
            ];
            $demoMail = new DemoMail($mailData);

            // Obtenez le contenu de l'email depuis la classe DemoMail
            $mail->Body = utf8_decode($demoMail->render());

            $mail->AltBody = 'DH Enerigie';
            // Envoyez l'email
            $mail->send();

            return 1;
            //echo 'Message has been sent';
        } catch (Exception $e) {
            return 0;
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }

    private function insertProspect($id, $siret) {
        $prospect = DB::table('prospect_models')
            ->where('Numero_SIRET', $siret)
            ->first();

        if ($prospect) {
            // Si un enregistrement avec le même numéro SIRET existe, mettez à jour cet enregistrement.
            DB::table('prospect_models')
            ->where('Numero_SIRET', $siret)
            ->update([
                'id_lead' => $id, // Mise à jour de 'id_lead' avec la valeur de $id
                'Numero_SIRET' => $siret, // Mise à jour de 'raison_social' avec la nouvelle valeur
            ]);
        } else {
            // Si aucun enregistrement avec le même numéro SIRET n'existe, créez un nouvel enregistrement.
            DB::table('prospect_models')->insert([
                'id_lead' => $id,
                'Numero_SIRET' => $siret,
                'etat_signature' => 'aucun_aucun',
            ]);
        }
    }


}
/*



// array $address qui prend toutes les address [address1, address2, etc]
    // string objet
    // string message
    // string from, address qui envoie le mail (facultatif), par defaut 'contact@lielcom.fr'
    public static function send_mail_setting($address, $objet, $message, $from = 'contact@lielcom.fr', $from_name = 'CRM LIELCOM', $add_reply = false, $mail_reply = '', $add_attachment = false, $attachment = '', $attachement_name = ''){
        $mail = new PHPMailer(true);

        try {
            //Server settings
            // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contact@lielcom.fr';                     //SMTP username
            $mail->Password   = 'gtnwmfondpblxdlq';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS

            //Recipients
            $mail->setFrom($from, $from_name);
            foreach ($address as $key => $value) {
                $mail->addAddress($value);     //Add a recipient
            }

            if($add_reply){
                $mail->addReplyTo($mail_reply, $from_name);
            }
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');

            //Attachments
            if($add_attachment){
                $mail->addAttachment($attachment, utf8_decode($attachement_name));
            }

            //Content
            $objet = utf8_decode($objet);
            $message = utf8_decode($message);
            // $message = mb_encode_mimeheader($message, "UTF-8");

            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $objet;
            $mail->Body    = $message;
            $mail->AltBody = $message; //in none-html content

            $mail->send();


            // echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>
*/
