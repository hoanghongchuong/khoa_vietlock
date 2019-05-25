<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
class ContactController extends Controller
{
    //
    public function getContact(){
    	$data = Contact::get();
    	$trang = "liên hệ";
    	return view('admin.contact.list', compact('data'));
    }

    /**
     * @param  Request
     * @return void
     */
    public function xuly(Request $req){
        $contact = Contact::where('id', $req->contact_id)->first();
        if ($contact) {
            $contact->status =  $contact->status == 1 ? 0 : 1;
            $contact->save();
            // $contact->toggleStatus()->save();
            
            return (Int)$contact->status;
        }
    }

    public function deleteContact($id){
    	$c = Contact::find($id);
    	$c->delete();
    	return redirect()->back()->with('mess','Xoá thành công');
    }

}
