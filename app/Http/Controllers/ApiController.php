<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ApiController extends Controller
{
	private $api_url = "https://api.football-data.org/v4/competitions/EC/";
	private $api_key;

	public function __construct(){
		$this->api_key = config('app.api_key');
	}

	public function call($endpoint){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->api_url.$endpoint);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, ['X-Auth-Token:' . $this->api_key]);

		$output = curl_exec($ch);

		if (curl_errno($ch)) {
		    dd("Erreur cURL : " . curl_error($ch));
		    exit();
		}

		curl_close($ch);

		return json_decode($output);
	}
}