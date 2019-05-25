<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Orders;
use App\OrderDetail;

class OrderController extends Controller
{
    //
    public function getList(){
    	$data = Orders::all();
    	return view('admin.orders.list', compact('data'));
    }
}
