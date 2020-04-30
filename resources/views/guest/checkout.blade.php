@extends('guest.partials.base')

@section('title', 'Cart')
@section('head')
<link rel="stylesheet" href="{{ URL::asset('guest/css/cart.css')}}">


@endsection('content')
@section('content')


<div class="product-big-title-area">
  <div class="container">
      <div class="row">
          <div class="col-md-12">
              <div class="product-bit-title text-center">
                  <h4>Tu pago será procesado en {{ strtoupper(config('services.mercadopago.base_currency')) }} por
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
        <?php $total += $details['price'] * $details['quantity'];  ?>
    @endforeach
@endif


<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
            
            
            <div class="col-md-6">
                <table cellspacing="0" class="shop_table cart">
                    <thead>
                        <tr>
                            <th class="product-remove">Nombre</th>
                            <th class="product-name">Precio</th>
                            <th class="product-price">Cantidad</th>
                            <th class="product-quantity">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0 ?>

                        @if(session('cart'))
                            @foreach((array) session('cart') as $id => $details)
                                <tr class="">

                                    <td class="">
                                        <p>{{ strtoupper($details['name']) }}</p> 
                                    </td>

                                    <td class="">
                                        <p>${{ $details['price'] }}</p> 
                                    </td>

                                    <td class="">
                                        <p>{{ $details['quantity'] }}</p>
                                    </td>

                                    <td class="">
                                        <p>$ {{ $details['price'] * $details['quantity'] }}</p>
                                    </td>
                                </tr>
                
                            @endforeach
                        @endif
                        
                    </tbody>
                </table>
            </div>
            <div class="col-md-6">
                <div style="font-size:1.5em;">
                <p><span style="color: #e20019;"><strong>NOMBRE</strong></span>&nbsp;&nbsp;{{ $name }}</p>
                    <p><span style="color: #e20019;"><strong>CORREO ELECTRÓNICO</strong></span>&nbsp;&nbsp;{{ $email }}</p>
                    <p><span style="color: #e20019;"><strong>TELÉFONO</strong></span>&nbsp;&nbsp;{{ $telefono }}</p>
                    <p><span style="color: #e20019;"><strong>CALLE</strong></span>&nbsp;&nbsp;{{ $calle }}</p>
                    <p><span style="color: #e20019;"><strong>NUM INTERIOR</strong></span>&nbsp;&nbsp;{{ $numerointerior }}</p>
                    <p><span style="color: #e20019;"><strong>CÓDIGO POSTAL</strong></span>&nbsp;&nbsp;{{ $cp }}</p>
                    <p><span style="color: #e20019;"><strong>TOTAL A PAGAR</strong></span>&nbsp;&nbsp;${{ number_format($totalenviado,2)}}</p>

                    <a href="<?php echo $preference->init_point; ?>">Pagar la compra</a>


                </div>
                <div class="mercado-pago-banner">

                        <img src="{{ URL::asset('img/mercadopagobanner.jpg')}}"><br>

                    
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


    <script src="{{ URL::asset('guest/js/parsley.min.js')}}"></script>


    <script>
      $('#paymentForm').parsley();
    </script>
   

@endsection