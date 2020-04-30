@extends('guest.partials.base')

@section('title', 'Fished Payment')
@section('head')
<style>
.result-payment{
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
}
.result-payment-success{
    background-color: #a5dc86;
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
                            <div class="result-payment-success text">
                            <p class="title-result-payment">CÓDIGO {{$codigo }} - Compra Exitosa</p>
                                <p>¡Listo! , Se acreditó tu pago por {{ $amount }} MXN. 
                                    En tu estado de cuenta verás el cargo como "MERCADOPAGO"</p>
                                <p>Estamos preparando todo para enviarte tus artículos</p>
                                <p>Te recomendamos guardar este <a href="{{ url('generatepdf') }}/{{$codigo}}" target="_blank">PDF</a> para cualquier aclaración <strong></strong></p>

                                <br>
                                <br>
                                <br>
                                <p><strong>codigo:  </strong>{{$codigo }} </p>
                                <p><strong>preference_id:  </strong>{{$preference_id }} </p>
                                <p><strong>payment_type:  </strong>{{$payment_type }} </p>
                                <p><strong>merchant_order_id:  </strong>{{$merchant_order_id }} </p>
                                <p><strong>amount:  </strong>{{$amount }} </p>
                                <p><strong>name:  </strong>{{$name }} </p>

                                <br>
                                <br>
                                <br>
                                
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