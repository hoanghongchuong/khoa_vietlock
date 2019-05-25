<?php

namespace App\Http\Controllers\Zalo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function index()
    {
    	$oaid = 3608771904285658255;
    	
    	$timestamp = time();
    	$data = array(
		    'offset' => '0',
		    'count' => '10'
		);
		$params = ['data' => $data];
		$response = $zalo->get(ZaloEndpoint::API_OA_STORE_GET_SLICE_CATEGORY, $params);
		$result = $response->getDecodedBody();

    }
}
