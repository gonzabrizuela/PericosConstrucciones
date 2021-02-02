<?php

namespace App\Http\Controllers;
use App\Models\CategoriesModel;
use Illuminate\Http\Request;
use App\Models\SubModel;
use DB;
class HeaderController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
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




    

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


}
