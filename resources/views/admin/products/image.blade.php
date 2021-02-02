@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}">Imagen</a>
            </li>
            <li class="breadcrumb-item active">Nueva imagen</li>       
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
               
              <div class="table-responsive">

          
                <a class="m-auto createButton" data-toggle="modal" data-target="#imageModal" >@include('admin.widgets.button', array('class'=>'primary', 'value'=>'Cargar Imagen'))</a>
                <a class="m-auto createButton" data-toggle="modal" data-target="#videoModal" >@include('admin.widgets.button', array('class'=>'primary', 'value'=>'Cargar Video'))</a>
                
           </div>   
            </div>         
             <div class="card-body">
                <div class="table-responsive">
                    
                    <table class="table table-bordered" id="dataTable_user" width="100%" cellspacing="0">                        
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Producto</th> 
                                <th>Tipo</th>                               
                                <th>Imagen</th>  
                                <th>Imagen Principal</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        
                         <tbody>
                            @if(!empty($aImages))
                            @foreach($aImages as $image)
                            <tr>
                                <td>{{ $image->id }}</td>
                                <td>{{$image->product_name}}</td>
                                @if ($image->type==0)
                                <td>Imagen</td>
                                @else
                                <td>Video</td>
                                @endif

                
                             
                               
                                @if ($image->type==0)
                                <td><img src="/uploads/products/{{$image->image}}" style="width:100px;margin:0 auto;" alt=""></td>
                                @else
                                <td><video style="width: 100px;margin:0 auto;" src="/uploads/products/{{$image->image}}" >
                                    Your browser does not support HTML5 video.
                                </video></td>
                                @endif
                                @if($image->type == 0)
                                <td> <button type="button" id="pinBtn_{{$image->id}}" class="btn @if($image->main_image == 0) btn-light @else btn-success @endif btn-circle my-custom-confirmation" data-toggle="modal" onclick="setMainImage({{$image->id}});"><i class="fas fa-thumbtack"></i></button></td>
                                @else
                                <td></td>
                                @endif
                                  <td>
                          
                                    <form id="deleteForm_{{$image->id}}" action="{{route('deleteImage',$image->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="button" id="submiBtn" class="btn btn-warning btn-circle my-custom-confirmation" data-toggle="modal" onclick="openDelModal({{$image->id}});"><i class="fa fa-times"></i></button>
                                    </form>                
                                </td>
                            </tr>   
                            @endforeach
                            @endif
                        </tbody> 
                    </table>
                    
                </div>
            </div>
            <div class="card-footer small text-muted"></div>
            
        </div>
        <div class="row mt-5">
            <div class="col  offset-md-10">
        <a href="{{route('products.index')}}" class=" btn btn-primary">Finalizar<i class="fas ml-1 fa-angle-right"></i></a>
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

    function openDelModal(id) {
        formId = id;
        $('#deleteModal').modal('show');
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
                    $('#pinBtn_'+image.id).removeClass('btn-light');
                    $('#pinBtn_'+image.id).addClass('btn-success');
                }
                else{
                    $('#pinBtn_'+image.id).removeClass('btn-success');
                    $('#pinBtn_'+image.id).addClass('btn-light');
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

<script src="/assets/js/admin/user/datatables.js" crossorigin="anonymous"></script>

@endsection