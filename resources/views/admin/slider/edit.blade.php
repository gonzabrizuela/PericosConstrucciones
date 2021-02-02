@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('slider.index') }}">Slider</a>
            </li>
            <li class="breadcrumb-item active">Edici&oacute;n de Slider</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 margin-bottom-20" style="margin: 0 auto;">
                        <form method="POST" action="{{ route('slider.update', $oSlider->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">

                      








                            <div class="form-group">
                                <label>Nombre</label>
                                <input id="name" name="name" maxlength="45" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre:" value="{{ $oSlider->name }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar un nombre valido.</strong>
                                </span>
                                @endif
                            </div>       
                            <div class="form-group">
                                <label>Descripcion</label>
                                <input id="description" name="description" maxlength="45" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Descripcion:" value=" {{ $oSlider->description }}">
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar una descripcion valido.</strong>
                                </span>
                                @endif
                            </div>       
                            
                            <div class="form-group">
                                <label>Link</label>
                                <input id="link" name="link" maxlength="255" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" placeholder="Link:" value="{{ $oSlider->link }}">
                                @if ($errors->has('link'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar un link valido.</strong>
                                </span>
                                @endif
                            </div>       


                            @if (!empty($oSlider->image))
                            <div class="col-12 text-center  border-bottom"><h5>Imagen</h5></div> 
                            <div class="col 12">
                            <img style="width: 200px" class="m-auto" src="/uploads/slider/{{$oSlider->image}}" alt="">
                            </div>
                            <div class="col-12 text-center  border-bottom"><h5>Nueva Imagen</h5></div> 

                            <input type="file" class="form-control {{ $errors->has('slider_image') ? ' is-invalid' : '' }}" name="slider_image" id="slider_image">
                            @if(!empty('slider_image'))
                    @if ($errors->has('slider_image'))
                            <span id="slider_image_error_lrv" class="invalid-feedback" role="alert" style="display:block;">
                                <strong>Debe cargar una imagen ( .jpeg, .jpg, .png, .gif ).</strong>
                            </span>
                            @endif
                           
                            <span id="slider_image_error" class="invalid-feedback" role="alert" style="display:none;">
                                <strong>Debe cargar una imagen ( .jpeg, .jpg, .png, .gif ).</strong>
                            </span>
                            @endif
                            <div id="preview_slider_image" class="mt-2" style=" display:none;"></div> 
                            @endif
                           



                   

                            <button type="submit" class="mt-3 btn btn-primary">Editar slider</button>
                            <button type="reset" class="mt-3  btn btn-default">Reset</button>
                        </form>


               
                </div>
                <br /><br />
            </div>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright ©  2019</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>

    @include('layouts.modals')
</div>

<script>

   
    
 

function(data) {                              
        $(formSelect).empty();
        $(formSelect).prop('disabled', false);
        $(formSelect).append("<option value=''>" + defVal + "</option>");
        $.each(data, function(key, element) {
            if(key == selectedItem){
                $(formSelect).append("<option selected value='" + key + "'>" + element + "</option>");
            }else{
                if(usercity==key)
                {
                $(formSelect).append("<option selected value='" + key + "'>" + element + "</option>");
                }
                else
                {
                $(formSelect).append("<option  value='" + key + "'>" + element + "</option>");
                }
            }                             
        });
});
}
    
    $( "#name" ).keyup(function() {             
       setInitials();  
    });
    
    $( "#last_name" ).keyup(function() {             
       setInitials();  
    });
    
    function setInitials() {
        $( "#initials" ).val($('#name').val().charAt(0).toUpperCase() + $('#last_name').val().charAt(0).toUpperCase());
    }
    
</script>

@endsection