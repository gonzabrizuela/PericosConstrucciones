@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('slider.index') }}">Sliders</a>
            </li>
            <li class="breadcrumb-item active">Nuevo slider</li>
        </ol>
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 margin-bottom-20" style="margin: 0 auto;">
                        <form method="POST" action="{{ route('slider.store') }}" role="form" enctype="multipart/form-data">
                            {{ csrf_field() }}
                           

                            <div class="form-group">
                                <label>Nombre</label>
                                <input id="name" name="name" maxlength="45" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" placeholder="Nombre:" value="{{ old('name') }}">
                                @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar un nombre valido.</strong>
                                </span>
                                @endif
                            </div>       
                            <div class="form-group">
                                <label>Descripcion</label>
                                <input id="description" name="description" maxlength="45" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" placeholder="Descripcion:" value="{{ old('description') }}">
                                @if ($errors->has('description'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar una descripcion valido.</strong>
                                </span>
                                @endif
                            </div>       
                            
                            <div class="form-group">
                                <label>Link</label>
                                <input id="link" name="link" maxlength="255" class="form-control{{ $errors->has('link') ? ' is-invalid' : '' }}" placeholder="Link:" value="{{ old('link') }}">
                                @if ($errors->has('link'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>Debe ingresar un link valido.</strong>
                                </span>
                                @endif
                            </div>         
                        
                            <label for="">Imagen</label>
                    <input type="file" class="form-control {{ $errors->has('slider_image') ? ' is-invalid' : '' }}" name="slider_image" id="slider_image">
                    @if ($errors->has('slider_image'))
                            <span id="slider_image_error_lrv" class="invalid-feedback" role="alert" style="display:block;">
                                <strong>Debe cargar una imagen ( .jpeg, .jpg, .png, .gif ).</strong>
                            </span>
                            @endif
                            <span id="slider_image_error" class="invalid-feedback" role="alert" style="display:none;">
                                <strong>Debe cargar una imagen ( .jpeg, .jpg, .png, .gif ).</strong>
                            </span>
                         
                            <div id="preview_slider_image" class="mt-2" style=" display:none;"></div> 


                  

                            <button type="submit" class="mt-3 btn btn-primary">Agregar foto</button>
                            <button type="reset" class="mt-3 btn btn-default">Reset</button>
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



<script src="/js/admin/image_preview.js"></script>
<script>
    $('#slider_image').change(function() {
        setImagePreview(this, $(this).attr('id'));
    });
</script>


@endsection