@extends('frontend/layouts.app')






@section('content')
<link rel="stylesheet" href="/css/frontend/profile.css">
<div class="mt-2 container-fluid">


  <div class="row pt-5 mb-5 justify-content-center text-right">

    <div class="col ">
      <h2 style="font-size: 25px;color:#000;" class="font-weight-bold text-center">Perfil</h2>

    </div>

  </div>
  <div class="container">
    <div class="row">
      <div class="col-12 col-md-5 ">
        <h5 class="section-name float-left">Datos personales</h5><i onclick="showInputs()"
          class="edit-icon text-right float-right far fa-edit"></i>
          <form method="POST" action="{{ route('profile_update') }}" role="form"
          enctype="multipart/form-data">
          @csrf
          <input type="text" name="name" class="{{ $errors->has('name') ? ' is-invalid' : '' }}" id="name" disabled value="{{Auth::user()->name}}">
          <input type="text" name="last_name" class="{{ $errors->has('last_name') ? ' is-invalid' : '' }}" id="last_name" disabled value="{{Auth::user()->last_name}}">
          <input type="text" name="phone" class="{{ $errors->has('phone') ? ' is-invalid' : '' }}" id="phone" disabled value="{{Auth::user()->phone}}">
          <input type="email" name="email" id="email" disabled value="{{Auth::user()->email}}">
        
      </div>
      <div class="col-12 col-md-5 offset-md-2">
        <h5 class="section-name">Mis direcciones</h5>
        <input type="text" name="name" id="name" disabled value="Direccion 1 - Av Luis Maria Campos">
        <input type="text" name="name" id="name" disabled value="Direccion 2s - Av Luis Maria Campos">
      </div>
      <div class="col-12 mt-5">
        <div class="btn-confirm">
          <button type="submit" class="btn shop-btn">CONFIRMAR CAMBIOS</button>
        </div>
      </div>
    </form>
    </div>
  </div>
  {{-- <div class="card mt-5 mt-md-1">

    <h5 class="card-header"> Datos Personales <a href="" class="float-right" onclick="showInputs()"><i
          class="ml-3     text-secondary far fa-edit"></i></a></h5>
    <div class="card-body">
      <div class="row">
        <form method="POST" style="width: 100%" action="{{ route('profile_update') }}" role="form"
  enctype="multipart/form-data">
  @csrf
  <div class="col-12 mt-3">
    <h5 class="d-inline-block"><span class="font-weight-bold"> Nombre: </span> {{Auth::user()->name}}</h5>
    <input style="width:30%;display:none !important;"
      class="d-inline-block ml-4 form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name"
      type="text">
  </div>
  <div class="col-12 mt-3">
    <h5 class="d-inline-block"><span class="font-weight-bold"> Apellido:</span> {{Auth::user()->last_name}}
    </h5><input style="width:30%;display:none !important;"
      class="d-inline-block ml-4 form-control {{ $errors->has('last_name') ? ' is-invalid' : '' }}" name="last_name"
      id="last_name" type="text">
  </div>
  <div class="col-12 mt-3">
    <h5 class=""><span class="font-weight-bold"> E-mail: </span> {{Auth::user()->email}}
      @if (Auth::user()->email_verified_at != null)
      <i style="color: #238AE6" class="fa fa-check-circle" aria-hidden="true"></i>
      @else
      <a href="../email/verify">Verificar E-mail</a>
      @endif
    </h5>
  </div>
  <div class="col-12 mt-3">
    <h5 class="d-inline-block"><span class="font-weight-bold"> Telefono: </span> {{Auth::user()->phone}}</h5>
    <input style="width:30%;display:none !important;"
      class="d-inline-block ml-4 form-control {{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" id="phone"
      type="number">
  </div>
  <button type="submit" id="btnConfirm" style="display: none" class="ml-2 mt-3 btn btn-primary">Confirmar
    cambios</button>

  </form>
</div>
</div>

</div> --}}

{{-- 
  <div class="card mt-3">

    <h5 class="card-header">Mis Direcciones</h5>
    <div class="card-body">
      <div class="row">
        <form method="POST" style="width: 100%" action="{{ route('profile_update') }}" role="form"
enctype="multipart/form-data">
@csrf
<div class="col-12 mt-3">
  <h5 class="d-inline-block"><span class="font-weight-bold">Direccion 1: </span> <a href="" onclick=""><i
        class="ml-3     text-secondary fas fa-times"></i></a> </h5> <input style="width:30%;display:none !important;"
    class="d-inline-block ml-4 form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="name"
    type="text">
</div>

</form>
</div>
</div>

</div> --}}

</div>

<script>
  var edit = 0;
$( document ).ready(function() {
  $('#userName').fadeIn(400);
  
});
jQuery("element").fadeOut("slow");
function showInputs(){
  
  if(edit == 0)
  {
  $('#name').removeAttr("disabled");
  $('#last_name').removeAttr("disabled");
  $('#phone').removeAttr("disabled");
  $('.btn-confirm').fadeIn(200); 
  edit = 1;
  }
  
}
</script>
@endsection