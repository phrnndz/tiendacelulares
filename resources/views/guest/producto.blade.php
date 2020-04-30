@extends('guest.partials.base')
@section('titulo')
    {{ $product->name}}
@endsection
@section('head') 
    <link rel="stylesheet" href="{{ URL::asset('guest/css/magnific-popup.css')}}">
@endsection
@section('content')


<section class="course-title-area pt-120 pb-120 bg_cover" style="background: url({{ URL::asset('guest/img/background.jpeg')}}) ">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="course-title-content">
                    <div class="course-title-content-title">
                        {{-- <span>{{ strtoupper($product->category->name)}}</span> --}}
                        <h2 class="title wow fadeInLeft">{{ $product->name}}</h2>
                        <p class="wow fadeInLeft">{{ $product->goal}}</p>
                        @if ($product->price>0)
                        <a class="btn btn-dark mt-5  add-to-cart"  href="javascript:void(0);" data-id="{{ $product->id }}">COMPRAR {{mb_strtoupper($product->name)}} </a>
                        @endif
                    </div>
                    <div class="course-rating d-flex">
                        <span>Best Seller</span>
                        <ul
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                            <li><i class="fa fa-star"></i></li>
                        </ul>
                        <p>4.5 (175,400 ratings)</p>
                        <ul>
                            <li><span><i class="fa fa-users"></i> 647,974 students enrolled</span></li>
                        </ul>
                    </div>
                    <div class="course-info">
                        <ul>
                            <li><i class="fa fa-user"></i> by Pamela Hernández</li>
                            <li><i class="fa fa-calendar-alt"></i> by Pamela Hernández</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="course-details-area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="course-details-items white-bg">
                    <div class="course-thumb">
                        @if(strlen($product->photo) > 2)
                            <img  src="{{ URL::asset('img/'.$product->photo)}}" >
                        @else
                            <img  src="{{ URL::asset('img/noimage.png')}}" >
                        @endif
                        {{-- <img src="assets/images/course-details-thumb.jpg" alt="course"> --}}
                        <div class="tab-btns">
                            <ul class="nav nav-pills d-flex justify-content-between" id="pills-tab" role="tablist">
                                <li class="nav-link ">
                                    <a class="nav-link active" id="pills-1-tab" data-toggle="pill" href="#pills-1" role="tab" aria-controls="pills-1" aria-selected="true"><i class="fa fa-list"></i> Resumen</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-2-tab" data-toggle="pill" href="#pills-2" role="tab" aria-controls="pills-2" aria-selected="false"><i class="fa fa-book"></i> información</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-3-tab" data-toggle="pill" href="#pills-3" role="tab" aria-controls="pills-3" aria-selected="false"><i class="fa fa-user"></i> Envío</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-1" role="tabpanel" aria-labelledby="pills-1-tab">
                            <div class="course-details-item">
                                <div class="course-text">
                                <h4 class="title mt-20">DESCRIPCION </h4>
                                <p> {{$product->goal}}</p>
                                </div>

                               
                            </div>
                        </div>
                        <div class="tab-pane fade" id="pills-2" role="tabpanel" aria-labelledby="pills-2-tab">
                           <p>Más Información</p>
                         

                        </div>
                        <div class="tab-pane fade" id="pills-3" role="tabpanel" aria-labelledby="pills-3-tab">
                            <div class="course-text">
                                <h4 class="title mt-20">ENVIO </h4>
                                <p>Envio por DHL o ESTAFETA</p>
                            </div>
                            

                        </div>
                      
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-7 col-sm-9">
                <div class="course-details-sidebar white-bg wow fadeInLeft">
                    <div class="course-sidebar-thumb">
                        <img src="{{ URL::asset('guest/img/video-thumbnail.png')}}" alt="course video">
                        <a class="popup-youtube" href="https://www.youtube.com/watch?v=HzirwAPFTYQ"><i class="fa fa-play"></i></a>
                    </div>
                    <div class="course-sidebar-price d-flex justify-content-between align-items-center">
                    <h3 class="title">
                        ${{ number_format($product->price,2) }} MXN<br>
                        <span>Antes ${{ number_format($product->price + 1000,2) }} MXN</span>
                    </h3>
                        {{-- <span>% 0FF</span> --}}
                    </div>
                    <div class="course-sidebar-btns">
                       
                        @if ($product->price>0)
                        <a class="btn btn-dark mt-5 add-to-cart"  href="javascript:void(0);" data-id="{{ $product->id }}">COMPRAR {{mb_strtoupper($product->name)}} </a>
                        @endif
                        <h6 class="title">QUÉ INCLUYE</h6>
                        <ul style="list-style:none">
                            <li><i class="fa fa-certificate"></i> Seguimiento Envio</li>
                            <li><i class="fa fa-certificate"></i> Garantía de producto</li>
                            <li><i class="fa fa-certificate"></i> Certificado al autenticidad</li>
                        </ul>
                    </div>
                    <div class="course-sidebar-share">
                    </div>
                
                </div>
                <div class="trending-course">
                    <h4 class="title"><i class="fa fa-book"></i> Te pueden interesar</h4>
                   @foreach ($products as $item)
                   <div class="single-courses mt-30">

                    
                        <div class="courses-thumb">
                            @if(strlen($item->photo) > 2)
                            <img  src="{{ URL::asset('img/'.$item->photo)}}" >
                            @else
                                <img  src="{{ URL::asset('img/noimage.png')}}" >
                            @endif
                        </div>
                        <div class="courses-content">
                            <a  href="{{ url('articulo/'.$item->slug) }}">
                            <h4 class="title">{{$item->name}}</h4>
                            </a>
                            <ul>
                                <li><i class="fa fa-users"></i>{{ $item->goal}}</li>
                                {{-- <li><i class="fa fa-comments"></i></li> --}}
                            </ul>
                        </div>
                    </div>
                       
                   @endforeach
                </div>
            </div>
            
        </div>
        
    </div>
</section>





</div>


<div class="product-widget-area">
    {{-- <div class="zigzag-bottom"></div> --}}
    {{-- <div class="bg-animation">
        <img class="wow bounce"  src="{{ URL::asset('img/03.png')}}" alt="">
    </div> --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 text-center  mt-5 mb-20">
                <h2 class="section-title wow   fadeInLeft">
                    ADQUIERE ESTE PRODUCTO AHORA MISMO
                </h2>
                @if ($product->price>0)
               

                <a class="btn btn-dark  add-to-cart"  href="javascript:void(0);" data-id="{{ $product->id }}">COMPRAR {{mb_strtoupper($product->category->nombre)}} </a>

                
                @endif
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
                    <h3>Entrega por E-mail</h3>
                    <p>Acceso al producto entregado por email</p>
                </div>
            </div>
            <div class="col-md-3 col-sm-6">
                <div class="single-promo wow pulse">
                    <i class="fa fa-gift"></i>
                    <h3>Contenido aprobado</h3>
                    <p>100% revisado y aprobado</p>
                </div>
            </div>
        </div>
    </div>
    
</div> <!-- End product widget area -->

   
    @endsection
    @section('scripts')


        

    <script type="text/javascript"src="{{ URL::asset('guest/js/magnific-popup.min.js')}}"></script>
        
    <script type="text/javascript">
      $(document).ready(function() {
        $('.popup-youtube').magnificPopup({

          type: 'iframe',


          preloader: false,


        });
      });
    </script>

    </script>
    <script type="text/javascript">
        $(".add-to-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

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

            $.ajax({
                url: '{{ url('products/add-to-cart') }}' + '/' + ele.attr("data-id"),
                method: "get",
                data: {_token: '{{ csrf_token() }}'},
                dataType: "json",
                success: function (response) {
                    Swal.close();
                    ele.siblings('.btn-loading').hide();
                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');
                    $("#header-bar").html(response.data);
                    Swal.fire(
                    'Correcto',
                    'El producto ha sido agregado correctamente a la cesta',
                    'success'
                    )
                }
            });
        });
    </script>


    @endsection