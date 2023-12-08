<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Http;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\View;
use Barryvdh\DomPDF\Facade\Pdf;
class SendMailCotroller extends Controller
{
    public function sendDocument($pdfDocumentPath, $nom, $prenom, $email, $phone_number)
    {
        $baseUrl = 'https://api.yousign.app/v3';
        $apiKey = 'rAaS2nEDNNvLX1Z1KAz3bQ13AqNpgEyq';
        //$pdfDocumentPath = 'document-test.pdf';

        ## 1 - Create a Signature Request:
        $initiateSignatureRequestResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])
            ->post($baseUrl . '/signature_requests', [
                'name' => 'AR PARTNERS PROD',
                'delivery_mode' => 'email',
                'timezone' => 'Europe/Paris',
            ])
            ->json();

        $signatureRequestId = $initiateSignatureRequestResponse['id'];

        ## 2 - Add a Document to the Signature Request:
        $documentUploadResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
            ])
            ->attach(
                'file',
                new File($pdfDocumentPath),
                'document.pdf',
                [
                    'nature' => 'signable_document',
                    'parse_anchors' => 'true',
                ]
            )
            ->post($baseUrl . '/signature_requests/' . $signatureRequestId . '/documents')
            ->json();

        $documentId = $documentUploadResponse['id'];

        ## 3 - Add a Signer to the Signature Request:
        $addSignerResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])
            ->post($baseUrl . '/signature_requests/' . $signatureRequestId . '/signers', [
                'info' => [
                    'first_name' => $prenom,
                    'last_name' => $nom,
                    'email' => $email,
                    'phone_number' => $phone_number,
                    'locale' => 'fr',
                ],
                'signature_authentication_mode' => 'no_otp',
                'signature_level' => 'electronic_signature',
                'fields' => [
                    [
                        'document_id' => $documentId,
                        'type' => 'signature',
                        'height' => 37,
                        'width' => 85,
                        'page' => 1,
                        'x' => 77,
                        'y' => 581,
                    ],
                ],
            ]);

        ## 4 - Activate the Signature Request:
        $activateSignatureRequestResponse = Http::withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type' => 'application/json',
            ])
            ->post($baseUrl . '/signature_requests/' . $signatureRequestId . '/activate')
            ->json();

        return true;
    }
    public function generatePDF()
    {
        // Get the view content
        $html = View::make('pdf')->render();

        // Create a new Dompdf instance
        $dompdf = new Dompdf();

        // Load the HTML content
        $dompdf->loadHtml($html);

        // (Optional) Set the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML to PDF
        $dompdf->render();

        // Output the generated PDF to the browser
        $dompdf->stream('document.pdf');
    }
}
//Route::get('/generate-pdf', 'YourController@generatePDF');
