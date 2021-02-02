@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="/css/frontend/contact.css">
<div class=" container-fluid">

  <div class="row pt-5 mb-5 justify-content-center text-right">

    <div class="col ">
      <h2 style="font-size: 25px;color:#000;" class="font-weight-bold text-center">Contacto</h2>

    </div>

  </div>
  <form method="POST" action="{{ route('contact_post') }}" id="contact_form" role="form" enctype="multipart/form-data">
    {{ csrf_field() }}
    <div class="row justify-content-center text-left">










      <div class="col-12">
        <label>¿Que Problema tuviste?</label>
      </div>
      <div class="col-12">
        <select class="problem_select" name="contacts_type" id="contacts_type">

          <option value="1">No llego mi envio</option>
          <option value="2">Producto fallado</option>
          <option value="3">No era lo que esperaba</option>
          <option value="4">Otro</option>
        </select>
        @if ($errors->has('category'))
        <span class="invalid-feedback" role="alert">
          <strong>Debe seleccionar una problema valido.</strong>
        </span>
        @endif
      </div>

      <div class="col-12">
        <label>Comentario</label>
      </div>

      <div class="col-12">
        <textarea name="description" id="description" cols="30" maxlength="500"  rows="5"></textarea>
      <span id="description_error" class="invalid-feedback" role="alert" style="display:none;">
        <strong>Debe ingresar una descripción (max. 500 car.)</strong>
      </span>
      </div>
      <div class="col-12">
        <button type="submit" class="btn shop-btn">Enviar</button>
      </div>
      
      




    </div>
  </form>

  <script>
    $( document ).ready(function() {
  $('#headFav').fadeIn(400);
});
  </script>
</div>
@endsection