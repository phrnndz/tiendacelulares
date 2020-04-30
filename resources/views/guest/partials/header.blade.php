<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tienda e-commerce</title>
    <meta name="google-site-verification" content="google-site-verification=EX7n5OxfohS62_Zis9_YjpzxD_85LPIaOtOBFm3zm7A">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Oswald:400,500,600&display=swap" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ URL::asset('guest/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('guest/style.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('guest/css/responsive.css')}}">
    <link rel="stylesheet" href="{{ URL::asset('guest/css/animate.css')}}">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
 

    @yield('head')

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <body>
        <div id="preloader" >
            <div id="status">
                <div class="spinner">
                    <div class="rect1"></div>
                    <div class="rect2"></div>
                    <div class="rect3"></div>
                    <div class="rect4"></div>
                    <div class="rect5"></div>
                </div>
            </div>
        </div>
        
        <div class="site-branding-area">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        {{-- <div class="logo">
                            <img src="{{ URL::asset('img/logo.png')}}" >
                            
                        </div> --}}
                    </div>
                    <div class="col-sm-4">
                        {{-- <h1 class="text-center">FORMACIÓN POLÍTICA</h1> --}}
                    </div>
                    
                    <div class="col-sm-4" id="header-bar">
                        {{-- <div class="shopping-item">
                            <a href="{{ url('/tienda') }}">Cart - <span class="cart-amunt">$800</span> <i class="fa fa-shopping-cart"></i> <span class="product-count">5</span></a>
                        </div> --}}
                        @include('guest.partials._header_cart')
                    </div>
                </div>
            </div>
        </div> <!-- End site branding area -->
        
        <div class="mainmenu-area">
            <div class="container">
                <div class="row">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div> 
                    <div class="navbar-collapse collapse">
                        <ul class="nav navbar-nav">
                            <li class="{{ request()->is('/') ? 'active' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                            {{-- <li class="{{ request()->is('categoria/curso') ? 'active' : '' }}"><a href="{{ url('categoria/curso') }}">Cursos</a></li>
                            <li class="{{ request()->is('categoria/taller') ? 'active' : '' }}"><a href="{{ url('categoria/taller') }}">Talleres</a></li>
                            <li class="{{ request()->is('categoria/diplomado') ? 'active' : '' }}"><a href="{{ url('categoria/diplomado') }}">Diplomados</a></li>
                            <li class="{{ request()->is('tienda') ? 'active' : '' }}"><a href="{{ url('/tienda') }}">Tienda</a></li>
                            <li class="{{ request()->is('contacto') ? 'active' : '' }}""><a href="{{ url('/contacto') }}">Contacto</a></li>
                        </ul> --}}
                    </div>  
                </div>
            </div>
        </div> <!-- End mainmenu area -->