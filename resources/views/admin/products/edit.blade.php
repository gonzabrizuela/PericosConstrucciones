@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/admin/products_edit.css">
<?php $product_id = $oProduct->id;
?>

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}">Productos</a>
            </li>
            <li class="breadcrumb-item active">Edici&oacute;n de Producto</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 margin-bottom-20" style="margin: 0 auto;">
                    <form method="POST" action="{{ route('products.update', $oProduct->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">

                            

                            
                            <div class="form-group">
                                <label>Nombre</label>
                                <input id="name" name="name" maxlength="250" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre:" value="{{ $oProduct->name }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar un nombre valido.</strong>
                                </span>
                                @endif
                            </div>       

                            <div class="row">

                                <div class="form-group col-12 col-md-6">
                                    <label>Categoria</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        @foreach ($aCategories as $category)
                                            <option {{$oProduct->category_id == $category->id ? "selected" : ""}} value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Debe seleccionar una categoria valida.</strong>
                                    </span>
                                    @endif
                                </div>       

                                {{-- ajax --}}

                                <div class="form-group col-12 col-md-6">
                                    <label>Subcategoria</label>
                                    <select class="form-control" name="subcategory_id" id="subcategory_id">

                                    </select>
                                    @if ($errors->has('category'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Debe seleccionar una categoria valida.</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-12 col-md-6">
                                    <label>Precio</label>
                                    <div class="input-group"> 
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">$</span>
                                        
                                      </div>
                                    <input type="number" id="price" name="price" maxlength="250" class="form-control{{ $errors->has('price') ? ' is-invalid' : '' }}" placeholder="Precio:" value="{{ $oProduct->price }}">
                                </div>
                                    @if ($errors->has('price'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Debe ingresar un precio valido.</strong>
                                    </span>
                                    @endif
                                </div>       

                                <div class="form-group col-12 col-md-6">
                                    <label>Stock Actual</label>
                                    <input type="number" id="stock" name="stock" maxlength="250" class="form-control{{ $errors->has('stock') ? ' is-invalid' : '' }}" placeholder="Unidades en Stock:" value="{{ $oProduct->stock }}">
                                    @if ($errors->has('stock'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Debe ingresar un stock valido.</strong>
                                    </span>
                                    @endif
                                </div>       

                            </div>

                            <div class="form-group">
                                <label>Descripcion</label>
                            <textarea  id="description" name="description" maxlength="250" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Descripcion:" >{{$oProduct->description}}</textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar una descripcion valida.</strong>
                                </span>
                                @endif
                            </div>   
                            
                                   
                            <div class="form-group">
                                <label>Destacado</label>
<!--                                 
                                <input id="news" name="news" maxlength="250" class="form-control{{ $errors->has('news') ? ' is-invalid' : '' }}" placeholder="Promociones: (Opcional)" value="{{ old('news') }}">
                                 -->
                                 <input type="hidden" name="news" value="0">
<input type="checkbox" name="news" value="1">

           
                                <!-- @if ($errors->has('news'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar una promoción valido.</strong>
                                </span>
                                @endif -->
                            </div>            
                            
                           
  

                          
                            <div class="text-center">
                            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </div>
                        </form>
                        
                        <div class="row mt-5">
                            @if (!empty($aImages))
                            <div class="col-12 text-center  border-bottom"><h5>Fotos del Producto</h5></div>
                            @foreach ($aImages as $image)
                                <div class="col mt-4">
                                    
                                    <form id="deleteForm_{{$image->id}}" action="{{route('deleteImage', $image->id)}}" method="post">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <div class="deleteImage">
                                            <a href="#" data-toggle="modal" class="font-weight-bold" onclick="openDelModal({{$image->id}});" style="color:#343A40;text-decoration:none;font-size:25px;z-index:2;">×</a>
                                        </div>
                                        @if ($image->type == 0)
                                            
                                        <div class="pinImage" id="">
                                            <a href="#" id="pinIcon_{{$image->id}}" onclick="setMainImage({{$image->id}});" style="@if($image->main_image == 1)color:#25890f ;@endif"><i class="fas fa-thumbtack"></i></a>
                                        </div>
                                        @endif
                                        
                                        
                                        @if ($image->type==0)
                                    <img style="width: 200px" id="image_{{$image->id}}" src="/uploads/products/{{$image->image}}" alt="">
                                    @endif
                                    @if ($image->type==1)
                                        <video style="width: 200px;z-index:2;" src="/uploads/products/{{$image->image}}" controls>
                                            Your browser does not support HTML5 video.
                                        </video>
                                    @endif
                                    </form>
                                    
                                    
                                </div>
                            @endforeach
                                
                            @endif
                                <div class="col-12 mt-5 text-center">
                                    <a  class=" m-auto createButton" data-toggle="modal" data-target="#imageModal" >@include('admin.widgets.button', array('class'=>'primary', 'value'=>'Cargar Imagen'))</a>
                                    <a  class=" m-auto createButton" data-toggle="modal" data-target="#videoModal" >@include('admin.widgets.button', array('class'=>'primary', 'value'=>'Cargar Video'))</a>
                                </div>
                        </div>
                        <div class="col  offset-md-10">
                            <a href="{{route('products.index')}}" class=" btn btn-primary">Finalizar<i class="fas ml-1 fa-angle-right"></i></a>
                        </div>
                    </div>
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

<script type="text/javascript">
    function ShowHideDiv(btnPassport) {
        var dvPassport = document.getElementById("dvPassport");
        dvPassport.style.display = btnPassport.value == "Yes" ? "block" : "none";
    }
</script>

<script type="text/javascript">

    function openDelModal(id) {
        formId = id;
        $('#deleteModal').modal('show');
    }

</script>

<script>
    var productsubcat = "<?php echo $oProduct->subcategory_id; ?>";
    $(document).ready(function () {
        var category_id = $('#category_id').val(); 
        
        if(category_id > 0){
            setSub_categoryVal(category_id, '#subcategory_id', "{{ url('getSub_CategoriesByCategory')}}", "Sub-Categoria", "{{ old('subcategory_id') }}");       
        }

    });
   
    $('#category_id').change(function(){                      
    setSub_categories($(this).val(), '#subcategory_id', "{{ url('getSub_CategoriesByCategory')}}", "Sub-Categoria");
});
    
function setSub_categories(value, formSelect, url, defVal) { 

if(value < 1 || value == ""){
$(formSelect).empty();
$(formSelect).append("<option value=''>" + defVal + "</option>");
$(formSelect).prop('disabled', true);
return true;
}

$.get(url,
{ option: value },
function(data) {                     
    $(formSelect).empty();
    $(formSelect).prop('disabled', false);
    $(formSelect).append("<option value=''>" + defVal + "</option>");
    $.each(data, function(key, element) {
        $(formSelect).append("<option value='" + key + "'>" + element + "</option>");
    });
});
}
function setSub_categoryVal(value, formSelect, url, defVal, selectedItem){
    
    if(value < 1){
    $(formSelect).empty();
    $(formSelect).append("<option value=''>" + defVal + "</option>");
    $(formSelect).prop('disabled', true);
    return true;
    }
    
    $.get(url,
    { option: value },
    function(data) {                              
        $(formSelect).empty();
        $(formSelect).prop('disabled', false);
        $(formSelect).append("<option value=''>" + defVal + "</option>");
        $.each(data, function(key, element) {
            if(key == selectedItem){
                $(formSelect).append("<option selected value='" + key + "'>" + element + "</option>");
            }else{
                $(formSelect).append("<option value='" + key + "'>" + element + "</option>");
            }                             
        });
    });
    }
    

    
</script>

{{-- AJAX --}}

<script>

    
    
function setMainImage(image_id) {
        
        event.preventDefault();
       
        
        var params = new Object();
        params._token = "{{ csrf_token() }}";
        params.image_id = image_id;
        
        ajaxRequest("POST", "{{route('setMainImage')}}", params, "setMainImageResponse");
    }
    
    function setMainImageResponse(data) {

        images = <?php echo json_encode($aImages, JSON_NUMERIC_CHECK); ?>;
        
        for (const image of images) {
            if(image.id == data.image_id)
            {
                $('#pinIcon_'+image.id).css('color','#25890f');
            }
            else{
                $('#pinIcon_'+image.id).css('color','#343a40');
            }
        }

    }
    
    function ajaxRequest(type, url, params, callBack) {

        jQuery.support.cors = true;
        params = JSON.stringify(params);

        $.ajax({
            type: type,
            url: url,
            data: params,
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            beforeSend: function () {
                //$('#ajaxLoader').show();
            },
            complete: function () {
                //$('#ajaxLoader').hide();
            },
            success: function (data) {
               //console.log("REQUEST [ " + type + " ] [ " + url + " ] SUCCESS");
               //console.log(data);
                window[callBack](data);
            },
            error: function (msg, url, line) {
               //console.log('ERROR !!! msg = ' + msg + ', url = ' + url + ', line = ' + line);
            }
        });
    }


</script>


<script src="/js/admin/image_preview.js"></script>
<script src="/js/admin/video_preview.js"></script>
<script>

$('#video').change(function() {
        setVideoPreview(this, $(this).attr('id'));
    });

    $('#image').change(function() {
        setImagePreview(this, $(this).attr('id'));
    });
    
</script>

@endsection