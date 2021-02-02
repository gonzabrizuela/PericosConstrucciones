<?php

namespace App\Http\Controllers\frontend;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\SubModel;
use DB;

class LoguserController extends Controller {

    public function index() {

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

        return view('frontend/login.index',compact('aCategories','aSubCategories'));
    }

    public function create() {
        return view('admin/user.create');
    }

    

}
