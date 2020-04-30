@extends('dashboard.partials.base')
@section('titulo')
    Editar
@endsection
@section('head') 
<link rel="stylesheet" href="{{ URL::asset('css/dropify/css/dropify.min.css')}}">
{{-- <script src="https://cdn.tiny.cloud/1/rgurjpytbnb1q31gru8honk1nr5oi8klopm02g2sh8d2su57/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}

@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<section class="row">
    <div class="col-sm-12">
                <div class="card mb-4">
                    <div class="card-block">
                        <h3 class="card-title">Editar</h3>

                                        
                                       
                                        <form action="{{ route('inventario.update', $product->id) }}" name="update_product" method="POST" files=true enctype='multipart/form-data'>
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                

                                            <div class="row">
                                                
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    
                                                    <div class="form-group">
                                                    <input  value="{{ $product->name}}" name="name" type="text" class="form-control" placeholder="Titulo" >
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control" placeholder="Descripción" name="goal" id="" cols="30" rows="10" >{{$product->goal}}</textarea>

                                                    </div>
                                                   
                                                   
                                                    <div class="form-group">
                                                        <input class="form-control" name="date" type="text" id="date" placeholder="Fecha" value="{{$product->date}}"">
                                                        {{-- <input  type="number" class="form-control" placeholder="Precio"> --}}
                                                    </div>
                                                    <div class="form-group">
                                                        
                                                        <input  value="{{$product->price}}" name="price"  id="price" type="number" class="form-control" placeholder="Precio">
                                                    </div>
                                    
                                                    <div>
                                                        @if(strlen($product->photo) > 2)
                                                            {{ Form::file('photo',['class' => 'dropify','data-default-file'=> URL::asset('img/'.$product->photo) ])}}
                                                        @else
                                                            {{ Form::file('photo',['class' => 'dropify' ])}}
                                                        @endif
                                                        {{-- <input type="file" name="photo" class="dropify" data-allowed-file-extensions="jpg png jpeg" data-max-file-size-preview="1M" data-min-height="400" /> --}}
                                                    </div>
                                                    

                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                        <!-- Group of default radios - option 1 -->
                                                        <label for="sel1">Estatus</label>
                                                        <div class="custom-control custom-radio">
                                                            <input {{ $product->status == 1 ? 'checked' : ''}} type="radio" value="1" class="custom-control-input" id="defaultGroupExample1" name="status" >
                                                            <label class="custom-control-label" for="defaultGroupExample1">Activo</label>
                                                        </div>
                                                        
                                                        <!-- Group of default radios - option 2 -->
                                                        <div class="custom-control custom-radio">
                                                            <input {{ $product->status == 2 ? 'checked' : ''}} type="radio" value="2" class="custom-control-input" id="defaultGroupExample2" name="status" >
                                                            <label class="custom-control-label" for="defaultGroupExample2">Borrador</label>
                                                        </div>
                                                        
                                                        <!-- Group of default radios - option 3 -->
                                                        <div class="custom-control custom-radio">
                                                            <input {{ $product->status == 3 ? 'checked' : ''}} type="radio" value="3" class="custom-control-input" id="defaultGroupExample3" name="status">
                                                            <label class="custom-control-label" for="defaultGroupExample3">Inactivo</label>
                                                        </div>
                                                   

                                                        <br>
                                                        <br>
                                                        <br>
                                                        
                                                        <label for="sel1">Categoría</label>
                                                        @foreach ($categories as $item)
                                                        
                                                            <div class="custom-control custom-radio">
                                                            <input {{ $product->category_id == $item->id ? 'checked' : ''}} type="radio" value="{{$item->id}}" class="custom-control-input" id="defaultGroupExample4" name="categoria">
                                                            <label class="custom-control-label" for="defaultGroupExample4">{{ $item->nombre}}</label>
                                                            </div>
                            
                                                        @endforeach

                                                        <br>
                                                        <br>
                                                        <br>
                                                        
                                                      
                                                </div>
                                                    


                                                
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-9">
                                                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                        <a class="btn btn-white" href="{{ route('inventario.index')}}">Cancel</a>
                                                        <button class="btn btn-sm btn-primary login-submit-cs" type="submit">Aceptar</button>
                                                    </div>
                                                </div>
                                            </div>
                                            {{ Form::close() }}
            </div>
        </div>
    </div>
</section>


@endsection
@section('scripts')
  <!-- dropzone JS
		============================================ -->
    <script src="{{ URL::asset('js/dropify.min.js')}}"></script>
    <script src="{{ URL::asset('js/jquery.mask.min.js')}}"></script>

    <script>
    $('.dropify').dropify({
        messages: {
        'default': 'Agrega una imagen descriptiva para remplazar',
        'replace': 'Agrega una imagen descriptiva para remplazar',
        'remove':  'Elimiar',
        'error':   'Ooops, un error ocurrió.'
        }
    });

    $('#price').mask('0000.00', {reverse: true});
    $('#date').mask('0000-00-00');


    </script>
        {{-- <script>
            tinymce.init({
            selector: 'textarea',
              plugins: 'lists ',
              toolbar: 'numlist bullist',
              formats: {
        // Changes the alignment buttons to add a class to each of the matching selector elements
        alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'left' },
        aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'center' },
        alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'right' },
        alignjustify: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img', classes: 'full' }
      }
            });
          </script>

 --}}


    

@endsection