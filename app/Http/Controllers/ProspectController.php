<?php

namespace App\Http\Controllers;

use App\Models\CrmModel;
use App\Models\ProspectModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
require_once('Pdf/fpdf/fpdf.php');
require_once('Pdf/FPDI-2.4.1/src/autoload.php');

//online
//require_once("Pdf/PHPMailer.php");
//require_once("Pdf/Exception.php");
//require_once("Pdf/SMTP.php");
use Carbon\Carbon;
use App\Mail\DemoMail;


use Illuminate\Mail\Mailables\Attachment;


use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class ProspectController extends Controller
{
    public function index($id,$siret){
        $contrat = CrmModel::where('Numero_SIRET', '=', $siret)
                    ->where('id', '=', $id)
                    ->first();

        if ($contrat) {
            // La recherche a renvoyé un résultat, vous pouvez accéder à ses propriétés en toute sécurité
            return view('prospects.prospects_BDC', compact('contrat'));
        } else {
            // Aucun résultat trouvé, vous pouvez gérer cela en conséquence, par exemple, en redirigeant ou en affichant un message d'erreur
            return redirect()->route('page_d_erreur');
        }
    }


    public function aftersign(){

            // Aucun résultat trouvé, vous pouvez gérer cela en conséquence, par exemple, en redirigeant ou en affichant un message d'erreur
            //return redirect()->route('page_d_erreur');
            //echo "<script>window.close();</script>";
            return view('prospects.modal_after_signe');
    }
    public function Signature(Request $request){
        // Définissez les règles de validation pour chaque champ
        $rules = [
            'signature' => 'required',
            'email' => 'required',
            'id_lead' => 'required|integer',
            'Numero_SIRET' => 'required', // Exemple : SIRET doit avoir 11 chiffres
        ];
        $messages = [
            'signature.required' => 'Le champ Nom est requis.',
        ];
        // Validez les données du formulaire en utilisant les règles de validation
        $validator = Validator::make($request->all(), $rules, $messages);

        // Si la validation échoue, redirigez avec des erreurs
        if ($validator->fails()) {
            //dd(1);
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $siret_inclus = $request->Numero_SIRET;
        $siret_exist = ProspectModel::where('Numero_SIRET',$siret_inclus)->first();
        if($siret_exist){
            $now = Carbon::now();
            $dataToUpdate = [
                'etat_signature' => $request->signature,
                'id_lead' => $request->id_lead,
                'Numero_SIRET' => $request->Numero_SIRET,
                'date_signature' => $now,
                'maybe'=>2,
            ];
            $siret_exist->update($dataToUpdate);
            $pdf = new \setasign\Fpdi\Fpdi();
            $filex= public_path("storage/documents/{$request->Numero_SIRET}.pdf");
            //dd($filex);
            $this->Initialisation($pdf,$filex);
            $this->Signaturex($pdf,$request->signature);
            $outputPath = public_path("storage/documents/{$request->Numero_SIRET}.pdf");

            $pdf->Output('F', $outputPath); //enregistrer

            $this -> send_mail_after_signe($request->id_lead,$request->Numero_SIRET,$request->email);
            $this->notification_email($request->Numero_SIRET);

            //echo "<script>window.close(3000);</script>";
            return view('prospects.modal_after_signe');
        }else{
             // Initiate FPDI
            $pdf = new \setasign\Fpdi\Fpdi();
            $filex= public_path("storage/documents/{$request->Numero_SIRET}.pdf");
            //dd($filex);
            $this->Initialisation($pdf,$filex);
            $this->Signaturex($pdf,$request->signature);
            // Output the generated PDF
            $outputPath = public_path("storage/documents/{$request->Numero_SIRET}.pdf");
            //$pdf->Output('I', $outputPath); //voir
            $pdf->Output('F', $outputPath); //enregistrer


            $signaturex = new ProspectModel();
            $signaturex -> etat_signature = $request->signature;
            $signaturex -> id_lead = $request->id_lead;
            $signaturex -> Numero_SIRET = $request->Numero_SIRET;
            $signaturex -> maybe = 1;
            $signaturex -> date_signature = Carbon::now();

            //dd(202);
            // Mettre à jour le modèle avec les données du formulaire
            $signaturex->save();

            $this -> send_mail_after_signe($request->id_lead,$request->Numero_SIRET,$request->email);
            // Récupérez les paramètres GET de la requête actuelle
            $this->notification_email($request->Numero_SIRET);
            return view('prospects.modal_after_signe');
        }

    }


    private function Initialisation($pdf,$filex) {
        // Set the source file
        $pdf->setSourceFile($filex);

        // Get the number of pages in the source PDF
        $numPages = $pdf->setSourceFile($filex);

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
    ///////////TEXT///////////
    private function Signaturex($pdf,$text) {
        $pdf->AddFont('SignatureFont', '', 'signature.php');
        $pdf->SetFont('SignatureFont', '', 25);
        $pdf->SetTextColor(27, 186, 225);
        $pdf->SetXY(80, 242);
        $pdf->Write(0, $text);
    }

    public function checkSign($siret){
        //return response()->json(2);
        $siret_exist = ProspectModel::where('Numero_SIRET',$siret)->first();
        if($siret_exist){
            $status = $siret_exist->etat_signature;
            if($status){
                if($status != null && $status !== 'aucun_aucun'){
                    return response()->json(1);
                }else{
                    return response()->json(0);
                }
            }else{
                return response()->json(0);
            }
        }else{
            return response()->json(0);
        }
    }
    private function send_mail_after_signe($id,$siret,$email)
    {
        $data["email"] = $email;
        $data["title"] = "DH ENERGIE: Votre commande complété";
        $data['id'] = $id;
        $data["siret"] = $siret;
        $files = public_path('storage/documents/'.$data['siret'].'.pdf');
        //dd($files);
        Mail::send('emails.after', $data, function($message)use($data, $files){
            $message->to($data["email"])
                    ->subject($data["title"]);
            $message->attach($files);
        });
    }



    private function notification_email($numero_siret){
        $num_siret = $numero_siret;
        $lead = CrmModel::where('Numero_SIRET', '=', $num_siret)->get();

        try {
            // Créez une instance de PHPMailer
            $mail = new PHPMailer(true);

            // Configuration du serveur SMTP
            $mail->SMTPDebug = SMTP::DEBUG_OFF; // Activer la sortie de débogage détaillée
            $mail->isSMTP(); // Envoi via SMTP
            $mail->Host = 'smtp.titan.email'; // Serveur SMTP
            $mail->SMTPAuth = true; // Activer l'authentification SMTP
            $mail->Username = 'signature@crm-ucc.online'; // Nom d'utilisateur SMTP
            $mail->Password = '@Aa!!12@'; // Mot de passe SMTP
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Activer le chiffrement SMTP
            $mail->Port = 465; // Port SMTP (utilisez 587 pour ENCRYPTION_STARTTLS)

            // Expéditeur
            $mail->setFrom('signature@crm-ucc.online', 'DH Energie');

            // Destinataire (vous devez configurer la boucle pour chaque destinataire)
            $mail->addAddress('sup.sarika@gmail.com', 'Sarika');
            $mail->addAddress('Dhenergie93@gmail.com', 'Dan');

            // Contenu de l'e-mail
            $mail->isHTML(true); // Le contenu est au format HTML
            $mail->Subject = 'Signature faite'; // Sujet de l'e-mail
            $mail->Body = 'Le prospect '.$lead[0]->name.' '.$lead[0]->first_name.' a signé le document.'; // Corps de l'e-mail

            // Envoi de l'e-mail
            $mail->send();

            // Nettoyer les destinataires
            $mail->clearAddresses();

            return 'E-mail envoyé avec succès';
        } catch (Exception $e) {
            return 'Erreur lors de l\'envoi de l\'e-mail : ' . $mail->ErrorInfo;
        }
    }

}
