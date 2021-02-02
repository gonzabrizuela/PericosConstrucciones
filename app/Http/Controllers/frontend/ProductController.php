<?php

namespace App\Http\Controllers\frontend;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use App\Models\SubModel;
use App\Models\FavoritesModel;
use App\Models\CartModel;

use DB;
use Illuminate\Support\MessageBag;
use Auth;
use Hash;

use App\Models\ImageModel;





class ProductController extends Controller {

    public function index($id) {

        if(!Auth::guest())
        {
        $user=Auth::user()->id;
        }
        else{
          $user= 0;      
        }
        
        $aFavorites = FavoritesModel::where('user_id','=',$user)
        ->where('product_id','=',$id)
        ->first();
        
        $aCart = CartModel::where('user_id','=',$user)
        ->where('product_id','=',$id)
        ->first();
        
        $oProduct = DB::select('SELECT p.*,
        MIN(i.image) image,(f.product_id) favoritos,(categories.prom) prom
        FROM products p
        LEFT JOIN categories ON (p.category_id = categories.id and  categories.deleted_at is null)
        LEFT JOIN images i ON p.id = i.product_id
        LEFT JOIN favoritos f ON  (p.id = f.product_id and  f.user_id = "'.$user.'" and f.deleted_at is null)
        where i.deleted_at is null
        and p.visible = 1
        and p.deleted_at is  null
        and p.id = "'.$id.'"
        GROUP BY p.id;
        ');

        $aCategories = DB::select('SELECT  categoriess.*, COUNT(sub_categoriess.id) AS countsub, COUNT(case sub_categoriess.visible when 1 then 1 else null end) AS countvis
        FROM categories categoriess
        LEFT JOIN sub_categories sub_categoriess
        ON sub_categoriess.category_id = categoriess.id    
        WHERE categoriess.visible = 1 and
        categoriess.deleted_at is null and
        sub_categoriess.deleted_at is null
        GROUP BY categoriess.id
        ');

        $aSubCategories = SubModel::where('sub_categories.visible' ,'=', '1')
        ->get();


        $aProperties_luxuries=DB::select('SELECT pc.*,(c.name) comodidades_name
        FROM properties_luxuries pc
       LEFT JOIN luxuries c ON pc.luxuries_id = c.id
       where pc.deleted_at is null
       and pc.properties_id = "'.$id.'"
       GROUP BY pc.id;
        ');
    
        $aProperties_general_characteristics=DB::select('SELECT pcg.*,(cg.name) caracteristicas_generales_name
        FROM properties_general_characteristics pcg
        LEFT JOIN general_characteristics cg ON pcg.general_characteristics_id = cg.id
        where pcg.deleted_at is null
        and pcg.properties_id = "'.$id.'"
        GROUP BY pcg.id;
        ');
    
        $aProperties_ambients=DB::select('SELECT pa.*,(a.name) ambientes_name
        FROM properties_ambients pa
        LEFT JOIN ambients a ON pa.ambients_id = a.id
        where pa.deleted_at is null
        and pa.properties_id = "'.$id.'"
        GROUP BY pa.id;
         ');
    
         $aProperties_services=DB::select('SELECT ps.*,(s.name) service_name
        FROM properties_services ps
        LEFT JOIN services s ON ps.services_id = s.id
        where ps.deleted_at is null
        and ps.properties_id = "'.$id.'"
        GROUP BY ps.id;
         ');

        $aImage = ImageModel::where('images.product_id', '=', $id)
        ->get();

        return view('frontend/product.index',compact('aCategories','aSubCategories','oProduct','aImage', 'aCart','aFavorites','aProperties_luxuries','aProperties_general_characteristics','aProperties_ambients','aProperties_services'));
    }

    public function show() {
        //
    }
    public function store($id){

        $user=Auth::user()->id;
        $aProducts = DB::select('   SELECT p.*,
        MIN(i.image) image
        FROM products p
        LEFT JOIN images i ON p.id = i.product_id
        where i.deleted_at is null
        and p.subcategory_id = "'.$id.'"
        and p.deleted_at is  null
        and p.visible = 1
        GROUP BY p.id');

        $aCarrito = DB::select('SELECT id, COUNT(*) AS count_carrito FROM carrito WHERE user_id = "'.$user.'" and product_id =  "'.$id.'"  GROUP BY id;');

        $aFavoritos = DB::select('SELECT id, COUNT(*) AS count_fav FROM favoritos WHERE user_id = "'.$user.'" and product_id =  "'.$id.'"  GROUP BY id;');

        $aCategories = DB::select('SELECT  categoriess.*, COUNT(sub_categoriess.id) AS countsub, COUNT(case sub_categoriess.visible when 1 then 1 else null end) AS countvis
        FROM categories categoriess
        LEFT JOIN sub_categories sub_categoriess ON sub_categoriess.category_id = categoriess.id
        WHERE categoriess.visible = 1 
        and categoriess.deleted_at is null
        and sub_categoriess.deleted_at is null  
        GROUP BY categoriess.id
        ');

        $aSubCategories = SubModel::where('sub_categories.visible' ,'=', '1')
        ->get();
        
        DB::insert('insert into carrito (product_id, user_id,status) values ("'.$id.'", "'.$user.'",1)');
        return back()->withInput();
    }
    

}
