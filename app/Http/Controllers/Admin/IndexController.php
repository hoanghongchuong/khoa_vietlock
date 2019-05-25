<?php 
namespace App\Http\Controllers\Admin;

//use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Products;
use App\News;
use App\Images;
use Input, File;
use Validator;
use Auth;

class IndexController extends Controller
{
    public function getIndex()
    {
        $product = Products::select()->orderBy('id','DESC')->take(5)->get();
        $news = News::select()->where('com','tin-tuc')->get();
        //$data = Products::all();
        
        return view('admin.index', compact('product','news'));
    }
    
}
