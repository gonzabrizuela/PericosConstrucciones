@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="/css/frontend/cart.css">
<div class="mt-5 container-fluid">

  

    <div class="d-inline">
      <div class="cart-icon">
      <i class="fas fa-shopping-cart"></i>
      </div>
    <div class="div-title">
    <h2 style="color:#000;" class=" d-inline title font-weight-bold text-left">Carrito de compras</h2>
  </div>
      
  
        
</div>
</div>
<?php $total=0?>
<div class="row">
@if (!empty($aProducts))
<div class="col-12 mb-4 mt-5">
  <div class="row">
    <div class="col-5">
      <h3 class="grid-header">Producto</h3>
    </div>
    <div class="col-3">
      <h3 class="grid-header">Cantidad</h3>
    </div>
    <div class="col-4">
      <h3 class="grid-header">Precio</h3>
    </div>
  </div>
</div>
@foreach ($aProducts as $product)
          
<div class="col-12 mb-4">

  <div class="row">
    <div class="col-5">
      @foreach ($aImage as $image)
      @if ($image->product_id == $product->id && $image->type == 0 && $image->main_image == 1) 
        <img class="product_image" src="/uploads/products/{{$image->image}}" alt="">
      @endif    
      @endforeach
      <div class="text">
        
            <h4>{{$product->name}} <br>


            <span>Codigo de producto: #{{$product->id}}</span></h4>

        </div>
        
        
      </div>
    
    <div class="col-7">
      <div class="row">
        <div class="col-12 col-md-5">
          <input id="quantity_{{$product->id}}"   name="quantity" type="number" value="{{$product->quantity}}" min="1" max="{{$product->stock}}" step="1" />
        </div>
        <div class="col-12 col-md-7 price-section">
          
            @if ($product->prom != null)
              <h2 class="price">${{$product->price * ($product->prom / 100)}}</h2>
            @else
              <h2 class="price">${{$product->price}}</h2>
            @endif
            <i  onclick="window.location='{{ route('cartAction',$product->id) }}'" class="deleteItem float-right fas fa-times"></i>
          
        </div>
      </div>
        
      
    </div>
    
</div>
</div>
        <?php
        if($product->prom != null)
        {
          $total += ($product->price * ($product->prom / 100)) * $product->quantity;
        }
        else {
          $total+=$product->price * $product->quantity;
        }
        ?>
        
              @endforeach
            </div>
 <div class="row section-payment">
   <div class="col-md-7 col-12">
     <div class="continue">
      <a class="continue" href="{{route('home')}}"><i class="fas fa-arrow-left mr-1"></i>Continuar comprando</a>
     </div>
   
   </div>
   <div class="col-md-3 col-12">
    <p class="total-price">Costo total: <span id="final_price">${{$total}}</span></p>
   </div>
   <div class="col-md-2 col-12">
    <a href="" class="shop-btn btn">PAGAR</a>
   </div>
 </div>
              @endif
  

    
  </div>
</div>
<script src="/vendor/bootstrap-input-spinner-cart.js"></script>
<script>
    $("input[type='number']").inputSpinner()
</script>
<script>$( document ).ready(function() {
  $('#headFav').fadeIn(400);
  
});</script>

@foreach ($aProducts as $product)
    <script>
      $('#quantity_{{$product->id}}').change( () => {
        let newQuantity = $('#quantity_{{$product->id}}').val();
        changeProductQuantity({{$product->id}},newQuantity,{{$product->price}},{{$product->prom}});
      });
    </script>
@endforeach

<script>

  function changeProductQuantity(product_id,quantity,price,prom)
  {
    event.preventDefault();

    var params = new Object();
    params._token =  "{{ csrf_token() }}";
    params.quantity = quantity;
    params.product_id = product_id;
    if(prom != null)
    {
      params.price = Number(price) * (Number(prom)/100);
    }
    else{
      params.price = price;
    }
    ajaxRequest("POST","{{route('changeProductQuantity')}}", params, "changeProductQuantityResponse")
  }

    
    function changeProductQuantityResponse(data) {

        if(data.change != 0)
        {
          let old_total = {{intval($total)}};
          console.log(old_total);
          console.log('Price= '+data.price);
          console.log('Change= '+data.change);
          let new_total = old_total + (Number(data.price) * Number(data.change));
          console.log(new_total);
          $('#final_price').text('$'+new_total); 
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
@endsection
