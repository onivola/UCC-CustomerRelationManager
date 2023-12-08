<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DeviPDFController extends Controller
{
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
    private function Write($pdf,$text,$x,$y,$size,$weight,$r,$g,$b) {
        $pdf->SetFont('Helvetica', $weight, $size);
        $pdf->SetTextColor($r,$g,$b);
        //$pdf->AddPage();
        $pdf->SetXY($x,$y);
        $pdf->Write(0,iconv('UTF-8', 'windows-1252', $text));

    }
    public function devipdf()
    {
        $pdf = new \setasign\Fpdi\Fpdi();
        $pdf->setSourceFile('devi2.pdf');
        $this->nextpage($pdf,1);

        //SOCIETE INFORMATION
        $this->Write($pdf,"Societe Orange",104,42,11,"B",0,0,0); //raison social
        $this->Write($pdf,"Siret : 43441966900016",104,48,8,"",0,0,0); //Siret
        $this->Write($pdf,"Adresse : 1 RTE DES CORBIERES",104,51,8,"",0,0,0); //Siret
        $this->Write($pdf,"Ville : 11800 MONZE",104,54,8,"",0,0,0); //Ville
        $this->Write($pdf,"Tél : 04-91-22-13-09",104,57,8,"",0,0,0); //Tel
        $this->Write($pdf,"Mail : ramiaramanananaharisoa@gmail.com",104,60,8,"",0,0,0); //E-mail
        $this->Write($pdf,"Représenté par : arnaud dupont, RESPONSABLE",104,63,8,"",0,0,0); //Representer par

        //NUMERO CLIENT
        $this->Write($pdf,"DEVIS 2023-1527 ",8,42,11,"B",255,255,255); //Devis
        $this->Write($pdf,"Numéro Client : YNT-2023-1527",7,48,8,"",0,0,0); //Numéro Client
        $this->Write($pdf,"Date : 04/10/2023",7,51,8,"",0,0,0); //Date
        //ADRESSE DU SITE :
        $this->Write($pdf,"ADRESSE DES TRAVAUX :",7,57,8,"B",0,0,0); //Date
        $this->Write($pdf,"MAIRIE DE NERE",7,60,8,"",0,0,0); //Date
        $this->Write($pdf,"122 rue du commandant rolland",7,63,8,"",0,0,0); //Date
        $this->Write($pdf,"13008 MARSEILLE",7,66,8,"",0,0,0); //Date
        $this->Write($pdf,"Contact : Hugon Georges 06-13-24-64-45 / 06-13-24-64-45",7,69,8,"",0,0,0); //Date

        //Détail

        $this->Write($pdf,"697,50 €",25,119,8,"B",0,0,0); //Date
        //HUBLOT 1620lm IP65 - 230V, Type HUBLOT 1620lm IP65 - 230V
        $this->Write($pdf,101,141,130,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,"13,95 €",156,130,8,"",0,0,0); //PU
        $this->Write($pdf,"139,50 €",174,130,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,130,8,"",0,0,0); //TVA
        //PROJECTEUR MURAL LED 100W - IP65 230V, Type PROJECTEUR 100W
        $this->Write($pdf,101,141,163,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,"13,95 €",156,163,8,"",0,0,0); //PU
        $this->Write($pdf,"139,50 €",174,163,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,163,8,"",0,0,0); //TVA
        //PROJECTEUR MURAL LED 150W - IP65 230V, Type PROJECTEUR 150W
        $this->Write($pdf,101,141,195,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,"13,95 €",156,195,8,"",0,0,0); //PU
        $this->Write($pdf,"139,50 €",174,195,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,195,8,"",0,0,0); //TVA
        //PROJECTEUR MURAL LED 30W - IP65 230V, Type PROJECTEUR 30W
        $this->Write($pdf,101,141,228,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,"13,95 €",156,228,8,"",0,0,0); //PU
        $this->Write($pdf,"139,50 €",174,228,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,228,8,"",0,0,0); //TVA
        //PROJECTEUR MURAL LED 50W - IP65 230V, Type PROJECTEUR 50W
        $this->Write($pdf,101,141,260,8,"",0,0,0); //QUANTITE
        $this->Write($pdf,"13,95 €",156,260,8,"",0,0,0); //PU
        $this->Write($pdf,"139,50 €",174,260,8,"",0,0,0); //TOTAL TTC
        $this->Write($pdf,"60 %",191,260,8,"",0,0,0); //TVA

        $this->nextpage($pdf,2); //PAGE 2
        //TOTAL
        $this->Write($pdf,"581,25 €",185,240.7,8,"",0,0,0); //Total H.T
        $this->Write($pdf,"116,25 €",185,244.7,8,"",0,0,0); //Total TVA 20%
        $this->Write($pdf,"697,50 €",185,248.7,8,"B",0,0,0); //Total TTC
        $this->Write($pdf,"-697,50 €",184,252.7,8,"",0,0,0); //Montant de la prime CEE versé par
        $this->Write($pdf,"0,00 €",188,264,9,"B",255,0,0); //Reste à payer



        $pdfDocumentPath = public_path("storage/documents/");
        $fileName = "devidevi.pdf";
        $pdfFilePath = $pdfDocumentPath . $fileName;
        $pdf->Output('I', $pdfFilePath);
        //$pdf->Output('F', $pdfFilePath);
        //echo 1;
    }
}
