@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="/css/frontend/products.css">
<div class="mt-2 container-fluid">






    <div class="row pt-5 mb-5 justify-content-center text-right">

      <div class="col ">
        <h2 style="font-size: 25px;color:#000;" class="font-weight-bold text-center">{{$sub_category_name->name}}</h2>
      </div>
        
</div>

    </div>


   @include('frontend/layouts.products')
</div>

@endsection
