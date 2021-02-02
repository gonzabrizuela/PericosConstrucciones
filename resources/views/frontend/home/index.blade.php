@extends('frontend/layouts.app')

@section('content')
<link rel="stylesheet" href="/css/frontend/products.css">
<link rel="stylesheet" href="/css/frontend/home.css">
<div class="mt-2 container-fluid">



    <div class="row pt-5 justify-content-center text-right">



@if (!empty($aSlider))
<!--Carousel Wrapper-->
<div id="carousel-promo-2" class="mt-4 carousel slide carousel-fade" data-ride="carousel">
  <!--Indicators-->
  @if (count($aSlider) > 1)
  <ol class="carousel-indicators">
    <?php $i = 0;?>
    @foreach ($aSlider as $slider)
    <li data-target="#carousel-promo-2" data-slide-to="{{$i}}" @if($slider == $aSlider[0]) class="active" @endif></li>
    <?php $i++; ?>
    @endforeach
  </ol>
  @endif
  <!--/.Indicators-->
  <!--Slides-->
  <div class="carousel-inner" role="listbox">
    @foreach ($aSlider as $slider)
        
    
    <div class="carousel-item @if($slider == $aSlider[0])active @endif">
      
      <div class="view">
        <img class="d-block w-100" src="/uploads/slider/{{$slider->image}}"
          alt="">
        <div class="mask rgba-black-light"></div>
      </div>
      <div class="carousel-caption">
      </div>
  
    </div>
    @endforeach

  </div>
  <!--/.Slides-->
  <!--Controls-->
  <a href="{{$slider->link}}">
  <div class="view-now row">
    
    <div class="col-4">
      <div class="arrow">
        <i class="fas fa-arrow-right"></i>
      </div>
    </div>
    <div class="col pl-0">
      <span class="text-left">Ver Ahora</span>
    </div>
    
  </div>
</a>
  <div class="btn-prev">
    <a class="carousel-control-prev" href="#carousel-promo-2" role="button" data-slide="prev">
      <span><i class="fas fa-arrow-left"></i></span>
      <span class="sr-only">Previous</span>
    </a>
  </div>
  <div class="btn-next">
  <a class="carousel-control-next" href="#carousel-promo-2" role="button" data-slide="next">
    <span><i class="fas fa-arrow-right"></i></span>
    <span class="sr-only">Next</span>
  </a>
</div>
  <!--/.Controls-->

  
  
</div>
<!--/.Carousel Wrapper-->
@endif
</div>
  <div class="row mt-4 mb-5">

      @if (!empty($aProducts))
     
      <div class="col" >
        <h2 style="font-size: 25px;color:#000;" class="font-weight-bold text-left">NOVEDADES</h2>
        </div>
    
        
    
  </div>
    
  @include('frontend/layouts.products')
    

    @endif
</div>

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
@endsection
