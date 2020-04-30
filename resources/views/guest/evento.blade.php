@extends('guest.partials.base')
{{-- @section('titulo')
    Bienvenido
@endsection --}}
@section('head') 
<style> 
    .container-downcounter {
        position: relative;
        text-align: center;
        color: white;
    }
    #black{
        position: absolute;
        right: 0;
        bottom: 0;
        width: auto;
        min-width: 100%;
        height: auto;
        min-height: 100%;
        background: rgba(26,29,37,0.8);
    }
    /* Centered text */
    .downcounter {
        position:absolute;
        top:50%;
        left:50%;
        transform:translate(-50%,-50%);
        text-align:center;
    }
    .downcounter h1{
        font-size: 4em;
    }

    </style>

@endsection
@section('content')


<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                <h2>{{ $event[0]->name }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container-downcounter">
    <div id="black"></div>
    @if(strlen($event[0]->photo) > 2)
        <img class="downcounter-img" src="{{ URL::asset('img/eventos/'.$event[0]->photo)}}" style="width:100%; height:450px">
    @else
        <img class="downcounter-img" src="{{ URL::asset('img/noimage.png')}}" style="width:100%; height:450px">
    @endif
    <div class="downcounter">
        <h1 class="">No te quedes fuera y anota la fecha,  faltan:</h1>
        <ul class="countdown">
            <li>
              <span class="days">00</span>
              <p class="days_ref">Días</p>
            </li>
            <li>
              <span class="hours">00</span>
              <p class="hours_ref">Horas</p>
            </li>
            <li>
              <span class="minutes">00</span>
              <p class="minutes_ref">Minutos</p>
            </li>
            <li>
              <span class="seconds last">00</span>
              <p class="seconds_ref">Segundos</p>
            </li>
          </ul>
    </div>
</div>


<div class="blog-details-area mg-b-15">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="blog-details-inner">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="latest-blog-single blog-single-full-view">

                                <div class="product-widget-area">
                                    <div class="container">
                                        <div class="row">
                                            <div class="col-md-6">
                                    
                                                <h3>Descripción</h3>  
                                                <p>{{ $event[0]->description }}</p>
                                        
                                            </div>
                                            <div class="col-md-6">
                                                <h3>Generales</h3>  
                                                <div class="product-inner-price">
                                                    <p><span style="color: #e20019;"><strong>Horas clase:</strong></span>&nbsp;12 horas Lorem Ipsum</p>
                                                    <p><span style="color: #e20019;"><strong>Formato:</strong></span>&nbsp;Lorem Ipsum</p>
                                                    <p><span style="color: #e20019;"><strong>Días de clase:</strong></span>&nbsp;Viernes de 9:30am a 7:00pm / Sábado de 10:00am a 2:30pm</p>
                                                    <p><span style="color: #e20019;"><strong>Fecha de inicio:</strong></span>&nbsp;Lorem Ipsum</p>
                                                    <p><span style="color: #e20019;"><strong>Fecha de término:</strong></span>&nbsp;Lorem Ipsum</p>
                                                    <p><span style="color: #e20019;"><strong>Inversión:</strong></span>&nbsp;${{ number_format($event[0]->price,2) }}</p>
                                                    <p><span style="color: #e20019;"><strong>Lugar:</strong></span>&nbsp; Lorem Ipsum</p>
                                                </div> 
 
                                        
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div>
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
                date: '10/12/2020 00:00:00',
                offset: -6 //UTF TIME OFFSET
            });
        });

    </script>
    @endsection