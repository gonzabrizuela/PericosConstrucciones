@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="/css/frontend/products.css">
<link rel="stylesheet" href="/css/frontend/home.css">
<h2 style="margin-top:35px;">Emprendimientos</h2>
@if(!empty($aProjects))
@foreach($aProjects as $p)
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="uploads/projects/{{$p->image}}" alt="Card image cap">
  <div class="card-body">
  <a href=""><p class="card-text">{{$p->name}}</p></a>
    
  </div>
</div>
@endforeach
@endif
<style>
.card{
 /* // height:50px; */
}
.card:hover{
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
}
</style>

@endsection
