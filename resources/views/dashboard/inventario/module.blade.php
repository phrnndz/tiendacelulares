
@extends('dashboard.partials.base')
@section('titulo')
    Módulos
@endsection
@section('head') 
<meta name="csrf-token" content="{{ csrf_token() }}">
<link rel="stylesheet" href="{{ URL::asset('css/dropify/css/dropify.min.css')}}">
{{-- <link rel="stylesheet" href="{{ URL::asset('guest/css/parsley.css')}}"> --}}


<script src="https://cdn.tiny.cloud/1/rgurjpytbnb1q31gru8honk1nr5oi8klopm02g2sh8d2su57/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

@endsection
@section('content')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="#">Home</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{$product->name}}</li>
    </ol>
</nav>

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
                        <h3 class="card-title">Editar Módulos</h3>
                        


                                    
                                    @foreach ($product->module as $item)
                                    <div class="row mt-2">
                                        <div class="col-sm-12">
                                            <div class="card">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$item->name}} ({{$item->duration}} hrs.)</h5>
                                                    {{Form::open(['route' => 'inventario.deletemodule','method'=>'POST'])}}
                                                    <input type="hidden" name="id_module" value="{{ $item->id }}">
                                                    <button class="btn btn-warning btn-md  mg-tb-30" type="button" data-toggle="modal" data-target="#exampleModal" data-idmodulo="{{$item->id}}" data-idproducto="{{$product->id}}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar Contenido</button>
                                                    <button class="btn btn-info btn-md  mg-tb-30" type="button" data-toggle="modal" data-target="#editTitleModuleModal" data-idmodule="{{$item->id}}" data-nombremodulo="{{$item->name}}"><i class="fa fa-pencil" aria-hidden="true"></i> Editar Nombre de Módulo</button>
                                                    <button class="btn btn-danger btn-md  mg-tb-30" type="submit"> <i class="fa fa-trash" aria-hidden="true"></i>Eliminar Módulo</button> <br>
                                                    {{ Form::close() }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach

                        
                        <div class="row mt-3">
                            <div class="col-lg-9">
                                <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                    <button class="btn btn-custon-rounded-four btn-default" data-toggle="modal" data-target="#newmoduloModal" data-idproduct="{{$product->id}}" type="button">+ Agregar módulo</button>
                                    <a class="btn btn-sm btn-primary" href="{{ route('inventario.index')}}">Volver</a>
                                    {{-- <button class="btn btn-sm btn-primary login-submit-cs" type="butt">Aceptar</button> --}}
                                </div>
                            </div>
                        </div>
                </div>
        </div>
    </div>
</section>

{{-- Modal nuevo Módulo --}}
<div class="modal fade" id="newmoduloModal" tabindex="-1" role="dialog" aria-labelledby="newmoduloLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil" aria-hidden="true"></i> Nuevo Módulo</h4>
        </div>
       
        <div class="modal-body">
            
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{Form::open(['route' => 'inventario.addmodule','method'=>'POST'])}}
                        <div class="form-group input_fields_wrap_subthemes">
                            <input type="hidden" class="asigna-id-product" name="id_product">
                            <input class="form-control" type="text" name="name" placeholder="Nombre de Módulo" required>
                            <input class="form-control" type="number" name="duration" placeholder="Duración en Horas de Módulo" required>

                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Guardar</button>
                        {{ Form::close() }}

                    </div>
                </div>

           
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
       
      </div>
    </div>
  </div>

<!-- Modal Nueva Seccion -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{-- <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil" aria-hidden="true"></i> Temas del Módulo</h4> --}}
        </div>
       
        <div class="modal-body">
            
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h4 class="modal-title"><i class="fa fa-bars" aria-hidden="true"></i> Temas de este módulo</h4>
                        <table class="table table-striped">
                            <tbody id="table-submodules" >
                            </tbody>
                        </table>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h4 class="modal-title"><i class="fa fa-bars" aria-hidden="true"></i> Nuevo Tema</h4>
                        <form action="" id="formNewSubmodule">
                        <div class="form-group">
                            <input type="hidden" class="asigna-id-modulo" name="id_module">
                            <input type="hidden" class="asigna-id-producto" name="id_product">
                            
                            
                            <input class="form-control" type="text" name="name" placeholder="" required>
                        </div>
                        
                        <div class="form-group input_fields_wrap">
                            <label for="titulo">Añadir subtemas</label>
                            <button class="btn btn-custon-rounded-four btn-default add_field_button" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Agregar subtema</button>
                            <div><input class="form-control" type="text" name="arrayThemes[]" value="" placeholder="" required></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                        </form>
                    </div>
                </div>

           
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
       
      </div>
    </div>
  </div>
{{-- Editar los temas de la sección --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          {{-- <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil" aria-hidden="true"></i> Subtemas de este tema</h4> --}}
        </div>
       
        <div class="modal-body">
            
                <div class="row">
                    
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <h4 class="modal-title"><i class="fa fa-bars" aria-hidden="true"></i> Subtemas de este tema</h4>
                        <table class="table table-striped">
                            <tbody id="table-subthemes" >
                            </tbody>
                        </table>
                        
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <form action="" id="formNewSubtheme">
                        <h4 class="modal-title"><i class="fa fa-bars" aria-hidden="true"></i> Nuevo Subtema</h4>
                        <div class="form-group input_fields_wrap_subthemes">
                            <input type="hidden" class="asigna-id-submodule" name="id_submodule">
                            <button class="btn btn-custon-rounded-four btn-default add_field_button_subthemes" type="button"><i class="fa fa-plus" aria-hidden="true"></i> Agregar Subtema</button>
                            <div><input class="form-control" type="text" name="arraySubthemes[]" value="" placeholder="" required></div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Guardar Cambios</button>
                        </form>
                    </div>
                </div>

           
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
       
      </div>
    </div>
  </div>

{{-- editar el titulo/nombre del módulo --}}
<div class="modal fade" id="editTitleModuleModal" tabindex="-1" role="dialog" aria-labelledby="newmoduloLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil" aria-hidden="true"></i> Editar Titulo de Módulo</h4>
        </div>
       
        <div class="modal-body">
            
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{Form::open(['route' => 'inventario.updatetitlemodule','method'=>'POST'])}}
                        <div class="form-group ">
                            <input type="hidden" class="asigna-id-module" name="id_module">
                            <input class="form-control" type="text" name="name" placeholder="Nombre de Módulo" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                        {{ Form::close() }}

                    </div>
                </div>

           
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
       
      </div>
    </div>
  </div>

{{-- Editar titulo/nombre de submodulo --}}
<div class="modal fade" id="editTitleSubmoduleModal" tabindex="-1" role="dialog" aria-labelledby="newmoduloLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil" aria-hidden="true"></i> Editar Título de Sección</h4>
        </div>
       
        <div class="modal-body">
            
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{Form::open(['route' => 'inventario.updatetitlesubmodule','method'=>'POST'])}}
                        <div class="form-group ">
                            <input type="hidden" class="asigna-id-submodule" name="id_submodule">
                            <input class="form-control" type="text" name="name" placeholder="Nombre de Módulo" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                        {{ Form::close() }}

                    </div>
                </div>

           
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
       
      </div>
    </div>
  </div>

  {{-- Editar titulo/nombre de tema --}}
  <div class="modal fade" id="editTitleSubthemeModal" tabindex="-1" role="dialog" aria-labelledby="newmoduloLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel"><i class="fa fa-pencil" aria-hidden="true"></i> Editar Nombre de Tema</h4>
        </div>
       
        <div class="modal-body">
            
                <div class="row">
                    
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        {{Form::open(['route' => 'inventario.updatetitlesubtheme','method'=>'POST'])}}
                        <div class="form-group ">
                            <input type="hidden" class="asigna-id-subtema" name="id_subtheme">
                            <input class="form-control" type="text" name="name" placeholder="Nombre de Módulo" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Actualizar</button>
                        {{ Form::close() }}

                    </div>
                </div>

           
            
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          
        </div>
       
      </div>
    </div>
  </div>

 @endsection
@section('scripts')
        <script src="{{ URL::asset('guest/js/parsley.min.js')}}"></script>


        <script>
          $('#formNewSubmodule').parsley();
          $('#formNewSubtheme').parsley();
        </script>

<script>
    $(document).ready(function() {
        $('#newmoduloModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var idproduct = button.data('idproduct') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

        var modal = $(this)
        modal.find('.modal-body .asigna-id-product').val(idproduct)
        

        });



       
        
});
</script>
       
        <script>
            $(document).ready(function() {
                $('#exampleModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget) // Button that triggered the modal
                var idmodulo = button.data('idmodulo') // Extract info from data-* attributes
                var idproducto = button.data('idproducto') // Extract info from data-* attributes

                // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                $.ajax({
                      type: "get",
                      url: `../obtenersubmodulos/${idmodulo}`,
                      dataType: 'json',
                      success: function (data) {
                            $('#table-submodules').html(` `); 
                            data.forEach(function(submodule, index) {

                                $('#table-submodules').append(`<tr><td>
                                <button   data-toggle="modal" data-target="#editTitleSubmoduleModal" data-idsubmodule="${submodule['id']}" data-nombresubmodulo="${submodule['name']}" class="btn btn-info" type="button"><i class="fa fa-pencil" aria-hidden="true"></i> 
                                <button class="btn btn-default" onclick="deletesubmodule(${submodule['id']})" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>  
                                <button   data-toggle="modal" data-target="#editModal" data-idsubmodulo="${submodule['id']}" class="btn btn-default" type="button"><i class="fa fa-eye" aria-hidden="true"></i> 
                                </button>
                                ${submodule['name']}     
                                                                                
                                </td></tr>`); 
                            });
                            // Swal.fire({
                            //     type: 'success',
                            //     title: 'Everything good!',
                            //     text: 'Success',
                            // });
                      },
                      error: function (data) {
                            // Swal.fire({
                            //     type: 'error',
                            //     title: 'Oops...',
                            //     text: data.responseText,
                            // });
                      }
                });

                

                var modal = $(this)
                modal.find('.modal-title').html()
                modal.find('.modal-body .asigna-id-modulo').val(idmodulo)
                modal.find('.modal-body .asigna-id-producto').val(idproducto)
                

                });


                //Add fields to subthemes

                var max_fields      = 10; //maximum input boxes allowed
                var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
                var wrapper_edit    = $(".input_fields_wrap_subthemes"); //Fields wrapper
                var add_button      = $(".add_field_button"); //Add button ID
                var add_button_edit = $(".add_field_button_subthemes"); //Add button ID

                
                var x = 1; //initlal text box count
                $(add_button).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(x < max_fields){ //max input box allowed
                        x++; //text box increment
                        $(wrapper).append('<div class="input-group"><input class="form-control" type="text"  placeholder="Nuevo Tema"  name="arrayThemes[]"/><span class="input-group-btn"><button class="btn btn-default remove_field" type="button" required><i class="fa fa-trash" aria-hidden="true"></i></button> </span></div>'); //add input box
                    }
                });
                
                $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).closest('div').remove(); x--;
                })


                var y = 1; //initlal text box count
                $(add_button_edit).click(function(e){ //on add input button click
                    e.preventDefault();
                    if(y < max_fields){ //max input box allowed
                        y++; //text box increment
                        $(wrapper_edit).append('<div class="input-group"><input class="form-control" type="text"  placeholder="Nuevo Tema"  name="arraySubthemes[]"/><span class="input-group-btn"><button class="btn btn-default remove_field" type="button" required><i class="fa fa-trash" aria-hidden="true"></i></button> </span></div>'); //add input box
                    }
                });
                
                $(wrapper_edit).on("click",".remove_field", function(e){ //user click on remove text
                    e.preventDefault(); $(this).closest('div').remove(); y--;
                })

               
                
        });
        </script>
<script>
    $(document).ready(function() {
        //edita el titulo del módulo
        $('#editTitleModuleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var idmodule = button.data('idmodule') // Extract info from data-* attributes
        var nombremodulo = button.data('nombremodulo');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body .asigna-id-module').val(idmodule);
        modal.find('input[name="name"]').val(nombremodulo);
        }); 

        //edita el titulo del submódulo
        $('#editTitleSubmoduleModal').on('show.bs.modal', function (event) {
        $('#exampleModal').modal('toggle');
        var button = $(event.relatedTarget) // Button that triggered the modal
        var idsubmodule = button.data('idsubmodule') // Extract info from data-* attributes
        var nombresubmodulo = button.data('nombresubmodulo');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body .asigna-id-submodule').val(idsubmodule);
        modal.find('input[name="name"]').val(nombresubmodulo);
        }); 

        $('#editTitleSubthemeModal').on('show.bs.modal', function (event) {
        $('#editModal').modal('toggle');
        var button = $(event.relatedTarget) // Button that triggered the modal
        var idsubtheme = button.data('idsubtheme') // Extract info from data-* attributes
        var nombresubtema = button.data('nombresubtema');
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        var modal = $(this)
        modal.find('.modal-body .asigna-id-subtema').val(idsubtheme);
        modal.find('input[name="name"]').val(nombresubtema);
        });  

        
    });
</script>
<script>
    $(document).ready(function() {
        $('#editModal').on('show.bs.modal', function (event) {
        $('#exampleModal').modal('toggle');
        var button = $(event.relatedTarget) // Button that triggered the modal
        var idsubmodulo = button.data('idsubmodulo') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        $.ajax({
              type: "get",
              url: `../obtenersubtemas/${idsubmodulo}`,
              dataType: 'json',
              success: function (data) {
                    console.log(data);
                    $('#table-subthemes').html(` `); 
                    data.forEach(function(subtheme, index) {

                        $('#table-subthemes').append(`<tr><td>
                        <button data-toggle="modal" class="btn btn-default" onclick="deletesubtheme(${subtheme['id']})" type="button"><i class="fa fa-trash" aria-hidden="true"></i></button>
                        <button  data-toggle="modal" data-target="#editTitleSubthemeModal" data-idsubtheme="${subtheme['id']}" data-nombresubtema="${subtheme['name']}" class="btn btn-info" type="button"><i class="fa fa-pencil" aria-hidden="true"></i> </button>


                        ${subtheme['name']} </td></tr>`); 
                    });

              },
              error: function (data) {

              }
        });

        

        var modal = $(this)
        modal.find('.modal-body .asigna-id-submodule').val(idsubmodulo)


        });


        //Add fields to subthemes

        var max_fields      = 10; //maximum input boxes allowed
        var wrapper   		= $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                $(wrapper).append('<div class="input-group"><input class="form-control" type="text"  placeholder="Nuevo Tema"  name="arrayThemes[]"/><span class="input-group-btn"><button class="btn btn-default remove_field" type="button" required><i class="fa fa-trash" aria-hidden="true"></i></button> </span></div>'); //add input box
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            e.preventDefault(); $(this).closest('div').remove(); x--;
        })

       
        
});
</script>
        <script>
             //post new submodule and themes
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            
            function deletesubmodule(idsubmodule){
                $.ajax({
                    url: "{{ route('inventario.deletesubmodule') }}",
                    data:  {id_submodule: idsubmodule},
                    type: "post",
                    dataType: 'json',
                    success: function (data) {
                            $('#exampleModal').modal('toggle');
                            Swal.fire({
                                type: 'success',
                                title: 'Correcto',
                                text: 'El Registro se eliminó correctamente',
                            });
                    },
                    error: function (data) {
                            console.log('Error:', data);
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                            });
                    }

                });
            }
            function deletesubtheme(idsubtheme){
                $.ajax({
                    url: "{{ route('inventario.deletesubtheme') }}",
                    data:  {id_subtheme: idsubtheme},
                    type: "post",
                    dataType: 'json',
                    success: function (data) {
                            $('#editModal').modal('toggle');
                            Swal.fire({
                                type: 'success',
                                title: 'Correcto',
                                text: 'El Registro se eliminó correctamente',
                            });
                    },
                    error: function (data) {
                            console.log('Error:', data);
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                            });
                    }

                });
            }
            $(document).on('submit', '[id^=formNewSubmodule]', function (e) {
                e.preventDefault();
                $.ajax({
                    url:`../updatemodule`,
                    data:  $('#formNewSubmodule').serialize(),
                    type: "POST",
                    dataType: 'json',
                    success: function (data) {
                            $('#formNewSubmodule').trigger("reset");
                            $('#exampleModal').modal('toggle');
                            Swal.fire({
                                type: 'success',
                                title: 'Correcto',
                                text: 'El Registro se guardo correctamente',
                            });
                    },
                    error: function (data) {
                            console.log('Error:', data);
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: data,
                            });
                    }

                });


            });
            $(document).on('submit', '[id^=formNewSubtheme]', function (e) {
                e.preventDefault();
                $.ajax({
                    type: "get",
                    url:`../updatesubmodule`,
                    data:  $('#formNewSubtheme').serialize(),
                    dataType: 'json',
                    success: function (data) {
                            $('#formNewSubtheme').trigger("reset");
                            $('#editModal').modal('toggle');
                            Swal.fire({
                                type: 'success',
                                title: 'Correcto',
                                text: 'El Registro se guardo correctamente',
                            });
                    },
                    error: function (data) {
                            alert(data);
                            Swal.fire({
                                type: 'error',
                                title: 'Oops...',
                                text: data,
                            });
                    }

                });


            });
        </script>





    

@endsection