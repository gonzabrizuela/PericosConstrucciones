<?php

namespace App\Http\Controllers;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use App\Models\ImageModel;
use Illuminate\Http\Request;
use App\Models\SubModel;
use App\Models\SliderModel;
use DB;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware(['verified']);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $aCategories = DB::select('SELECT  categoriess.*, COUNT(sub_categoriess.id) AS countsub, COUNT(case sub_categoriess.visible when 1 then 1 else null end) AS countvis
        FROM    categories categoriess
        LEFT JOIN
                sub_categories sub_categoriess
        ON      sub_categoriess.category_id = categoriess.id
               
        WHERE   categoriess.visible = 1
              
        GROUP BY
                categoriess.id
        ');
        $aSubCategories = SubModel::where('sub_categories.visible' ,'=', '1')
        ->get();

        if(Auth::check())
        {
            $user_id = Auth::user()->id;
        }
        else
        {
            $user_id = 0;
        }

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


        $aImage = ImageModel::select('products.*', 'images.image as image_dir')->leftjoin('products','products.id','=','images.product_id')
        ->where('products.news', '=', '1')
        ->get();
        
        $aSlider = SliderModel::get();
       

        return view('frontend/home.index',compact('aCategories','aSubCategories','aProducts','aImage','aSlider'));
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
