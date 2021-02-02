<?php

namespace App\Http\Controllers\admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\ProvincesModel;
use App\Models\CategoriesModel;
use App\Models\ObjectivesModel;

class CategoriesController extends Controller {

    public function index() {

        $aCategories = CategoriesModel::get();
        
        return view('admin/categories.index',compact('aCategories'));
    }

    public function create() {

        return view('admin/categories.create');

    }

    public function store(Request $request) {

        $aValidations = array(
            
            'name' => 'required|max:60',
            'description' => 'required|max:150'
            
           
        );

        

        $this->validate($request, $aValidations);

        $userEmail = CategoriesModel::where('name', $request['name'])->first();

        if (!empty($userEmail->id)) {

            $error = \Illuminate\Validation\ValidationException::withMessages([
                        'duplicated_name_error' => ['DUPLICATED CATEGORIE']
            ]);

            throw $error;
        }   

        if(!empty($request['prom'])){
            $request['prom'] = ucwords($request['prom']);
           
        }
    
        $request['name'] = ucwords($request['name']);
        
        $request['description'] = ucwords($request['description']);
           
        CategoriesModel::create($request->all());

        return redirect()->route('categories.index')->with('success', 'Catgorias actualizado satisfactoriamente');
    }

    public function show($id) {
        //
    }

    public function edit($id) {

        $oCate = CategoriesModel::find($id);
        return view('admin/categories.edit', compact('oCate'));

    }

    public function update(Request $request, $id) {
        
        $aValidations = array(
            'name' => 'required|max:60',
            'description' => 'required|max:150'
        );
       

        $this->validate($request, $aValidations);

        $oCate = CategoriesModel::find($id);
          
        $request['name'] = ucwords($request['name']);
        $request['description'] = ucwords($request['description']);

        if(!empty($request['prom'])){

            $request['prom'] = ucwords($request['prom']);
            $oCate->prom = $request['prom'];

        }

        
        $oCate->name = $request['name'];
        $oCate->description = $request['description'];
               
        $oCate->save();

        return redirect()->route('categories.index')->with('success', 'Categoria actualizada satisfactoriamente');
    }

    public function destroy($id) {

        CategoriesModel::find($id)->delete();

        return redirect()->route('categories.index')->with('success', 'Categoria eliminada satisfactoriamente');
    }

    
    public function setCategoryVisible(Request $request){
        $aReturn = array();
        $oCategory = CategoriesModel::find($request['categoryId']);

        if (empty($oCategory->visible)) {
            $oCategory->visible = 1;
            $oCategory->visible_at = date('Y-m-d H:i:s');
        } else {
            $oCategory->visible = 0;
        }

        $oCategory->save();

        $aReturn['categoryId'] = $request['categoryId'];
        $aReturn['visible'] = $oCategory->visible;

        echo json_encode($aReturn);
    }
   

}
