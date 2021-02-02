<?php

namespace App\Http\Controllers\frontend;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\CategoriesModel;
use App\Models\ProductsModel;
use App\Models\SubModel;
use App\Models\CartModel;
use DB;
use Illuminate\Support\MessageBag;
use Auth;
use Hash;

use App\Models\ImageModel;





class CartController extends Controller {

    public function index() {
    

        $user=Auth::user()->id;

        $aProducts = DB::select('   SELECT p.*, MIN(i.image) image ,(categories.prom) prom,c.quantity
        FROM products p
        LEFT JOIN categories ON (p.category_id = categories.id and  categories.deleted_at is null)
        LEFT JOIN images i ON p.id = i.product_id
        LEFT JOIN carrito c ON p.id = c.product_id 
        where i.deleted_at is null
        and i.main_image = 1
        and c.user_id = "'.$user.'"
        and p.deleted_at is  null
        and p.visible = 1
        and c.status = 1
        GROUP BY c.id
        ');

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

        $aImage = ImageModel::get();
        
        return view('frontend/carrito.index',compact('aCategories','aSubCategories','aProducts','aImage'));
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
       
        and p.deleted_at is  null
        and p.visible = 1
        GROUP BY p.id');

      

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


        $aCarrito = DB::select('SELECT id, COUNT(*) AS count_carrito FROM carrito WHERE user_id = "'.$user.'" and product_id =  "'.$id.'"  GROUP BY id;');

        
        DB::insert('insert into carrito (product_id, user_id) values ("'.$id.'", "'.$user.'")');
        return view('frontend/product.index',compact('aCategories','aSubCategories','aProducts','aCarrito'));
    
        }
            
    
        public function carritoAction(Request $request,$id){

                $user=Auth::user()->id;
                $quantity = $request['quantity'];
                $CartRecord = CartModel::where('user_id','=',$user)
                ->where('product_id','=',$id)
                ->first();
                
                
                if(empty($CartRecord))
                {
                        
                        DB::insert('insert into carrito (product_id, user_id,status,quantity) values ("'.$id.'", "'.$user.'",1,"'.$quantity.'")');
                        
                }
                else{
                        
                        CartModel::where('user_id','=',$user)->where('product_id','=',$id)->forceDelete();
                }
                

                return back()->withInput();
        }

        public function changeProductQuantity(Request $request)
        {
                $user=Auth::user()->id;
                $aReturn = array();
                $oCart = CartModel::where('user_id','=',$user)->where('product_id','=',$request['product_id'])->first();

                if($oCart->quantity != $request['quantity'])
                {
                        $aReturn['price'] = $request['price'];
                        $aReturn['change'] = (intval($request['quantity']) - intval($oCart->quantity) );
                        $aReturn['product_id'] =  $request['product_id'];
                        $oCart->quantity = $request['quantity'];
                        $oCart->save();
                }
                else{
                        $aReturn['change'] = 0;
                }

                echo json_encode($aReturn);
        }

}
