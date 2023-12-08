<?php

namespace App\Http\Controllers;

use App\Models\CrmModel;
use Illuminate\Http\Request;
use App\Mail\DemoMail;



require_once('Pdf/fpdf/fpdf.php');
require_once('Pdf/FPDI-2.4.1/src/autoload.php');
//onligne
//require_once("Pdf/PHPMailer.php");
//require_once("Pdf/Exception.php");
//require_once("Pdf/SMTP.php");

use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Support\Facades\Mail;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class SendImageController extends Controller
{
    public function index($id)
    {
        try {
            $leads = CrmModel::find($id);
            $data["email"] = $leads->email;
            $data["title"] = "DH ENERGIE : Image hublot";
            $data["body"] = "Image hublot";
            $data["name"] = $leads->name;
            $data["firstname"] = $leads->first_name;
            $files = public_path('storage/documents/hublotimage.pdf');

            Mail::send('emails.image', ['data' => $data], function ($message) use ($data, $files) {
                $message->to($data["email"])
                        ->subject($data["title"]);
                $message->attach($files);
            });

            return redirect()->back()->with('success_sent_email_image', 'L\'image a bien été envoyée.');
        } catch (\Exception $e) {
            return redirect()->back()->with('falaid_sent_email_image', 'reaisseie d\'envoies l\'image');
        }

    }
}
