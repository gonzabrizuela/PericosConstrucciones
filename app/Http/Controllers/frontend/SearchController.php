<?php

namespace App\Http\Controllers\frontend;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use App\Models\SubModel;
use DB;
use Illuminate\Support\MessageBag;
use App\Models\HistoryModel;
use Auth;
use Hash;

use App\Models\ImageModel;





class SearchController extends Controller {

    public function index(Request $request) {
        $request['text'] = ucwords($request['text']);

        $text =  $request['text'];

        if(Auth::check())
        {
            $user_id = Auth::user()->id;
        }
        else
        {
            $user_id = 0;
        }

        $aProducts = DB::select(' SELECT p.*, MIN(i.image) image,(f.product_id) favoritos ,(categories.prom) prom
        FROM products p
        LEFT JOIN categories ON (p.category_id = categories.id and categories.deleted_at is null)
        LEFT JOIN images i ON p.id = i.product_id
        LEFT JOIN favoritos f ON  (p.id = f.product_id and  f.user_id = "'.$user_id.'" and f.deleted_at is null)
        where i.deleted_at is null 
        and i.main_image = 1
        and p.name LIKE "%' . $text . '%" 
        and p.deleted_at is null 
        and p.visible = 1
        GROUP BY p.id
        ');

        if(empty($aProducts))
        {
            $scategory_name = "No se encontro resultados para '".$text."'";
            $aProducts = DB::select('SELECT p.*,
            MIN(i.image) image,(f.product_id) favoritos,(categories.prom) prom
            FROM products p
            LEFT JOIN categories ON p.category_id = categories.id
            LEFT JOIN images i ON p.id = i.product_id
            LEFT JOIN favoritos f ON  (p.id = f.product_id and  f.user_id = "'.$user_id.'" and f.deleted_at is null)
            where i.deleted_at is null
            and p.visible = 1
            and p.deleted_at is  null
            and i.main_image = 1
            and p.news = 1
            and categories.deleted_at is null
            GROUP BY p.id;');
        }
        else{
            $scategory_name = null;
        }
        
        $aCategories = DB::select('SELECT categoriess.*, COUNT(sub_categoriess.id) AS countsub, COUNT(case sub_categoriess.visible when 1 then 1 else null end) AS countvis
        FROM categories categoriess
        LEFT JOIN sub_categories sub_categoriess
        ON sub_categoriess.category_id = categoriess.id    
        WHERE categoriess.visible = 1 and categoriess.deleted_at is null and sub_categoriess.deleted_at is null
        GROUP BY categoriess.id
        ');

        // $aProductsNews = DB::select('SELECT p.*, MIN(i.image) image
        // FROM products p
        // LEFT JOIN images i ON p.id = i.product_id
        // where i.deleted_at is null
        // and p.visible = 1
        // and p.deleted_at is  null
        // and p.news = 1
        // GROUP BY p.id');

        $aSubCategories = SubModel::where('sub_categories.visible' ,'=', '1')
        ->get();
        
        

        return view('frontend/search.index',compact('aCategories','aSubCategories','aProducts','scategory_name','text'));
    }

    public function show() {
        //
    }
    

    public function product($id)
    {

        $aCategories = CategoriesModel::select('categories.*', DB::raw('count(sub_categories.id)  as quantity_sub'))->leftjoin('sub_categories','categories.id','=','sub_categories.category_id')
        ->where('categories.visible', '=', '1')
        ->groupBy('categories.id')
        ->get();

        $aSubCategories = SubModel::where('sub_categories.visible' ,'=', '1')
        ->get();

        $aProducts = ProductsModel::where('products.id', '=', $id)
        ->get();

        return view('frontend/home.product',compact('aCategories','aSubCategories','aProducts'))->with('id',$id);
        
    }

}
