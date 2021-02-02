<?php

namespace App\Http\Controllers\admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ContactModel;
use DB;

class ContactController extends Controller {

    public function index() {

        $aUsers = User::get();
        
        $aContacts = ContactModel::select('contacts.*','users.name as name','users.last_name as last_name','users.phone as phone','users.email as email')
        ->leftjoin('users','contacts.user_id','=','users.id')
        ->get();
        return view('admin/contact.index',compact('aUsers','aContacts'));
    }

    

    public function show($id) {
        //
    }

    public function destroy($id) {

        ContactModel::find($id)->delete();

        return redirect()->route('contact.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
}
