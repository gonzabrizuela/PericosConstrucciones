<footer>
  <div class="container">
    <div class="row">
      <div class="col-6 left-section">
        <h2 class="footer-title">E-SHOP</h2>
        <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptatibus consectetur non tempore laboriosam
          doloremque quod ducimus, e</p>
        <div class="row social-media">
          <div class="col-1">
            <a href=""><i class="fab fa-facebook-f"></i></a>
          </div>
          <div class="col-1">
            <a href=""><i class="fab fa-twitter"></i></a>
          </div>
          <div class="col-1">
            <a href=""><i class="fab fa-instagram"></i></a>
          </div>
        </div>
      </div>
      <div class="col-6 ">
        <div class="row">
          <div class="col-md-4 col-12">
            <h4 class="footer-section-title first">Comprar</h4>
            <a class="footer-link" href="">Opciones de pago</a>
            <a class="footer-link" href="">Envíos</a>
          </div>
          <div class="col-md-4 col-12">
            <h4 class="footer-section-title">Soporte</h4>
            <a class="footer-link" href="">Ayuda</a>
            <a class="footer-link" href="{{route('frecuent')}}">Preguntas Frecuentes</a>
          </div>
          <div class="col-md-4 col-12">
            <h4 class="footer-section-title">Contacto</h4>
            @if (empty(Auth::user()->id))
                <p class="footer-link">soporte@eshop.com.ar</p>
            @else
              <a class="footer-link" href="{{route('contact')}}">Reclamos</a>
            @endif
          </div>
        </div>
      </div>
      <div class="col-12 copyright">
        <p>ESHOP - <i class="far fa-copyright"></i> 2020. Todos los derechos reservados <span class="float-right">Hecho por TRENDERS</span></p>
      </div>
    </div>
  </div>
</footer>