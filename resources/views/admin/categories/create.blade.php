@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('categories.index') }}">Categorías</a>
            </li>
            <li class="breadcrumb-item active">Nuevo categoría</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 margin-bottom-20" style="margin: 0 auto;">
                        <form method="POST" action="{{ route('categories.store') }}" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                           

                            <div class="form-group">
                                <label>Nombre</label>
                                <input id="name" name="name" maxlength="250" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre:" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar un nombre valido.</strong>
                                </span>
                                @endif
                            </div>       
                            <div class="form-group">
                                <label>Descripcion</label>
                                <input id="description" name="description" maxlength="250" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Descripcion:" value="{{ old('description') }}">
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar una descripcion valido.</strong>
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
                                    <input type="number" id="prom" name="prom" maxlength="250" class="form-control{{ $errors->has('prom') ? ' is-invalid' : '' }}" placeholder="Promoción:" value="{{ old('prom') }}">
                                    @if ($errors->has('prom'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>Debe ingresar un promoción valido.</strong>
                                    </span>
                                    @endif
                                </div>
                                </div>       
</div>    


                  

                            <button type="submit" class="btn btn-primary">Agregar categoria</button>
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
                <small>Copyright Â© BMC 2019</small>
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


@endsection