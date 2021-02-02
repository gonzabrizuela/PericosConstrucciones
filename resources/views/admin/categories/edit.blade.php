@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('categories.index') }}">Categorías</a>
            </li>
            <li class="breadcrumb-item active">Edici&oacute;n de Categoria</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 margin-bottom-20" style="margin: 0 auto;">
                        <form method="POST" action="{{ route('categories.update', $oCate->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">

                            

                            
                            <div class="form-group">
                                <label>Nombre</label>
                                <input id="name" name="name" maxlength="250" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre:" value="{{ $oCate->name }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar un nombre valido.</strong>
                                </span>
                                @endif
                            </div>       


                            <div class="form-group">
                                <label>Descripcion</label>
                            <textarea  id="description" name="description" maxlength="250" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Descripcion:" >{{$oCate->description}}</textarea>
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar una descripcion valida.</strong>
                                </span>
                                @endif
                            </div>   
                            





                            <div style="width:100%;float:left;"><h4 class="text-secondary"> Agregar promoción</h4></div>
<input type="button" value="Yes" onclick="ShowHideDiv(this)" />
<input type="button" value="No" onclick="ShowHideDiv(this)" />
<hr />
<div id="dvPassport" style="display: none">
<div class="form-group col-12 col-md-6">
                                    
    <label>PROMOCION</label>
                                    <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text" id="basic-addon1">%</span>
                                    </div>
                                    <input type="number" id="prom" name="prom" maxlength="250" class="form-control{{ $errors->has('prom') ? ' is-invalid' : '' }}" placeholder="Promoción:" value="{{ $oCate->prom }}">
                                    @if ($errors->has('prom'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Debe ingresar un promoción valido.</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>       
</div>    



                         

                          
                            
                            <button type="submit" class="btn btn-primary">Editar Producto</button>
                            <button type="reset" class="btn btn-default">Reset</button>
                        </form>
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

<script>
    var productsubcat = "<?php echo $oCate->subcategory_id; ?>";
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

@endsection