@extends('guest.partials.base')
@section('titulo')
    Bienvenido
@endsection
@section('head') 
    {{-- <link rel="stylesheet" href="{{ URL::asset('guest/css/downcount.css')}}"> --}}
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ URL::asset('guest/css/magnific-popup.css')}}">


@endsection
@section('content')

    <section class="home-section">
        <div class="container">
                <div class="row d-flex align-items-center wow fadeInLeft">
                    <div class="col-md-7">
                        <div class="mb-40">
                        <h2>TodoCelularMexico</h2>
                        <p class="p-md">Somos una empresa de celulares importados en México.</p>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-40">
                            <div class="wrapper" style="margin: 0 auto;">
                                <img src="{{ URL::asset('guest/img/3397597.jpg')}}" alt="">
                                
                                    {{-- AQUI VA EL SVG --}}
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </section> <!-- End home content area -->
    
   
        
    <div class="maincontent-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="latest-product">
                        <h2 class="section-title wow fadeInLeft">LOS ÚLTIMOS MODELOS</h2>    
                        <p class="text-center tex-subtitle wow fadeInRight">Adquiere los mejores celulares con nosotros</p>
                        @if($products->isEmpty())
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        Por el momento no hay artículos disponibles. Espéralos pronto. 
                                    </div>
                                </div>
                            @endif
                        @foreach(array_chunk($products->all(), 4) as $chunk)
                        <div class="row">
                            @foreach($chunk as $product)
                            <div class="col-md-3 col-sm-6">
                                <div class="single-shop-product wow pulse">
                                    <div class="product-upper">
                                        @if(strlen($product->photo) > 2)
                                        <img src="{{ URL::asset('img/'.$product->photo)}}" >
                                    @else
                                        <img src="{{ URL::asset('img/noimage.png')}}" >
                                    @endif
                                    </div>
                                    <h2><a href="{{ url('articulo/'.$product->slug) }}">{{ $product->name }}</a></h2>
                                    <p>{{ str_limit(strtolower($product->description), 100) }}</p>
                                    <div class="product-carousel-price text-">
                                        Precio: <ins>${{ number_format($product->price,2) }}</ins> <br>
                                        Descripcion: <ins>{{ $product->goal }}</ins> <br>
                                        {{-- Fecha: <ins>{{$product->date }}</ins> <br> --}}

                                    </div>  
                                    
                                    <div class="product-option-shop">
                                    <a class="btn btn-dark mt-5 btn-block"  href="{{ url('articulo/'.$product->slug) }}" >Ver Producto</a>
                                    </div>                       
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- End main content area -->
    

    <div class="product-widget-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <h2 class="section-title wow fadeInLeft">
                        Adquiere los mejores celulares con nosotros. Comprálo ahora mismo
                    </h2>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo wow pulse">
                        <i class="fa fa-refresh"></i>
                        <h3>Privacidad</h3>
                        <p>Tu información está 100% segura</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo wow pulse">
                        <i class="fa fa-truck"></i>
                        <h3>Compra segura</h3>
                        <p>Ambiente seguro y autenticado</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo wow pulse">
                        <i class="fa fa-lock"></i>
                        <h3>Entrega por DHL</h3>
                        <p>Acceso al producto entregado por email</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo wow pulse">
                        <i class="fa fa-gift"></i>
                        <h3>Celulares garatizados</h3>
                        <p>100% revisado y aprobado</p>
                    </div>
                </div>
            </div>
        </div>
        
    </div> <!-- End product widget area -->
   

  
    
    {{-- <div id="myModal" class="modal fade in" style="display: block; padding-left: 16px;">
        <div class="modal-dialog modal-newsletter">
            <div class="modal-content">
                
                    <div class="modal-header">
                        <div class="icon-box">
                            <img src="{{ URL::asset('guest/img/logo_formacion_politica.svg')}}" width="80px">
                        </div>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><span>×</span></button>
                    </div>
                    <div class="modal-body text-center">
                        <h4>Bienvenido a Formación Politica</h4>	
                        <p>Por favor, para conocer los cursos, promociones y descuentos que tenemos para ti, ingresa tu correo electrónico.</p>
                        <div class="form-group">
                            <form  id='rform' name='rform'>
                            <input type="email" name="email" class="form-control" placeholder="Agrega tu email" required data-parsley-type="email" data-parsley-trigger="keyup">
                            <input type="submit" class="btn btn-primary btn-submit"  value="Subscribirse">
                            </form>	
                        </div>
                    </div>
               		
            </div>
        </div>
    </div> --}}
   
    @endsection
    @section('scripts')
    <script src="{{ URL::asset('guest/js/parsley.min.js')}}"></script>
    <script type="text/javascript"src="{{ URL::asset('guest/js/magnific-popup.min.js')}}"></script>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.popup-youtube').magnificPopup({
          type: 'iframe',
          preloader: false,
        });
      });
    </script>
    <script>




        $(document).ready(function() { 
            $('#rform').parsley();

            var wrapper = document.querySelector('.wrapper svg');
            wrapper.classList.add('active');


            // $('.countdown').downCount({
            //     date: '01/12/2020 00:00:00',
            //     offset: -6 //UTF TIME OFFSET
            // });
            // $('#myModal').modal('show');



        });




    </script>
    

<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $("#rform").on('submit', function(e){
        e.preventDefault();
        if($('#rform').parsley().isValid()){
            Swal.fire({
                title: 'Wait ...',
                onBeforeOpen () {
                    Swal.showLoading ()
                },
                onAfterClose () {
                    Swal.hideLoading()
                },
                allowOutsideClick: false,
                allowEscapeKey: false,
                allowEnterKey: false
            });
            var email = $("input[name=email]").val();
            $.ajax({
               type:'POST',
               url:'suscribir',
               data:{email:email},
               success:function(data){
                    Swal.close() ;
                    $("input[name=email]").val('');
                    Swal.fire({
                        icon: 'success',
                        timer: 1000,
                        title: 'Excelente',
                        text: 'Gracias por suscribirte',
                    });
               },
               error: function(XMLHttpRequest, textStatus, errorThrown) { 
                    $('#myModal').modal('hide');
                    Swal.close() ;
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Algo salió mal!',
                    });
                } 

            });
        }
	});

</script>
    @endsection