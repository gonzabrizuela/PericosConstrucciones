@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/admin_custom.css">
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('products.index') }}">Productos</a>
            </li>
            <li class="breadcrumb-item active">Todos los productos</li>       
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Productos
                <a class="createButton ml-5" href="{{ route('products.create') }}" >@include('admin.widgets.button', array('class'=>'primary', 'value'=>'Crear'))</a>
            </div>         
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table class="table table-bordered" id="dataTable_user" width="100%" cellspacing="0">                        
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>                                
                                <th>Descripcion</th>  
                                <th>Categoria</th>
                                <th>Subcategoria</th>
                                <th>Precio</th>
                                <th>Destacados</th>     
                                <th>Stock</th>  
                                <th>Visible</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @if(!empty($aProducts))
                            @foreach($aProducts as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{!! $product->description !!}</td>
                                <td>{{ $product->category_name }}</td>
                                <td>{{ $product->subcategory_name}}</td>
                                <td>{{ $product->price }}</td>
                                @if ($product->news == 1)     
                                <td>{{ "Destacado" }}</td>
                                @else                     
                                <td>{{ "Sin destacar" }}</td>
                                @endif  

                                
                               
                                
                                <td>{{ $product->stock }}</td>
                                <td><a class="article_index_btn {{ $product->visible == 1 ? ' article_index_btn_active' : '' }}" href="" onClick="setProductVisible('{{ $product->id }}');"><i id="visible_icon_{{$product->id}}" class="fas fa-eye"></i></a></td>
                            <td><a class="btn btn-primary btn-circle" href="{{action('admin\ProductsController@edit',$product->id)}}"><i class="fa fa-list"></i></a></td>
                                <td>
                                    <form id="deleteForm_{{$product->id}}" action="{{action('admin\ProductsController@destroy', $product->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="button" id="submiBtn" class="btn btn-warning btn-circle my-custom-confirmation" data-toggle="modal" onclick="openDelModal({{$product->id}});"><i class="fa fa-times"></i></button>
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


    
    function setProductVisible(productId) {
        
        event.preventDefault();
       
        
        var params = new Object();
        params._token = "{{ csrf_token() }}";
        params.productId = productId;
        
        ajaxRequest("POST", "{{route('product_visible')}}", params, "setVisibleProductResponse");
    }
    
    function setVisibleProductResponse(data) {

        var btn = $('#visible_icon_' + data.productId);
        
        if(data.visible > 0) {
            btn.css('color', '#a7d158');
        } else {
            btn.css('color', '#343a40');
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