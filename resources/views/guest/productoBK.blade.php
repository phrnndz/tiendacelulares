@extends('guest.partials.base')
{{-- @section('titulo')
    Bienvenido
@endsection --}}
@section('head') 
    {{-- <link rel="stylesheet" href="{{ URL::asset('guest/css/downcount.css')}}"> --}}
@endsection
@section('content')

<div class="container-downcounter">
    <div id="black"></div>
    @if(strlen($product->photo) > 2)
        <img class="downcounter-img" src="{{ URL::asset('img/'.$product->photo)}}" style="width:100%; height:450px">
    @else
        <img class="downcounter-img" src="{{ URL::asset('img/noimage.png')}}" style="width:100%; height:450px">
    @endif
    <div class="downcounter">
        
        <h1 class="downcounter-title wow fadeInLeft">{{ $product->name }}</h1>
        @if ($product->price>0)
            <a class="btn btn-dark mt-5  add-to-cart"  href="javascript:void(0);" data-id="{{ $product->id }}">COMPRAR {{mb_strtoupper($product->category->nombre)}} </a>
        @endif
        
    </div>
</div>
<div class="container-counter">
    <div class="container intro-tables text-center">
        <div class="row countdown">
            <div class="col-md-3 col-xs-6">
                <span class="days downcounter-time">00</span>
                <p class="days_ref">Días</p>
            </div>
            <div class="col-md-3  col-xs-6">
                <span class="hours downcounter-time">00</span>
                <p class="hours_ref">Horas</p>
            </div>
            <div class="col-md-3  col-xs-6">
                <span class="minutes downcounter-time">00</span>
                <p class="minutes_ref">Minutos</p>
            </div>
            <div class="col-md-3  col-xs-6">
                <span class="seconds downcounter-time">00</span>
                <p class="seconds_ref">Segundos</p>
            </div>
        </div>
    </div>
    
</div>
<div class="product-area">
    <div class="container">
        <h2 class="text-center  wow fadeInLeft">ACTIVIDAD EXCLUSIVA Y DE CUPO LIMITADO</h2>
        <p class="text-center tex-subtitle  wow fadeInLeft">Se recomienda inscribirse lo antes posible ya que la demanda de este taller es muy alta</p>
        
        
    </div>

</div>
<div class="product-widget-area">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h3 >Objetivo</h3>  
                <div class="product-widget-area-text  wow fadeInLeft">
                    {!! $product->goal !!}
                </div>
        
            </div>
            <div class="col-md-6">
                <h3>Dirigido a</h3>  
                <div class="product-widget-area-text  wow fadeInRight">
                    {!! $product->made_for !!}
                </div>
        
            </div>
        </div>
    </div>
</div>
<div class="promo-area">
    {{-- <div class="zigzag-bottom"></div> --}}
    <section class="oferta" >
        <div class="container">
            <div class="row">
            <div class="col-md-4">
                <div class="product-widget-area-item">
                <i class="fa fa-calendar"></i>
                <h4>Fecha de inicio</h4>
                <p>{{ $product->date }}</p>
                </div>
                
            </div>
            <div class="col-md-4">
                <div class="product-widget-area-item">
                <i class="fa fa-map-marker"></i>
                <h4>Lugar donde se llevará acabo</h4>
                <p>{{ $product->place }}</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-widget-area-item">
                <i class="fa fa-university"></i>
                <h4>Inversión</h4>
                @if ($product->price>0)
                <p>${{ number_format($product->price,2) }}</p>
                @else
                <p>PENDIENTE<p>
                @endif
                
                </div>
            </div>
            </div>
        </div>
    {{-- <div class="product-inner-price">
        <p><span style="color: #e20019;"><strong>Horas clase:</strong></span>&nbsp;12 horas Lorem Ipsum</p>
        <p><span style="color: #e20019;"><strong>Formato:</strong></span>&nbsp;Lorem Ipsum</p>
        <p><span style="color: #e20019;"><strong>Días de clase:</strong></span>&nbsp;Viernes de 9:30am a 7:00pm / Sábado de 10:00am a 2:30pm</p>
        <p><span style="color: #e20019;"><strong>Fecha de inicio:</strong></span>&nbsp;{{ $product->date }}</p>
        <p><span style="color: #e20019;"><strong>Inversión:</strong></span>&nbsp;${{ number_format($product->price,2) }}</p>
        <p><span style="color: #e20019;"><strong>Lugar:</strong></span>&nbsp;{{ $product->place }}</p>
    </div> 
    <div class="product-option-shop">
        <a class="btn btn-warning text-center add-to-cart"  href="javascript:void(0);" data-id="{{ $product->id }}">Añadir a la Cesta</a>
    </div>     --}}

    </section>
</div>
<div class="maincontent-area">
<div class="row">
    <div class="container">
        <div class="col-md-12">
            <h2 class="section-title wow fadeInLeft">MÓDULOS</h2>
            <div class="container">
                @if($product->module->isEmpty())
                <div class="panel panel-default">
                    <div class="panel-body">
                        Este curso aún no cuenta con módulos
                    </div>
                  </div>
                @endif
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    @foreach ($product->module as $key=>$item)
                        @if ($key == 0)
                            <li class="active">
                        @else
                            <li >
                        @endif
                                <a href="#{{ $key}}" role="tab" data-toggle="tab">{{$item->name}}  
                                @if ($item->duration>0)
                                    ({{ $item->duration }} hrs.)
                                @endif
                                </a>
                            </li>
                    @endforeach
                </ul>
               
                <!-- Tab panes -->
                <div class="tab-content">
                    
                    @foreach ($product->module as $key=>$module)
                    @if ($key ==0)
                        <div class="tab-pane fade active in" id="{{ $key}}">
                    @else
                        <div class="tab-pane fade" id="{{ $key}}">
                    @endif
                            <div class="treeview">
                                <ul class="project-list">
                                    @foreach ($module->submodule as $submodule)
                                    <li><i class="fa fa-check-circle" aria-hidden="true"></i> {{ $submodule->name}}
                                        <ul>
                                            @foreach ($submodule->subtheme as $subtheme)
                                                <li> <i class="fa fa-check" aria-hidden="true"></i>{{$subtheme->name}}</li>
                                            @endforeach
                                        </ul>
                                    </li>
                                    @endforeach   
                                </ul>
                                    
                            </div>       
                        </div>
                    @endforeach
                </div>
                
            </div>

        </div>
    </div>
</div>

</div>
<div class="product-area">
    <div class="row">
        <div class="container">
            <div class="col-md-12 text-center">
                @if ($product->price>0)
                <h1>ADQUIERE ESTE {{mb_strtoupper($product->category->nombre)}} AHORA MISMO</h1>

                @else
                <p><p>
                @endif
               
            </div>
        </div>
    </div>
</div>





   
    @endsection
    @section('scripts')
    <script src="{{ URL::asset('guest/js/downcount.js')}}"></script>
    <script>

        $(document).ready(function() { 
            $('.countdown').downCount({
                date: '{{ $product->date }}',
                offset: -6 //UTF TIME OFFSET
            });
        });

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