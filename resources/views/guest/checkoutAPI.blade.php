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
        <?php $total += $details['price'] * $details['quantity'] ?>
    @endforeach
@endif

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
        <p>Tambien puedes pagar con OXXO <a href="{{route('pago.oxxo')}}">aquí</a></p>

            <div class="col-md-12">
                @if (isset($errors) && $errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
{{-- 
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        <ul>
                            @foreach (session()->get('success') as $message)
                                <li>{{ $message }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif --}}
                @isset ($result)
                    <div class="result-payment text-center">
                        <div class="result-payment-success text">
                            <p class="title-result-payment">Compra Exitosa</p>
                            <p>Gracias {{ $name }} ¡Listo!, se acreditó tu pago por {{ $amount}}  {{ $currency }} . 
                                En tu resumen verás el cargo como MERCADOPAGO"</p>
                            <p>Estamos preparando todo para enviarte los siguientes artículos</p>
                            <ul>
                                @foreach ($items as $item)
                                    <li>{{$item->title}}</li>
                                @endforeach
                            </ul>
                        </div> 
                    </div>
                @endisset

                
                <div class="alert alert-danger" style="display:none"  id="paymentErrorsContainer" >
                    <ul>               
                            <li id="paymentErrors" role="alert"></li>
                    </ul>
                </div>    

                
                <div>
                    <div class="checkout">
                        <form class="form" role="form" action="{{ route('pay') }}" method="POST" id="paymentForm" autocomplete="off" novalidate >
                        @csrf
                        <fieldset>
                            <label for="card-number">Cantidad a Pagar</label>
                            <input class="form-control"type="number"
                                min="5"
                                step="0.01"
                                class="form-control"
                                name="value"
                                value="{{ $total }}"
                                required
                                readonly>
                                <label for="card-expiration-month">Moneda</label>
                            <div class="select">
                              <select name="currency" required >
                                @foreach ($currencies as $currency)
                                    <option value="{{ $currency->iso }}">
                                        {{ strtoupper($currency->iso) }}
                                    </option>
                                @endforeach
                              </select>
                            </div>
                            
                        </fieldset>
                        <hr>
                          <fieldset>
                            <label for="cardNumber">Número de Tarjeta</label>
                            <input class="input-cart-number" type="text" id="cardNumber" data-checkout="cardNumber" placeholder="Número de Tarjeta" required data-parsley-pattern="^[0-9]{16}$"/>
                          </fieldset>
                          <fieldset>
                            <label for="card-holder">Titular</label>
                            <input type="text" id="card-holder"  data-checkout="cardholderName" placeholder="Titular" required/>
                          </fieldset>
                          <fieldset>
                            <label for="email">Correo Electrónico</label>
                            <input type="text" id="email"  data-checkout="cardholderEmail" placeholder="email@example.com" name="email" data-parsley-type="email" required/>
                          </fieldset>
                          <fieldset class="fieldset-expiration">
                            <label for="card-expiration-month">Fecha de Expiración</label>
                            <div class="select">
                              <select id="card-expiration-month"  data-checkout="cardExpirationMonth" required>
                                <option></option>
                                <option>01</option>
                                <option>02</option>
                                <option>03</option>
                                <option>04</option>
                                <option>05</option>
                                <option>06</option>
                                <option>07</option>
                                <option>08</option>
                                <option>09</option>
                                <option>10</option>
                                <option>11</option>
                                <option>12</option>
                              </select>
                            </div>
                            <div class="select">
                              <select id="card-expiration-year" data-checkout="cardExpirationYear" required>
                                <option></option>
                                <option>2020</option>
                                <option>2021</option>
                                <option>2022</option>
                                <option>2023</option>
                                <option>2024</option>
                                <option>2025</option>
                                <option>2026</option>
                                <option>2027</option>
                                <option>2028</option>

                              </select>
                            </div>
                          </fieldset>
                          <fieldset class="fieldset-ccv">
                            <label for="card-ccv">CCV</label>
                            <input id="card-ccv" type="text" data-checkout="securityCode" placeholder="CVC" required data-parsley-type="number"/>
                            <input type="hidden" id="cardNetwork" name="card_network">
                            <input type="hidden" id="cardToken" name="card_token">
                          </fieldset>
                          <button class="button-cart"><i class="fa fa-lock"></i> Pagar</button>
                          
                          @foreach ($plataforms as $paymentPlatform)
                                    <input
                                        type="hidden"
                                        name="payment_platform"
                                        value="{{ $paymentPlatform->id }}"
                                        required
                                    >
                                    
                                    <hr>
                                    <img src="{{ URL::asset('img/VISA.svg')}}" ">
                                    <img src="{{ URL::asset('img/AMEX.svg')}}" ">
                                    <img src="{{ URL::asset('img/MASTER_CARD.svg')}}" "><br>
                                    <small class="text-center">Usamos como intermediario a MERCADOPAGO por tu seguridad</small>


                            
                            @endforeach
                        </form>
                      </div>
                      

                <div>
                    
                    
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('scripts')

    <script src="https://secure.mlstatic.com/sdk/javascript/v1/mercadopago.js"></script>
    <script src="{{ URL::asset('guest/js/parsley.min.js')}}"></script>



    <script>
        window.Mercadopago.setPublishableKey('TEST-f7e01a1f-c997-44cc-bddb-9eba3c4d63d1');
    </script>
    <script>    
    function setCardNetwork()
    {
        const cardNumber = document.getElementById("cardNumber");
        window.Mercadopago.getPaymentMethod(
            { "bin": cardNumber.value.substring(0,6) },
            function(status, response) {
                const cardNetwork = document.getElementById("cardNetwork");
                cardNetwork.value = response[0].id;
            }
        );
    }
    </script>
    <script>
        const mercadoPagoForm = document.getElementById("paymentForm");
        mercadoPagoForm.addEventListener('submit', function(e) {
                e.preventDefault();
                window.Mercadopago.createToken(mercadoPagoForm, function(status, response) {
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
                    if (status != 200 && status != 201) {
                        Swal.close();
                        const errors = document.getElementById("paymentErrors");
                        const errorsContainer = document.getElementById("paymentErrorsContainer");
                        switch(response.cause[0].code) {
                            case "205":	errors.textContent = 'Ingresa el número de tu tarjeta. ';
                                        break;
                            case "208":	errors.textContent = 'Elige un mes. ';
                                        break;
                            case "209":	errors.textContent = 'Elige un año. ';
                                        break;
                            case "221":	errors.textContent = 'Ingresa el nombre y apellido. ';
                                        break;
                            case "E301":errors.textContent = 'Hay algo mal en ese número. Vuelve a ingresarlo. ';
                                        break;
                            case "326":	errors.textContent = 'Revisa la fecha. ';
                                        break;
                            default:	    
                                        errors.textContent ='Revisa los datos.';
                        }
                        errorsContainer.style.display = "";
                        Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Algo salió mal!',
                        })

                    } else {
                        Swal.close();
                        const cardToken = document.getElementById("cardToken");
                        setCardNetwork();
                        cardToken.value = response.id;
                        mercadoPagoForm.submit();
                    }
                });
     
        });
    </script>


    <script>
      $('#paymentForm').parsley();
    </script>
   

@endsection