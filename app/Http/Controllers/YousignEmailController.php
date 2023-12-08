<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
namespace AlexisRiot\Yousign;
use GuzzleHttp\Client;
class YousignEmailController extends Controller
{
    public function sendEmail(Request $request)
    {
        // Créez une procédure et obtenez les informations nécessaires
        $file = Yousign::createFile([
            "name" => "devis.pdf",
            "content" => "JVBERi0xLjUKJb/3ov4KNiA...",
        ]);

        $procedure = new YousignProcedure();
        $procedure
            ->withName("Ma procédure")
            ->withDescription("La description de ma procédure")
            ->addMember([
                'firstname' => "John",
                'lastname' => "Doe",
                'email' => "john.doe@example.com",
                'phone' => "+1234567890",
            ], [$file])
            ->send();

        // Envoie l'e-mail avec les informations de la procédure
        Mail::to($request->input('email'))
            ->send(new YousignEmail($procedure));

        return "E-mail envoyé avec succès !";
    }
}
