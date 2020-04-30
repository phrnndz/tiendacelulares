@extends('dashboard.partials.base')
@section('titulo')
Nuevo
@endsection
@section('head') 
<link rel="stylesheet" href="{{ URL::asset('css/dropify/css/dropify.min.css')}}">
{{-- <script src="https://cdn.tiny.cloud/1/rgurjpytbnb1q31gru8honk1nr5oi8klopm02g2sh8d2su57/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}
<link href="{{ asset('css/datetimepicker/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
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
        <section class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-block">
                        <h3 class="card-title">Nuevo</h3>
                        {{Form::open(['route' => 'inventario.store','method'=>'POST', 'files' => true ,'enctype' => 'multipart/form-data'])}}
                            {{-- <div class="form-group row">
                                <label class="col-md-3 col-form-label">Default input field</label>
                                <div class="col-md-9">
                                    <input type="text" name="regular" class="form-control">
                                </div>
                            </div> --}}
                            <div class="form-group">
                                <input name="name" type="text" class="form-control" placeholder="Titulo" value="{{ old('name') }}"  required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" placeholder="Descripción" name="goal"  cols="30" rows="10" >{{ old('goal') }}</textarea>

                            </div>
                           
                           
                            <div class="form-group">
                                <input class="form-control datetimepicker" name="date" type="text" id="date" placeholder="Fecha" value="{{ old('date') }}" required>
                                {{-- <input  type="number" class="form-control" placeholder="Precio"> --}}
                            </div>
                            <div class="form-group">
                                <input class="form-control" name="price" type="text" id="price" placeholder="Precio" value="{{ old('price') }}" required>
                                {{-- <input  type="number" class="form-control" placeholder="Precio"> --}}
                            </div>
                            <div>
                                {{ Form::file('photo',['class' => 'dropify'])}}
                                {{-- <input type="file" name="photo" class="dropify" data-allowed-file-extensions="jpg png jpeg" data-max-file-size-preview="1M" data-min-height="400" /> --}}
                            </div>
                            <br>
                            <br>
                            <br>
                            <h3 class="card-title">Estatus y Categoría</h3>
                            <div class="row">
                                <div class="col-lg-4 mb-sm-4 mb-lg-0">
                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="1" class="custom-control-input" id="defaultGroupExample1" name="status" >
                                        <label class="custom-control-label custom-control-description" for="defaultGroupExample1">Activo</label>
                                    </div>
                                    
                                    <!-- Group of default radios - option 2 -->
                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="2" class="custom-control-input" id="defaultGroupExample2" name="status" checked>
                                        <label class="custom-control-label custom-control-description" for="defaultGroupExample2">Borrador</label>
                                    </div>
                                    
                                    <!-- Group of default radios - option 3 -->
                                    <div class="custom-control custom-radio">
                                        <input type="radio" value="3" class="custom-control-input" id="defaultGroupExample3" name="status">
                                        <label class="custom-control-label custom-control-description" for="defaultGroupExample3">Inactivo</label>
                                    </div>
                                    
                                </div>
                                <div class="col-lg-4">
                                    @foreach ($categories as $item)
                    
                                        <div class="custom-control custom-radio">
                                        <input type="radio" value="{{$item->id}}" class="custom-control-input" id="{{ $item->nombre}}" name="categoria">
                                        <label class="custom-control-label custom-control-description" for="{{ $item->nombre}}">{{ $item->nombre}}</label>
                                        </div>

                                    @endforeach
                                </div>

                            
                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="row">
                                <button type="submit" class="btn btn-lg btn-primary">Aceptar</button>
                            </div>
                           
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </section>


    </div>
</section>

@endsection
@section('scripts')
  <!-- dropzone JS
		============================================ -->
    <script src="{{ URL::asset('js/dropify.min.js')}}"></script>
    {{-- <script src="{{ URL::asset('js/jquery.maskMoney.js')}}"></script> --}}
    <script src="{{ URL::asset('js/jquery.mask.min.js')}}"></script>
    <script src="{{ URL::asset('js/moment/moment.min.js') }}"></script>
    <script src="{{ URL::asset('js/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>


    
    <script>
    $('.dropify').dropify({
        messages: {
        'default': 'Agrega una imagen descriptiva',
        'replace': 'Agrega una imagen descriptiva para remplazar',
        'remove':  'Elimiar',
        'error':   'Ooops, un error ocurrió.'
        }
    });

    // $("#demo1").maskMoney({thousands:'', decimal:'.'});
    $('#price').mask('0000.00', {reverse: true});
    $('.datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            // defaultDate: new Date(2000, 0, 1, 00, 01),
    });


    $(document).ready(function() {
        var max_fields      = 10; //maximum input boxes allowed
        var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div><input class="form-control" type="text" name="modules[]" required/><a href="#" class="remove_field">Eliminar</a></div>'); //add input box
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).parent('div').remove(); x--;
        })
    });

    


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
      </script> --}}

    

@endsection