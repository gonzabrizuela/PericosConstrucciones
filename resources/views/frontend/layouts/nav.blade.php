<nav class="navbar pl-3 navbar-expand-lg navbar-light bg-white fixed-top" id="mainNav">
  <a class="navbar-brand" href="{{route('home')}}"> Pericos Construcciones</a> 
  <!-- <a class="navbar-brand" href="{{route('home')}}"><img src="uploads/slider-03.jpg" style="height:90px;"alt=""> </a> -->

  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
  </button>

  
  <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav navbar-sidenav bg-white "  id="exampleAccordion">
          <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Home">
              <a class="nav-link " href="{{route('home')}}">
                <i class="fas fa-home"></i><span class="ml-2 nav-link-text"  >Home</span>
              </a>
          </li>
          <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Home">
              <a class="nav-link " href="{{route('company')}}">
              <i class="fas fa-city"></i><span class="ml-2 nav-link-text"  >Empresa</span>
              </a>
          </li>
          <li class="nav-item " data-toggle="tooltip" data-placement="right" title="Home">
              <a class="nav-link " href="{{route('projects')}}">
              <i class="fas fa-chart-line"></i><span class="ml-2 nav-link-text"  >Proyectos</span>
              </a>
          </li>
          
          <li class="nav-item ">
            <a href="#CatSubmenu" data-toggle="collapse" class="nav-link" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-bars mr-2"></i>Categorias</a>
              <ul class="collapse list-unstyled"  id="CatSubmenu">
                  @foreach ($aCategories as $category)
                      @if ( ($category->countsub < 1) || ($category->countvis < 1 ))
                      <li><a class="nav-link ml-3" href="{{route('cate',$category->id)}}" style="font-size:16px"><i class="fas fa-th-large mr-1"></i>{{$category->name}}</a></li>
                      @else
                      <li class="nav-item">
                        <a href="#SubCatSubmenu_{{$category->id}}" style="font-size:16px" data-toggle="collapse" class="nav-link ml-3" aria-expanded="false" class="dropdown-toggle"><i class="fas fa-th-large mr-1"></i>{{$category->name}}</a>   
                        </a>
                        <ul class="collapse list-unstyled" id="SubCatSubmenu_{{$category->id}}">
                          @foreach ($aSubCategories as $subcategory)
                            @if ( $subcategory->category_id == $category->id)
                              <li> <a class="nav-link ml-4" style="font-size:15px" href="{{route('sub',$subcategory->id)}}"><i class="fas fa-th mr-1"></i>{{$subcategory->name}}</a></li>
                            @endif
                          @endforeach
                      </ul>
                    </li>
                      @endif
                  @endforeach
                  
              </ul>
          </li>
               
          


      </ul>

      <div class="container">
      <ul class="navbar-nav mr-5 header" >
       
        @if (empty(Auth::user()->id))
        <li class="nav-item ml-md-3  border-dark login"><a  class="nav-link" href="{{ route('loguser.index') }}">Ingresar</a></li>
            
            @else
            
            <li id="options-display" class="nav-item dropdown login ml-3 ">
              
              <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user"></i>
              </a>
              <div class="dropdown-menu text-dark" id="dropdown-links" aria-labelledby="navbarDropdown">
                <a class="dropdown-item text-dark"  href="{{route('profile') }}">Perfil</a>
                <a class="dropdown-item text-dark"  href="#">Compras</a>
                <a class="dropdown-item text-dark"  href="{{route('favorites') }}">Favoritos</a>
                <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Salir</a>
              </div>
            </li>
            <li class="nav-item login responsive-drop">
              <i class="fas fa-user-circle user-icon-responsive nav-link"></i>
              <a class="ml-2 nav-link text-dark"  href="{{route('profile') }}">Perfil</a>
              <a class="ml-2 nav-link text-dark"  href="#">Compras</a>
              <a class="ml-2 nav-link text-dark"  href="{{route('favorites') }}">Favoritos</a>
              <a class="ml-2 nav-link" data-toggle="modal" data-target="#exampleModal">Salir</a>
            </li>
            <li class="nav-item login">
              <a class="nav-link"  href="{{route('cart') }}"><i class="fas fa-shopping-cart"></i><span class="cart-text">Carrito</span></a>
             </li>
            @endif
            <li class="nav-item search login">
                <form class="form-inline" id="search-form" action="{{ route('search') }}" style="justify-content: flex-end">
                  <input type="text" name="text"  class="search-input" id="search-input" placeholder="Buscar" style="display: none">
                  <button class="btn btn-white " onclick="displaySearch()" id="nav-search" type="submit"><i class="fas fa-search"></i></button>
                  
                </form>
            
          </li>
      </ul>
    </div>
  </div>
</nav>
@if (!Auth::guest())
    

@if (Auth::user()->type == 1)
<a id="back-to-backend" href="{{route('user.index')}}" class="btn btn-dark btn-lg back-to-backend" role="button">Backend</a>
<script>
  $(document).ready(function(){
	
				$('#back-to-backend').fadeIn();
	
});

</script>
@endif
@endif

<script>
  var search = 0;
function displaySearch(){
  event.preventDefault();
  if(search == 0)
  {
    $('#search-input').fadeIn();
    search = 1;
  }
  else{
    if( $('#search-input').val() == '' || $('#search-input').val() == null )
    {
      $('#search-input').fadeOut();
    search = 0;
    }
    else{
      $('#search-form').submit();
    }
    
  }
}

</script>



