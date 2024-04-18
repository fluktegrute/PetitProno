<?php

namespace App\Http\Controllers;

class HelpController extends Controller
{
	public static function checkToken($token){
		if(!$token || $token !== config('app.update_token')){
            header('HTTP/1.0 403 Forbidden');
            die("Accès à la page interdit");
		}
	}

	public static function checkCaptcha($response){
		$data = [
			'secret' => config('app.hcaptcha_secret'),
			'response' => $response,
		];
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, config('app.hcaptcha_verify_url'));
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$output = json_decode(curl_exec($ch));

		curl_close($ch);

		return $output;
	}
}