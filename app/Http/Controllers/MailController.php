<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\DemoMail;
class MailController extends Controller
{
    /*
    public function index(){
        $mailData = [
            'title' => 'Vita le mandefa mail',
            'body' => 'eto zany le bande de commande',
        ];
        Mail::to('andryarivola@ymail.com')->send(new DemoMail($mailData));
        dd('Email send successfully');

    }*/

    public function index($nom,$prenom){
        $mailData = [
            'title' => 'Mail from Webappfix',
            'body' => 'This is for testing email usign smtp',
            'nom' => $nom,
            'prenom' => $prenom,
        ];

        Mail::to('ramiaramanananaharisoa@gmail.com')->send(new DemoMail($mailData));

        dd('Email send successfully.');
    }



}
