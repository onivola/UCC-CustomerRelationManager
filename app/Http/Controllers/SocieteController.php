<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SocieteController extends Controller
{
    public function api_search_raison_social(){
        if (isset($_GET['raison_social'])) {
			$raison_social= str_replace(' ', '+', $_GET['raison_social']);;
			//echo "Bonjour, " . $nom . " !";
			$curl = curl_init();
			$url = 'https://www.societe.com/cgi-bin/search?champs='.$raison_social;
			echo $url;
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
			));

			$response = curl_exec($curl);

			curl_close($curl);

			// Convertit le contenu en UTF-8
			//$response = iconv('ISO-8859-1', 'UTF-8', $response);

			echo $response;
		} else {
			echo "";
		}
    }
    public function api_search_siret(){
        if (isset($_POST['url'])) {
            /*echo "API SIRET MARCHE";
            echo $_POST['url'];*/
            $url = $_POST['url'];

			//echo "Bonjour, " . $nom . " !";
			$curl = curl_init();

			//echo $url;
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
			));

			$response = curl_exec($curl);

			curl_close($curl);

			// Convertit le contenu en UTF-8
			//$response = iconv('ISO-8859-1', 'UTF-8', $response);

			echo $response;
		} else {
			echo "00";
		}
    }
    public function google(){
        if (isset($_GET['raison_social'])) {
			$raison_social= str_replace(' ', '+', $_GET['raison_social']);
			//echo "Bonjour, " . $nom . " !";
			$curl = curl_init();
			$url = 'https://www.google.com/search?q='.$raison_social.':societe.com';
			echo $url;
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
			));

			$response = curl_exec($curl);

			curl_close($curl);

			// Convertit le contenu en UTF-8
			$response = iconv('ISO-8859-1', 'UTF-8', $response);

			echo $response;
		} else {
			echo "";
		}

    }
    public function google_test()    {

			//echo "Bonjour, " . $nom . " !";
			$curl = curl_init();
			$url = 'https://www.societe.com/societe/kfc-france-sas-380744870.html';
			echo $url;
			curl_setopt_array($curl, array(
				CURLOPT_URL => $url,
				CURLOPT_RETURNTRANSFER => true,
				CURLOPT_ENCODING => '',
				CURLOPT_MAXREDIRS => 10,
				CURLOPT_TIMEOUT => 0,
				CURLOPT_FOLLOWLOCATION => true,
				CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				CURLOPT_CUSTOMREQUEST => 'GET',
			));

			$response = curl_exec($curl);

			curl_close($curl);

			// Convertit le contenu en UTF-8
			$response = iconv('ISO-8859-1', 'UTF-8', $response);

			echo $response;


    }
}
