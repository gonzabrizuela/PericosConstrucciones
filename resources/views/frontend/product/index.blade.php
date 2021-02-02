@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="/css/frontend/product.css">
<div class="mt-5 pb-5 container-fluid">
@if(!empty($oProduct))
      
@foreach($oProduct as $product)
 <div class="container">
  <div class="row">
    <div class="col-md-1 col-12">
      <div class="row">
        @foreach ($aImage as $image)
        @if ($image->type==0)
          <div class="col-md-12 col mt-2">
            <img class="d-block w-100 small-image" onclick="changeMainImage('{{$image->image}}','image')" style="width: 100%;height:50px;object-fit:cover" src="/uploads/products/{{$image->image}}" alt="First slide">
          </div>
        @else
          <div class="col-md-12 col mt-2">
          <video class="d-block w-100 small-image" onclick="changeMainImage('{{$image->image}}','video')" style="width:100%;height:50px;object-fit:cover" src="/uploads/products/{{$image->image}}" loop muted >
          Your browser does not support HTML5 video.
          </video>
        </div>
        @endif
      @endforeach 
      </div>
      
    </div>

    <div class="col-md-6 col-12">
      @foreach ($aImage as $image)
        @if ($image == $aImage[0])
          <div class="col-12 mt-2 div-main-image">
            <img class=" w-100 main-image"  style="width: 100%;max-height:600px;object-fit:cover" src="/uploads/products/{{$image->image}}" >
            <video  class=" w-100 main-video" style="width: 100%;max-height:600px;object-fit:cover;display:none"  loop muted autoplay src="">Your browser does not support HTML5 video.</video>
          </div>
        @endif
      @endforeach 
      
    </div>

    <div class="col-md-5 col-12">
      <div class="row mt-2 mt-md-0">
        <div class="col-12">
          @if ($product->prom != null)
              <div class="mr-2 discount d-inline">
                {{$product->prom}}%
              </div>
          @endif
          @if ($product->news == 1)
              <div class=" d-inline">
                <span class="font-weight-bold" style="font-size:12.5px ">Nuevo</span>
              </div>
          @endif
        </div>
        <div class="col-12 mt-3">
          <h5 class="product-title">{{$product->name}}</h5>
        </div>
        <div class="col-12">
          {!! $product->description !!}
        </div>
        <div class="col-12 mt-2">
          @if ($product->prom != null)
              <p >
                <span class=" text-danger product-price">${{$product->price * ($product->prom / 100)}}</span>  
                <span class="card-text product-price"><del>${{$product->price}}</del> </span>
              </p>   
              @else
              <p class="card-text product-price" style="color:#000;">${{$product->price}}</p>
              @endif
        </div>
       <form style="display: contents;" action="{{route('cartAction',$product->id)}}">
        <div class="col-4 mt-3  text-center" style="margin-right:75%;">
          <p class="mb-0 text-black text-center" style="font-size: 15px">Cantidad</p>
        </div>

        <div style="height: 45px"  class="col-lg-6 mt-2  col-10 ">
          @if(empty($aCart))
          <button  type="submit"  class="d-inline btn btn-add-cart">Añadir al Carrito</button>
           
          @else
          <button type="submit" class="d-inline btn btn-add-cart">Eliminar del Carrito</button>
            
          @endif
          
        </div>
        <div style="height: 45px"  class="col-2 col-fav mt-2">
          <button id="favBtn_{{$product->id}}" style="@if(empty($product->favoritos)) display:block; @else display:none; @endif" class="favBtn"  onclick="setFavoriteProduct({{$product->id}})"><i  class="far fa-heart float-right" style="font-size: 25px"></i></button>

          <button id="favBtnActive_{{$product->id}}" style="@if(!empty($product->favoritos)) display:block; @else display:none; @endif" class="favBtnActive" onclick="setFavoriteProduct({{$product->id}})"><i  class="fas fa-heart float-right " style="font-size: 25px"></i></button>
        </div>
      </form>
      </div>
    </div>


<!-- Características  -->
<div class="characteristcs-div" style="border: 1px solid #ccc!important; margin-top:30px; margin-bottom:10px;width:700px;">
          <div class="container">
            <h4>Caracteristicas</h4>
            <ul class="characteristcs">
              <li class="carac-item"><span class="carac-desc"><i
                    class="fas fa-couch"></i>Ambientes</span>{{ $product->rooms }} </li>
              <li class="carac-item"><span class="carac-desc"><i
                    class="fas fa-bed"></i>Dormitorios</span>{{ $product->bedrooms }}</li>
              <li class="carac-item"><span class="carac-desc"><i
                    class="fas fa-bath"></i>Baños</span>{{ $product->bathrooms }}</li>
              <li class="carac-item"><span class="carac-desc"><i
                    class="fas fa-ruler-combined"></i>Tamaño</span>{{ $product->size }}m<sup>2</sup></li>
              <li class="carac-item"><span class="carac-desc"><i
                    class="fas fa-clock"></i>Antigüedad</span> @if($product->years == 0) A estrenar @else {{ $oProp->years }} años @endif</li>
                    @if (!empty($product->locality_name))
                    <li class="carac-item"><span class="carac-desc"><i class="fas fa-map-marked-alt"></i>Ubicación</span>{{ ucwords(strtolower($product->locality_name)) }}@if($product->town_name), {{ucwords(strtolower($product->town_name))}} @endif @if(!empty($product->province_name)), {{ucwords(strtolower($product->province_name))}} @endif</li>    
                    @endif
                    
            </ul>
          </div>
        </div>

 

        <!-- Fin de características  -->

        <!-- Caracteristicas generales  -->

        @if(!empty($aProperties_general_characteristics))
        <div class="characteristcs-div special" style="border: 1px solid #ccc!important; width:700px;">
          <div class="container">
            <h4>Caracteristicas Generales</h4>
            <div class="row">
              @foreach($aProperties_general_characteristics as $cg)
              <div class="col-6 col-md-4">
                <span class="carac-desc">
                  <i class="fas fa-angle-right mr-1"></i></span>{{ $cg->caracteristicas_generales_name }}
              </div>


              @endforeach
            </div>

          </div>
        </div>
        @endif
        <!-- fin de caracteristicas generales  -->


        <!-- servicios -->
        @if(!empty($aProperties_services))
        <div class="characteristcs-div special" style="border: 1px solid #ccc!important; margin-top: 8px;width:700px;">
          <div class="container">
            <h4>Servicios</h4>
            <div class="row">
              @foreach($aProperties_services as $servicios)
              <div class="col-6 col-md-4">
                <span class="carac-desc">
                  <i class="fas fa-angle-right mr-1"></i></span>{{ $servicios->service_name }}
              </div>

              @endforeach
            </div>

          </div>
        </div>
        @endif
        <!--  fin de serivicios-->

        <!--  ambientes-->
        @if(!empty($aProperties_ambients))
        <div class="characteristcs-div special" style="border: 1px solid #ccc!important; margin-top: 8px;">
          <div class="container">
            <h4>Ambientes</h4>
            <div class="row">
              @foreach($aProperties_ambients as $ambientes)
              <div class="col-6 col-md-4">
                <span class="carac-desc">
                  <i class="fas fa-angle-right mr-1"></i></span>{{ $ambientes->ambientes_name }}
              </div>
              
              @endforeach
            </div>


          </div>
        </div>
        @endif
        <!--   fin de ambientes-->

        <!--   comodidades-->
        @if(!empty($aProperties_luxuries))
        <div class="characteristcs-div special " style="border: 1px solid #ccc!important; margin-top: 8px;">
          <div class="container">
            <h4>Comodidades</h4>
            <div class="row">
              @foreach($aProperties_luxuries as $comodidades)
              <div class="col-6 col-md-4">
                <span class="carac-desc"><i
                    class="fas fa-angle-right mr-1"></i></span>{{ $comodidades->comodidades_name }}
              </div>
              
              @endforeach
            </div>


          </div>
        </div>

        @endif
        <!--  fin de comodidades-->

    @endforeach
  


  </div>

  @endif
 </div>









<script>

function changeMainImage(id,type){
  if(type == 'image')
  {
    url = "/uploads/products/"+id;
    $('.main-image').attr('src',url);
    $('.main-video').attr('src','');
    $('.main-video').css('display','none');
    $('.main-image').css('display','block');
  }
  else
  {
    url = "/uploads/products/"+id;
    $('.main-video').attr('src',url);
    $('.main-image').attr('src','');
    $('.main-video').css('display','block');
    $('.main-image').css('display','none');
  }
  
}

  
</script>



<script type="text/javascript">


  
  function setFavoriteProduct(productId) {
      
      event.preventDefault();
     
      
      var params = new Object();
      params._token = "{{ csrf_token() }}";
      params.productId = productId;
      
      ajaxRequest("POST", "{{route('product_favorite')}}", params, "setFavoriteProductResponse");
  }
  
  function setFavoriteProductResponse(data) {
    
      if(data.favorite > 0) {
          $('#favBtnActive_'+data.productId).css('display', 'block');
          $('#favBtn_'+data.productId).css('display', 'none');
          
      } 
      else{
        $('#favBtnActive_'+data.productId).css('display', 'none');
        $('#favBtn_'+data.productId).css('display', 'block');
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
<script src="/vendor/bootstrap-input-spinner.js"></script>
<script>
    $("input[type='number']").inputSpinner()
</script>

   
@endsection

