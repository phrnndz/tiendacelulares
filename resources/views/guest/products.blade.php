@extends('guest.partials.base')

@section('title', 'Products')

@section('content')



<div class="product-big-title-area">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="product-bit-title text-center">
                <h2>@switch($categoria)
                    @case('curso')
                        Cursos
                        @break
                    @case('diplomado')
                        Diplomados
                        @break
                    @case('taller')
                        Talleres
                        @break
                @endswitch
                    
                    </h2>
                </div>
            </div>
        </div>
    </div>
</div>




<div class="single-product-area">
    <div class="bg-animation">
        {{-- <img  src="{{ URL::asset('img/03.png')}}" alt=""> --}}
    </div>
    {{-- <div class="zigzag-bottom"></div> --}}
    <div class="container">
    @if($items->isEmpty())
        <div class="panel panel-default">
            <div class="panel-body">
                Por el momento no hay información disponible. Espérala pronto. 
            </div>
          </div>
    @endif
    @foreach(array_chunk($items->all(), 4) as $chunk)
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
                    <div class="product-carousel-price">
                        @if ($product->price>0)
                        Inversión: <ins>${{ number_format($product->price,2) }}</ins> <br>
                        @else
                        Inversión: <ins>Pendiente</ins> <br>
                        @endif
                        Fecha: <ins>{{$product->date }}</ins> <br>
                        Modalidad: <ins>{{ strtoupper($product->modality->nombre)}}</ins>
                        </div>  
                    
                    <div class="product-option-shop">
                        @if ($product->price>0)
                        <a class="btn btn-dark  btn-block mt-5 add-to-cart"  href="javascript:void(0);" data-id="{{ $product->id }}">Añadir a la Cesta</a>
                        @else
                            <a class="btn btn-dark mt-5 btn-block"  href="{{ url('articulo/'.$product->slug) }}" >Ver {{$product->category->nombre}}</a>

                        @endif
                    </div>                       
                </div>
            </div>
            @endforeach
        </div>
    @endforeach
        
    </div>
</div>




@endsection

@section('scripts')

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
                    Swal.close()  
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

@stop