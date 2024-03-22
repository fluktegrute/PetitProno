<?php

namespace App\Http\Controllers;

class HelpController extends Controller
{
	public static function groupe($str){
		$corresp = [
			'GROUP_A' => 'Groupe A',
			'GROUP_B' => 'Groupe B',
			'GROUP_C' => 'Groupe C',
			'GROUP_D' => 'Groupe D',
			'GROUP_E' => 'Groupe E',
			'GROUP_F' => 'Groupe F',
		];
		return $corresp[$str] ?? '';
	}

	public static function stage($str){
		$corresp = [
			'GROUP_STAGE' => 'Phase de poules',
		];
		return $corresp[$str] ?? '';
	}

	public static function equipe($str){
		$corresp = [
			'Germany' => 'Allemagne',
			'Scotland' => 'Écosse',
			'Hungary' => 'Hongrie',
			'Switzerland' => 'Suisse',
			'Spain' => 'Espagne',
			'Croatia' => 'Croatie',
			'Italy' => 'Italie',
			'Albania' => 'Albanie',
			'Slovenia' => 'Slovénie',
			'Denmark' => 'Danemark',
			'Serbia' => 'Serbie',
			'England' => 'Angleterre',
			'Belgium' => 'Belgique',
			'Slovakia' => 'Slovaquie',
			'Austria' => 'Autriche',
			'France' => 'France',
			'Portugal' => 'Portugal',
			'Czech Republic' => 'République Tchèque',
			'Netherlands' => 'Pays-Bas',
			'Turkey' => 'Turquie',
			'Romania' => 'Roumanie',
		];
		return $corresp[$str] ?? $str;
	}

	public static function checkToken($token){
		if(!$token || $token !== config('app.update_token')){
            header('HTTP/1.0 403 Forbidden');
            die("Accès à la page interdit");
		}
	}
}