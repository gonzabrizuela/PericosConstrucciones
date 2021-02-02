@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="/css/admin_custom.css">
<div class="content-wrapper">
    
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('slider.index') }}">Sliders</a>
            </li>
            <li class="breadcrumb-item active">Todos los sliders</li>       
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Sliders
                <a class="createButton ml-5" href="{{route('slider.create')}}" >@include('admin.widgets.button', array('class'=>'primary', 'value'=>'Agregar'))</a>
            </div>         
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table class="table table-bordered" id="dataTable_user" width="100%" cellspacing="0">                        
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>                                
                                <th>Descripcion</th>
                                <th>Link</th>
                                <th>Imagen</th>
                                <th>Publicado</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @if(!empty($aSliders))
                            @foreach($aSliders as $slider)
                            <tr>
                                <td>{{ $slider->id }}</td>
                                <td>{{ $slider->name }}</td>
                                <td>{{ $slider->description }}</td>
                                <td>{{$slider->link}}</td>
                                <td><img src="/uploads/slider/{{$slider->image}}" style="width:100px;margin:0 auto;" alt=""></td>
                                <td>{{$slider->created_at}}</td>
                                <td><a class="btn btn-primary btn-circle" href="{{action('admin\SliderController@edit',$slider->id)}}"><i class="fa fa-list"></i></a></td>

                                <td>
                                <form id="deleteForm_{{$slider->id}}" action="{{action('admin\SliderController@destroy', $slider->id)}}" method="POST">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="button" id="submiBtn" class="btn btn-warning btn-circle my-custom-confirmation" data-toggle="modal" onclick="openDelModal({{$slider->id}});"><i class="fa fa-times"></i></button>
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


   
    


</script>
<script src="/js/admin/image_preview.js"></script>

    

<script src="/assets/js/admin/user/datatables.js" crossorigin="anonymous"></script>

@endsection