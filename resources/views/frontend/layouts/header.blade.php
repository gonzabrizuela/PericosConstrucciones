
<nav class="navbar navbar-expand-md px-5 navbar-light bg-light" id="main_navbar">
  <a class="navbar-brand" href="#">E-Commerce</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
    <ul class="navbar-nav ml-auto">
      
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Link</a>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            Categorias
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
          @foreach ($aCategories as $category)
              @if ($category->quantity_sub < 1)
              <li><a class="dropdown-item" href="#">{{$category->name}}</a></li>
              @else 
              <li class="nav-item dropdown">
                <a class="dropdown-item dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    {{$category->name}}
                </a>
                <ul class="dropdown-menu left" aria-labelledby="navbarDropdown2">
                  @foreach ($aSubCategories as $subcategory)
                  @if ($subcategory->category_id == $category->id)
                    <li><a class="dropdown-item" href="#">{{$subcategory->name}}</a></li>
                  @endif
                  @endforeach  
                </ul>
            </li>
              @endif
          @endforeach
            
           
        </ul>
    </li>

      
      
      @if (empty(Auth::user()->id))
  <li class="nav-item ml-3 border-right border-dark"><a  class="nav-link" href="{{ route('loguser.index') }}">Ingresar</a></li>
      <li class="nav-item"><a class="nav-link" href="{{ route('register.index') }}">Registarme</a></li>
      @else
      <li class="nav-item dropdown ml-3">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          {{Auth::user()->name}}
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item"  href="#">Mi Perfil</a>
          
          <a class="dropdown-item" data-toggle="modal" data-target="#exampleModal">Salir</a>
        </div>
      </li>
      @endif
    </ul>
    
  </div>
</nav>
<script>
  $(function () {
      $('#main_navbar').bootnavbar();
  })
</script>
