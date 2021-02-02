@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('sub.index') }}">Sub-Categorias</a>
            </li>
            <li class="breadcrumb-item active">Edici&oacute;n de Sub-Categorias</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 margin-bottom-20" style="margin: 0 auto;">
                        <form method="POST" action="{{ route('sub.update', $oSub->id) }}" role="form"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <input name="_method" type="hidden" value="PATCH">

                            <div class="row">

                                <div class="form-group col-md">
                                    <label>Nombre</label>
                                    <input id="name" name="name" maxlength="60"
                                        class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                                        placeholder="Nombre" value="{{ $oSub->name }}">
                                    @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Debe ingresar un nombre.</strong>
                                    </span>
                                    @endif
                                </div>

                                <div class="form-group col-md">
                                    <label>Descripcion</label>
                                    <input id="description" name="description" maxlength="60"
                                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                                        placeholder="description" value="{{ $oSub->description }}">
                                    @if ($errors->has('description'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Debe ingresar una descripcion correcta.</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group ">
                                    <label>Categoria</label>
                                    <select class="form-control" name="category_id" id="category_id">
                                        @foreach ($aCategories as $category)
                                            <option value="{{$category->id}}">{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('category_id'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Debe seleccionar una categoria valida.</strong>
                                    </span>
                                    @endif
                                </div>               

                            </div>

                    


                          

                    

                            <button type="submit" class="btn btn-primary">Editar Usuario</button>
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

<script>
    var usercity = "<?php echo $oSub->city_id; ?>";
    $(document).ready(function () {
        var provinceId = $('#province_id').val(); 
        
        if(provinceId > 0){
            setCityVal(provinceId, '#city_id', "{{ url('getCitiesByProvince')}}", "Ciudad", "{{ old('city_id') }}");       
        }

    });
   
    
    $('#province_id').change(function(){                      
        setCity($(this).val(), '#city_id', "{{ url('getCitiesByProvince')}}", "Ciudad");
    });

    
    function setCity(value, formSelect, url, defVal) { 

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

function setCityVal(value, formSelect, url, defVal, selectedItem){
        
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