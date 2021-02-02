@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <div class="container-fluid">
        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('user.index') }}">Usuarios</a>
            </li>
            <li class="breadcrumb-item active">Lista de Usuarios</li>       
        </ol>
        <!-- Example DataTables Card-->
        <div class="card mb-3">
            <div class="card-header">
                <i class="fa fa-table"></i> Usuarios
                <a class="createButton ml-5" href="{{ route('user.create') }}" >@include('admin.widgets.button', array('class'=>'primary', 'value'=>'Crear'))</a>
            </div>         
            <div class="card-body">
                <div class="table-responsive">
                    
                    <table class="table table-bordered" id="dataTable_user" width="100%" cellspacing="0">                        
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>                                
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Tipo</th>
                                <th>Creado</th>
                                <th>Editar</th>
                                <th>Eliminar</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            @if(!empty($aUsers))
                            @foreach($aUsers as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name . " ," . $user->last_name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->phone }}</td>
                                                                
                                @if($user->type == 1)
                                    <td>Adm.</td>
                                @else
                                    <td>Usr.</td>
                                @endif
                                <td>{{ $user->created_at }}</td>
                                <td><a class="btn btn-primary btn-circle" href="{{action('admin\UserController@edit', $user->id)}}"><i class="fa fa-list"></i></a></td>
                                <td>
                                    <form id="deleteForm_{{$user->id}}" action="{{action('admin\UserController@destroy', $user->id)}}" method="post">
                                        {{csrf_field()}}
                                        <input name="_method" type="hidden" value="DELETE">
                                        <button type="button" id="submiBtn" class="btn btn-warning btn-circle my-custom-confirmation" data-toggle="modal" onclick="openDelModal({{$user->id}});"><i class="fa fa-times"></i></button>
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

<script src="/assets/js/admin/user/datatables.js" crossorigin="anonymous"></script>

@endsection