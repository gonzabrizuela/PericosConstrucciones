<?php
namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SubModel;
use App\Models\ProductsModel;
use App\Models\CategoriesModel;

use Auth;
use App\User;
use DB;
class SubController extends Controller{

    public function index(){

        $aCategories = CategoriesModel::get();
        $aSub = SubModel::select('sub_categories.*','categories.name as category_name')->leftjoin('categories','sub_categories.category_id','=','categories.id')->get();
        return view('admin/sub.index',compact('aSub'));

    }

  
    public function create() {

        $aCategories = CategoriesModel::get();
        return view('admin/sub.create',compact('aCategories'));

    }


    public function store(Request $request) {

        $aValidations = array(
            
            'name' => 'required|max:60',
            'description' => 'required|max:150',
            'category_id' => 'required|max:60'
           
        );

        

        $this->validate($request, $aValidations);

        $userEmail = SubModel::where('name', $request['name'])->first();

        if (!empty($userEmail->id)) {

            $error = \Illuminate\Validation\ValidationException::withMessages([
                        'duplicated_name_error' => ['DUPLICATED CATEGORIE']
            ]);

            throw $error;
        }   

    
        $request['name'] = ucwords($request['name']);
        
        $request['description'] = ucwords($request['description']);
        $request['category_id'] = ucwords($request['category_id']);
     
        SubModel::create($request->all());

        return redirect()->route('sub.index')->with('success', 'SubCatgorias actualizado satisfactoriamente');
    }


    public function show($id) {
        //
    }


    public function edit($id) {
        $aCategories = CategoriesModel::get();
        $oSub = SubModel::find($id);
        return view('admin/sub.edit', compact('oSub','aCategories'));
    }


    public function update(Request $request, $id) {
        
        $aValidations = array(
            
            'name' => 'required|max:60',
            'description' => 'required|max:150'
        );

        
       

        $this->validate($request, $aValidations);

        $oSub = SubModel::find($id);
          
        $request['name'] = ucwords($request['name']);
        $request['description'] = ucwords($request['description']);
        $request['category_id'] = ucwords($request['category_id']);

        $oSub->name = $request['name'];
        $oSub->description = $request['description'];
         $oSub->category_id = $request['category_id'];
      
        
        $oSub->save();

        return redirect()->route('sub.index')->with('success', 'Sub-Categoria actualizado satisfactoriamente');
    }



    public function destroy($id) {

        SubModel::find($id)->delete();

        return redirect()->route('sub.index')->with('success', 'Registro eliminado satisfactoriamente');
    }
    
    
    public function getSub_CategoriesByCategory(Request $request){
        $categoryId = $request['option'];
        $aSub_categories = SubModel::where('category_id', $categoryId)->orderBy('name', 'asc')->get();

        return $aSub_categories->pluck('name', 'id');
    }

    public function setSubcategoryVisible(Request $request){
        $aReturn = array();
        $oSubcategory = SubModel::find($request['subcategoryId']);

        if (empty($oSubcategory->visible)) {
            $oSubcategory->visible = 1;
            $oSubcategory->visible_at = date('Y-m-d H:i:s');
        } else {
            $oSubcategory->visible = 0;
        }

        $oSubcategory->save();

        $aReturn['subcategoryId'] = $request['subcategoryId'];
        $aReturn['visible'] = $oSubcategory->visible;

        echo json_encode($aReturn);
    }


}
















?>