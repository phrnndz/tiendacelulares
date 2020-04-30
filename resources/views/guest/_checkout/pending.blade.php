@extends('guest.partials.base')

@section('title', 'Fished Payment')
@section('head')
<style>
.result-payment{
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
}
.result-payment-pending{
    background-color: #f0ad4e;
    width: 32em;
    padding: 1.25em;
    border: none;
    border-radius: .3125em;
    font-size: 1.5em;
    font-weight: 400;
}
</style>


@endsection('content')
@section('content')


<div class="product-big-title-area">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="product-bit-title text-center">
                  <h4>Tu pago fue procesado por {{ strtoupper(config('services.mercadopago.base_currency')) }} por
                  <img width="100px;" src="{{ URL::asset('img/mercadopago.png')}}"> <br>
                  Nosotros no conservamos ninguno de tus datos personales</<h4>
              </div>
          </div>
      </div>
  </div>
</div> 

 

<?php $total = 0 ?>
@if(session('cart'))
    @foreach((array) session('cart') as $id => $details)
        <?php $total += $details['price'] * $details['quantity'] ?>
    @endforeach
@endif

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">

            <div class="col-md-12">
                
                   
                        <div class="result-payment text-center">
                            <div class="result-payment-pending text">
                                <p class="title-result-payment">Compra Pendiente</p>
                                <p>¡Listo! , Estamos en espera de la confirmación tu pago por {{ $amount }} MXN. </p>
                                <p>Cuando tengamos noticias de tu pago te enviaremos la confirmación de tu asistencia al evento que hayas adquirido.</p>
                                

                                {{-- <ul>
                                    @foreach ($payment[0]->items as $item)
                                        <li>{{$item->title}}</li>
                                    @endforeach
                                </ul> --}}
                            </div> 
                        </div>


                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')



@endsection