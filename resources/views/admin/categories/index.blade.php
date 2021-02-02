@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/admin_custom.css">
<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('categories.index') }}">Categorias</a>
            </li>
            <li class="breadcrumb-item active">Todas las cateogiras</li>       
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Categorias
                <a class="createButton ml-5" href="{{ route('categories.create') }}" >@include('admin.widgets.button', array('class'=>'primary', 'value'=>'Crear'))</a>
            </div>         
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table class="table table-bordered" id="dataTable_user" width="100%" cellspacing="0">                        
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>                                
                                <th>Descripcion</th>
                                <th>Promoción</th>    

                                <th>Publicado</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @if(!empty($aCategories))
                            @foreach($aCategories as $cate)
                            <tr>
                                <td>{{ $cate->id }}</td>
                                <td>{{ $cate->name }}</td>
                                <td>{{ $cate->description }}</td>


                                @if(!empty($cate->prom))
                                <td>{{ $cate->prom }}</td>
@else
<td>{{ "Sin promociones" }}</td>
@endif
                                <td><a class="article_index_btn {{ $cate->visible == 1 ? ' article_index_btn_active' : '' }}" href="" onClick="setCategoryVisible('{{ $cate->id }}');"><i id="visible_icon_{{$cate->id}}" class="fas fa-eye"></i></a></td>
                                
                                <td><a class="btn btn-primary btn-circle" href="{{action('admin\CategoriesController@edit', $cate->id)}}"><i class="fa fa-list"></i></a></td>
                              
                                <td>
                                <form id="deleteForm_{{$cate->id}}" action="{{action('admin\CategoriesController@destroy', $cate->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="button" id="submiBtn" class="btn btn-warning btn-circle my-custom-confirmation" data-toggle="modal" onclick="openDelModal({{$cate->id}});"><i class="fa fa-times"></i></button>
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


    function setCategoryVisible(categoryId) {
        
        event.preventDefault();
       
        
        var params = new Object();
        params._token = "{{ csrf_token() }}";
        params.categoryId = categoryId;
        
        ajaxRequest("POST", "{{route('category_visible')}}", params, "setVisibleCategoryResponse");
    }
    
    function setVisibleCategoryResponse(data) {

        var btn = $('#visible_icon_' + data.categoryId);
        
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