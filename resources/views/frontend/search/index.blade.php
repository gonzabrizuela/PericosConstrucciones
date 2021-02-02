@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="/css/frontend/products.css">
<link rel="stylesheet" href="/css/frontend/search.css">
<div class="mt-5 pb-5 container-fluid">


  <div class="row  mb-5 justify-content-center text-right">

    <div class="col text-center">
      <p style="color: #000 !important">Resultados para</p>
      <h2 style="font-size: 25px;color:#000;" class="font-weight-bold text-center">"{{$text}}"</h2>
    </div>

  </div>



  @if (!empty($aProducts) && empty($scategory_name))
  @include('frontend/layouts.products')
  @else


  <h2 class="text-center not-found"> {{$scategory_name}}</h2>
  <h2 class="text-left not-found">Productos que te pueden interesar</h2>
  @include('frontend/layouts.products')
  @endif

  <script>
    $( document ).ready(function() {
  $('#text').fadeIn(400);
  
});
  </script>
</div>
@endsection