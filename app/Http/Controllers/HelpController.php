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
}