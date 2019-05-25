<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\BankAccount;
use File;
class BankAccountController extends Controller
{
    public function index(){
    	$data = BankAccount::all();
    	return view('admin.bank_account.index',compact('data'));
    }
    public function getCreate(){
    	return view('admin.bank_account.create');
    }
    public function postCreate(Request $request){
    	$img = $request->file('fImages');
        $path_img='upload/hinhanh';
        $img_name='';
        if(!empty($img)){
            $img_name=time().'_'.$img->getClientOriginalName();
            $img->move($path_img,$img_name);
        }
        $data = new BankAccount;
        $data->info = $request->txtDesc;
        $data->img = $img_name;
        $data->save();
    	return redirect(route('admin.bank.index'));
    }
    public function getEdit($id){
    	$data = BankAccount::find($id);
    	// dd($data);
    	return view('admin.bank_account.edit', compact('data'));
    }
    public function postEdit(Request $request, $id){
    	$data = BankAccount::where('id',$id)->first();
    	$img = $request->file('fImages');
            $img_current = 'upload/hinhanh/'.$request->img_current;
            if(!empty($img)){
                $path_img='upload/hinhanh';
                $img_name=time().'_'.$img->getClientOriginalName();
                $img->move($path_img,$img_name);
                $data->img = $img_name;
                if (File::exists($img_current)) {
                    File::delete($img_current);
                }
            }
    	$data->info = $request->txtDesc;
    	$data->save();
    	return redirect(route('admin.bank.index'));
    }
    public function delete($id){
    	$data = BankAccount::where('id',$id)->first();
    	$data->delete();
    	return redirect()->back();
    }
}
