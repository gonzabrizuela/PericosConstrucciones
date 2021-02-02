@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="/css/frontend/products.css">
<link rel="stylesheet" href="/css/frontend/home.css">

@if(!empty($aProjects))
@foreach($aProjects as $p)
<div class="card" style="width: 18rem;">
  <img class="card-img-top" src="uploads/projects/{{$p->image}}" alt="Card image cap">
  <div class="card-body">
    <p class="card-text">{{$p->name}}</p>
  </div>
</div>
@endforeach
@endif


@endsection
