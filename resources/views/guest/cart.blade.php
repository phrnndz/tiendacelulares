@extends('guest.partials.base')

@section('title', 'Cart')
@section('head')
<link rel="stylesheet" href="{{ URL::asset('guest/css/cart.css')}}">
<link rel="stylesheet" href="{{ URL::asset('guest/css/parsley.css')}}">


@endsection('content')
@section('content')

<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                    <h2>Resumen de tu compra</h2>
                </div>
            </div>
        </div>
    </div>
</div> <!-- End Page title area -->

<div class="single-product-area">
    <div class="zigzag-bottom"></div>
    <div class="container">
        <div class="row">
           
            
                <div class="col-md-8">
                    <div class="row">
                       <div class="product-content-right">
                        <h2>Resumen</h2>
                            <div class="woocommerce">
                                <form method="post" action="#">
                                    <table cellspacing="0" class="shop_table cart">
                                        <thead>
                                            <tr>
                                                <th class="product-remove">&nbsp;</th>
                                                <th class="product-thumbnail">Producto</th>
                                                <th class="product-name">Precio</th>
                                                <th class="product-price">Cantidad</th>
                                                <th class="product-quantity">Total</th>
                                                <th class="">&nbsp;</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $total = 0 ?>

                                            @if(session('cart'))
                                                @foreach((array) session('cart') as $id => $details)
                                                    <tr class="cart_item">
                                                        
                
                                                        <td class="product-thumbnail">
                                                            <a href="single-product.html">
                                                                @if(strlen($details['photo']) > 2)
                                                                    <img src="{{ URL::asset('img/'.$details['photo'])}}" width="100" height="100" class="img-responsive"/>
                                                                @else
                                                                    <img src="{{ URL::asset('img/noimage.png')}}" width="100" height="100" class="img-responsive"/>

                                                                @endif
                                                            </a>
                                                        </td>
                
                                                        <td class="product-name">
                                                            <a href="single-product.html">{{ strtoupper($details['name']) }}</a> 
                                                        </td>
                
                                                        <td class="product-price">
                                                            <span class="amount">${{ $details['price'] }}</span> 
                                                        </td>
                
                                                        <td class="product-quantity">
                                                            <input type="number"   value="{{ $details['quantity'] }}" class="form-control quantity" min="1" max="99" />
                                                        </td>
                
                                                        <td class="">
                                                            <span class="product-subtotal">$ {{ $details['price'] * $details['quantity'] }}</span> 
                                                        </td>

                                                        <td class="product-remove">
                                                            <button class="btn btn-info btn-sm update-cart" data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                                                            <button class="btn btn-danger btn-sm remove-from-cart" data-id="{{ $id }}"><i class="fa fa-trash-o"></i></button>
                                                        </td>
                                                    </tr>
                                    
                                                    <?php $total += $details['price'] * $details['quantity'] ?>
                                                @endforeach
                                            @endif
                                            
                                            {{-- <tr>
                                                <td class="actions" colspan="6">
                                                    <div class="coupon">
                                                        <label for="coupon_code">CÓDIGO DE DESCUENTO:</label>
                                                        <input type="text" placeholder="Ejemplo: DISCOUNT20" value="" id="coupon_code" class="input-text" name="coupon_code">
                                                    </div>                                          
                                                </td>
                                            </tr> --}}
                                        </tbody>
                                    </table>
                                </form>

                                {{-- <div class="cart-collaterals"> --}}









                                {{-- </div> --}}

                            </div> 
                        </div>                       
                    </div> 
                    @if($total)
                    <div class="row">
                        
                        <div class="col-md-8 ">
                        <h2>Ingresa tus datos</h2>

                        <form class="form" role="form"  action="{{url('checkout')}}" method="POST" id="paymentForm" autocomplete="off" novalidate>
                            @csrf
                            <fieldset>
                                <label for="card-holder">Nombre Completo</label>
                                <input type="text" id="card-holder" value="Lalo Landa" name="nombre" placeholder="Nombre Completo" required/>
                              </fieldset>
                              <fieldset>
                                <label for="email">Correo Electrónico</label>
                                <input type="text" id="email" name="email" value="test_user_58295862@testuser.com" placeholder="email@example.com" name="email" data-parsley-type="email" required />
                              </fieldset>
                              <fieldset>
                                <label for="email">Teléfono</label>
                                <input type="text" id="telefono" name="telefono" value="5549737300" placeholder="5549737300"   required />
                              </fieldset>
                              <fieldset>
                                <label for="email">Nombre de la Calle</label>
                                <input type="text" id="calle" name="calle" value="Insurgentes Sur" placeholder=" Insurgentes Sur"  required />
                              </fieldset>
                              <fieldset>
                                <label for="email">Número Casa</label>
                                <input type="text" id="numerointerior" name="numerointerior" value="1602" placeholder="1602"   required />
                              </fieldset>
                              <fieldset>
                                <label for="email">Código Postal</label>
                                <input type="text" id="cp" name="cp" value="03940" placeholder="03940"  required />
                              </fieldset>
                                <button class="button-cart"><i class="fa fa-lock"></i>Pagar la compra</button>
                              
                            </form>
                        </div>
                        <div class="col-md-4">
                            <div class="cart_totals ">
                                <h2>Tu Pago</h2>
    
                                <table cellspacing="0">
                                    <tbody>
    
    
                                        <tr class="shipping">
                                            <th>Envío</th>
                                            <td>Envío Gratis</td>
                                        </tr>
    
                                        <tr class="order-total">
                                            <th>Total</th>
                                            <td><strong><span class="amount cart-total">${{ $total }}</span></strong> </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div> 
                    @endif
                    
                    
                </div>
                <div class="col-md-4">

                
                    <div class="single-sidebar">
                        <div class="trending-course">
                        <h2>  Te pueden interesar</h2>
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
                                </div>
                            </div>
                               
                           @endforeach
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

    <script type="text/javascript">

        $(".update-cart").click(function (e) {
            e.preventDefault();
            // console.log('aqui');



            var ele = $(this);

            var parent_row = ele.parents("tr");

            var quantity = parent_row.find(".quantity").val();

            var product_subtotal = parent_row.find("span.product-subtotal");

            var cart_total = $(".cart-total");
             // If x is Not a Number or less than one or greater than 10
            if (isNaN(quantity) || quantity < 1 || quantity > 10) {
                Swal.fire({
                          icon: 'error',
                          title: 'Oops...',
                          text: 'Algo salió mal! La cantidad '+ quantity+' no es permitida',
                    })
            } else {            
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
                    url: '{{ url('products/update-cart') }}',
                    method: "patch",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: quantity},
                    dataType: "json",
                    success: function (response) {
                        Swal.close() ;
                        $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                        $("#header-bar").html(response.data);

                        product_subtotal.text(response.subTotal);

                        cart_total.text(response.total);
                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) { 

                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Algo salió mal!',
                        })
                        // alert("Status: " + textStatus); alert("Error: " + errorThrown); 
                    } 
                });
            } //end if validation quantity
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            var parent_row = ele.parents("tr");

            var cart_total = $(".cart-total");

            Swal.fire({
            title: '¿Estas seguro?',
            text: "Estas a punto de eliminar un artículo de tu cesta",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eiminar',
            cancelButtonText: 'Cancelar'

            }).then((result) => {
            if (result.value) {
                            $.ajax({
                                url: '{{ url('products/remove-from-cart') }}',
                                method: "DELETE",
                                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                                dataType: "json",
                                success: function (response) {

                                    parent_row.remove();

                                    $("span#status").html('<div class="alert alert-success">'+response.msg+'</div>');

                                    $("#header-bar").html(response.data);

                                    cart_total.text(response.total);
                                }
                            });
                Swal.fire(
                'Eliminado',
                'El artículo fue eliminado correctamente.',
                'success'
                )
            }
            })


        });

    </script>
    <script>
        $('#paymentForm').parsley();
      </script>

@endsection