<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
    <a class="navbar-brand" href="{{ url('/admin') }}">E-COMMERCE</a>
    <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Usuarios">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fas fa-user"></i>
                    <span class="nav-link-text">Usuarios</span>
                </a>
            </li>
            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Categories">
                <a class="nav-link" href="{{ route('categories.index') }}">
                    <i class="fas fa-th-large"></i>
                    <span class="nav-link-text">Categorias</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="sub">
                <a class="nav-link" href="{{ route('sub.index') }}">
                    <i class="fas fa-th"></i>
                    <span class="nav-link-text">Sub-Categorias</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
                <a class="nav-link" href="{{ route('products.index') }}">
                    <i class="fas fa-boxes"></i>
                    <span class="nav-link-text">Productos</span>
                </a>
            </li>


            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
                <a class="nav-link" href="{{ route('slider.index') }}">
                    <i class="far fa-images"></i>
                    <span class="nav-link-text">Slider Promos</span>
                </a>
            </li>

            <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Products">
                <a class="nav-link" href="{{ route('contact.index') }}">
                <i class="fa fa-book" aria-hidden="true"></i>
                    <span class="nav-link-text">Contactados</span>
                </a>
            </li>

           
            


        </ul>
        <ul class="navbar-nav sidenav-toggler">
            <li class="nav-item">
                <a class="nav-link text-center" id="sidenavToggler">
                    <i class="fa fa-fw fa-angle-left"></i>
                </a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fa fa-fw fas fa-sign-out-alt"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>