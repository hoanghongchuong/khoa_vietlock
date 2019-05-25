<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
	const TOKEN = '534aDa7CeF733C7B77E1E4d263D639C1318Fe161';
    public function index()
    {
    	$curl = curl_init('https://services.giaohangtietkiem.vn/authentication-request-sample');

    	curl_setopt_array($curl, array(
		    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_HTTPHEADER => array(
		        "Token" => static::TOKEN,
		    ),
		));

		$response = curl_exec($curl);		
		curl_close($curl);

		echo 'Response: ' . $response;
		// $curl = curl_init();
		// curl_setopt_array($curl, array(
		//     CURLOPT_RETURNTRANSFER => 0,
		//     CURLOPT_URL => 'https://query.yahooapis.com/v1/public/yql?q=select%20*%20from%20weather.forecast%20where%20woeid%20in%20(select%20woeid%20from%20geo.places(1)%20where%20text%3D%22hanoi%2C%20vietnam%22)&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys',
		//     CURLOPT_USERAGENT => 'XuanThuLab test cURL Request',
		//     CURLOPT_SSL_VERIFYPEER => false
		// ));

		// $resp = curl_exec($curl);

		// //Dữ liệu thời tiết ở dạng JSON
		// $weather = json_decode($resp);
		// var_dump($weather);

		// curl_close($curl);
    }
}
