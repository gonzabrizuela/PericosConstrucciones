<?php

namespace App\Http\Controllers\admin;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

use App\Models\SliderModel;


class SliderController extends Controller {

    public function index() {

        $aSliders = SliderModel::get();
        
        return view('admin/slider.index',compact('aSliders'));
    }

    public function create() {

        return view('admin/slider.create');
    }

    public function store(Request $request) {
        
        $aValidations = array(
            
            'name' => 'required|max:45',
            'description' => 'required|max:45',
            'slider_image' => 'required|max:10240|mimes:jpeg,png,jpg,gif',
            'link' => 'max:255'
            
           
        );

        

        $this->validate($request, $aValidations);
    
        $request['name'] = ucwords($request['name']);
        
        $request['description'] = ucwords($request['description']);
           
        $image = $request['slider_image'];  

        $fileName = $image->getClientOriginalName();
        $storeImageName = uniqid(rand(0, 1000), true) . "-" . $fileName;
        $fileExtension = $image->getClientOriginalExtension();
        $realPath = $image->getRealPath();
        $fileSize = $image->getSize();
        $fileMimeType = $image->getMimeType();
        

        $destinationPath = 'uploads/slider';
        $image->move($destinationPath, $storeImageName);

        $data=array('link' => $request['link'],'image' => $storeImageName, 'name' => $request['name'],'description' => $request['description'],'created_at' => now() ,'updated_at' => now());
        SliderModel::insert($data);

        return redirect()->route('slider.index')->with('success', 'Slider actualizado satisfactoriamente');
    }

    public function show($id) {
        //
    }

    public function edit($id) {
        $oSlider = SliderModel::find($id);
        return view('admin/slider.edit', compact('oSlider'));
    }

    public function update(Request $request, $id) {
        $oSlider = SliderModel::find($id);
        $aValidations = array(
            
            'name' => 'required|max:45',
            'description' => 'required|max:45',
           
            'link' => 'max:255'
           
        );


        $this->validate($request, $aValidations);
    if(!empty($request['name'])){
        $request['name'] = ucwords($request['name']);
    }
        
        if(!empty($request['description'])){
            $request['description'] = ucwords($request['description']);
        }
       
        if(!empty($request['slider_image'])){

            $aValidations = array(
            
               
                'slider_image' => 'required|max:10240|mimes:jpeg,png,jpg,gif',
               
               
            );


            $this->validate($request,$aValidations);


            $image = $request['slider_image'];  

            $fileName = $image->getClientOriginalName();
            $storeImageName = uniqid(rand(0, 1000), true) . "-" . $fileName;
            $fileExtension = $image->getClientOriginalExtension();
            $realPath = $image->getRealPath();
            $fileSize = $image->getSize();
            $fileMimeType = $image->getMimeType();
            
    
            $destinationPath = 'uploads/slider';
            $image->move($destinationPath, $storeImageName);
            $oSlider->image = $storeImageName;
        }
      
        $oSlider->name = $request['name'];
        $oSlider->link = $request['link'];

        $oSlider->description = $request['description'];
      
        $oSlider->save();

     

        return redirect()->route('slider.index')->with('success', 'Slider actualizado satisfactoriamente');

    }

    public function destroy($id) {

        SliderModel::find($id)->delete();

        return redirect()->route('slider.index')->with('success', 'Categoria eliminada satisfactoriamente');
    }

   

}
