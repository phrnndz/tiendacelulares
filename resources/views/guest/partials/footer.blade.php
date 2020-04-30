<div class="footer-top-area">
  {{-- <div class="zigzag-bottom"></div> --}}
  <div class="container">
      <div class="row">
          <div class="col-md-3 col-sm-6">
              <div class="footer-about-us">
                  <h2>Quiénes Somos</h2>
                  <p>Adquiere los mejores celulares con nosotros. Somos la mejor empresa de México</p>
                  <div class="footer-social">
                      <a href="#" target="_blank"><i class="fa fa-facebook"></i></a>
                      <a href="#" target="_blank"><i class="fa fa-twitter"></i></a>
                  </div>
              </div>
          </div>
          
          <div class="col-md-3 col-sm-6">
              <div class="footer-menu">
                  <h2 class="footer-wid-title">Enlaces</h2>
                  <ul>
                    <li><a href="{{ url('/')}}">Home</a></li>
                    <li><a href="#">Nosotros</a></li>
                    
                  </ul>                        
              </div>
          </div>
          
          {{-- <div class="col-md-3 col-sm-6">
              <div class="footer-menu">
                  <h2 class="footer-wid-title">Categories</h2>
                  <ul>
                      <li><a href="#">Mobile Phone</a></li>
                      <li><a href="#">Home accesseries</a></li>
                      <li><a href="#">LED TV</a></li>
                      <li><a href="#">Computer</a></li>
                      <li><a href="#">Gadets</a></li>
                  </ul>                        
              </div>
          </div> --}}
          
          <div class="col-md-3 col-sm-6">
              {{-- <div class="footer-newsletter">
                  <h2 class="footer-wid-title">Newsletter</h2>
                  <p>Por favor, para conocer los cursos, promociones y descuentos que tenemos para ti, ingresa tu correo electrónico.</p>
                  <div class="newsletter-form">
                      <form action="#">
                          <input type="email" placeholder="Escribe aquí tu email">
                          <input type="submit" value="SUCRIBIRME">
                      </form>
                  </div>
              </div> --}}
          </div>
      </div>
  </div>
</div> <!-- End footer top area -->

<div class="footer-bottom-area">
  <div class="container">
      <div class="row">
          <div class="col-md-8">
              <div class="copyright">
                  <p>&copy; {{ now()->year }} TodoCelularMexico.</p>
              </div>
          </div>
          
          <div class="col-md-4">
              <div class="footer-card-icon">
                  {{-- <i class="fa fa-cc-discover"></i> --}}
                  <i class="fa fa-cc-mastercard"></i>
                  {{-- <i class="fa fa-cc-paypal"></i> --}}
                  <i class="fa fa-cc-visa"></i>
              </div>
          </div>
      </div>
  </div>
</div> <!-- End footer bottom area -->

   <!-- Latest jQuery form server -->
    <script src="http://code.jquery.com/jquery.min.js"></script>
    
    <!-- Bootstrap JS form CDN -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    
    <!-- jQuery sticky menu -->
    <script src="{{ URL::asset('guest/js/owl.carousel.min.js')}}"></script>
    <script src="{{ URL::asset('guest/js/jquery.sticky.js')}}"></script>
    
    <!-- jQuery easing -->
    <script src="{{ URL::asset('guest/js/jquery.easing.1.3.min.js')}}"></script>
    
    <!-- Main Script -->
    <script src="{{ URL::asset('guest/js/main.js')}}"></script>
    <script src="{{ URL::asset('guest/js/wow.min.js')}}"></script>
    
    <script>
        new WOW().init();
    </script>
    <script>
    
    //===== Prealoder

    $(window).on('load', function (event) {
        $('#preloader').delay(500).fadeOut(500);
    });

    </script>
    @yield('scripts')
  </body>
</html>