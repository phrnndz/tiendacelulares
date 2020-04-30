@extends('dashboard.partials.base')
@section('titulo')
    Administración de Cursos
@endsection
@section('content')


<section class="row">
    <div class="col-sm-12">
        <section class="row">
            <div class="col-sm-12 col-md-12 ">
                <div class="card mb-4">
                    <div class="card-block">
                        <h3 class="card-title">Productos</h3>
                        <a class="btn btn-secondary margin"  href="{{ route('inventario.create')}}"> <span class="fa fa-plus"></span> Agregar Nuevo</a>
                        
                        <table class="table">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th>Título</th>
                                    <th>Precio</th>
                                    <th>Estatus</th>
                                    <th colspan="2">Operaciones</th>
                        
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($products as $producto)
                                <tr>
                                    @if(strlen($producto->photo) > 2)
                                <td> <img src="{{ URL::asset('img/'.$producto->photo)}}" width="40" height="40"></td>
                                    @else
                                        <td> <img src="{{ URL::asset('img/noimage.png')}}" width="40" height="40"></td>
                                    @endif
                                    <td>{{ $producto->name}} <br> <small>{{ str_limit($producto->description,30)}}</small></td>
                                    <td>${{ number_format($producto->price,2)}}</td>
                                    <td>
                                        
                                        @switch($producto->status)
                                        @case(1)
                                            <span class=" label-danger label-1 label">ACTIVO</span>
                                            @break
                                        @case(2)
                                            <span class=" label-info label-1 label">SIN PUBLICAR</span>
                                            @break
                                        @case(3)
                                            <span class=" label-warning label-1 label">INACTIVO</span>
                                            @break
                        
                                    @endswitch
                                    </td>
                                    <td><a class="btn btn-info" href="{{ route('inventario.edit',$producto->id)}}">Editar</a></td>
                        
                                    <td>
                                        <form action="{{ route('inventario.destroy', $producto->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Eliminar</button>
                                          </form>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Sin Artículos</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $products->links() }}

                    </div>
                </div>
        </section>

    </div>
</section>












@endsection
@section('scripts')

  <script>

  </script>
@endsection