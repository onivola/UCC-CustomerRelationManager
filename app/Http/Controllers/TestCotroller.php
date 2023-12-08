<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestCotroller extends Controller
{
    public function index()
{
    $apiKey = 'rAaS2nEDNNvLX1Z1KAz3bQ13AqNpgEyq';
    $signatureRequestId = 'fb7eda1c-2e74-4941-ba13-86caf8c9cf3e#694809'; // Remplacez par l'ID de la demande de signature que vous souhaitez obtenir les signataires

    try {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . $apiKey,
        ])->get("https://api.yousign.app/v3/signature_requests/{$signatureRequestId}");

        //$data = $response->json();

        dd($response) ; // Afficher les données obtenues de la réponse
    } catch (\Exception $e) {
        // Gérez les erreurs ici
        echo 'Erreur lors de la récupération des signataires : ' . $e->getMessage();
    }
}
}
