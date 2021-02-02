<?php

namespace App\Http\Controllers\frontend;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use App\Models\ContactModel;
use App\Models\SubModel;
use DB;
use Illuminate\Support\MessageBag;
use Auth;
use Hash;

use App\Models\ImageModel;





class ContactController extends Controller {

    public function index() {


        if(Auth::check())
        {
            $user_id = Auth::user()->id;
        }
        else
        {
            $user_id = 0;
        }

        $aProducts = DB::select('SELECT p.*, MIN(i.image) image,(f.product_id) favoritos ,(categories.prom) prom
        FROM products p
        LEFT JOIN categories ON (p.category_id = categories.id and categories.deleted_at is null)
        LEFT JOIN images i ON p.id = i.product_id
        LEFT JOIN favoritos f ON  (p.id = f.product_id and  f.user_id = "'.$user_id.'" and f.deleted_at is null)
        where i.deleted_at is null
        and i.main_image = 1
        and p.deleted_at is  null
        and p.visible = 1
        GROUP BY p.id
        ');

 
        $aCategories = DB::select('SELECT  categoriess.*, COUNT(sub_categoriess.id) AS countsub, COUNT(case sub_categoriess.visible when 1 then 1 else null end) AS countvis
        FROM categories categoriess
        LEFT JOIN sub_categories sub_categoriess ON sub_categoriess.category_id = categoriess.id
        WHERE   categoriess.visible = 1 
        and categoriess.deleted_at is null 
        and sub_categoriess.deleted_at is null  
        GROUP BY categoriess.id
        ');
        
        $aSubCategories = SubModel::where('sub_categories.visible' ,'=', '1')
        ->get();
        
        return view('frontend/contact.index',compact('aCategories','aSubCategories','aProducts','category_name'));
    }

    public function show() {
        //
    }
    

    public function store(Request $request) {

        $aValidations = array(
            'contacts_type' => 'required',
            'description' => 'required|max:60',
        
        );

        

        $this->validate($request, $aValidations);


        if(Auth::check())
        {
            $user_id = Auth::user()->id;
        }
        else
        {
            $user_id = 0;
        }

        $contacts_type = $request['contacts_type']; 
      
        $description = $request['description']; 


        $data=array('text' => $description,'user_id' => $user_id,'type' => $contacts_type,'created_at' => now() );
        ContactModel::insert($data);

       

        return redirect()->route('contact')->with('success', 'Registro actualizado satisfactoriamente');
    }


}
