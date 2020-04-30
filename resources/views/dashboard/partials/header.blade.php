{{-- https://medialoot.com/item/bootstrap-4-admin-dashboard-template/ Más info del template aquí --}}
<!doctype html>
<html class="no-js" lang="es">

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" type="image/png" href="{{ URL::asset('img/logo_formacion_politica.ico')}}" sizes="32x32">
        <title>@yield('titulo')</title>
    
        <!-- Bootstrap core CSS -->
        <link rel="stylesheet" href="{{ URL::asset('/css/bootstrap.min.css')}}" rel="stylesheet">
        
        <!-- Icons -->
        <link href="{{ URL::asset('css/font-awesome.css')}}" rel="stylesheet">
        
        <!-- Custom styles for this template -->
        <link href="{{ URL::asset('css/style.css')}}" rel="stylesheet">
        @yield('head')
        
    </head>
    <body>
        <div class="container-fluid" id="wrapper">
            <div class="row">
                <nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
                    <h1 class="site-title">Todo Celular Mexico</h1>
                                                        
                    <a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
                    <ul class="nav nav-pills flex-column sidebar-nav">
                        @role('Admin')
                            <li class="nav-item"><a class="nav-link" title="Productos" href="{{route('inventario.index')}}"><em class="fa fa-dashboard"></em>Productos</a></li>
                            <li class="nav-item"><a class="nav-link" title="Pagos" href="{{route('payment.index')}}"><em class="fa fa-dashboard"></em> Pagos</a></li>
                            <li class="nav-item"><a class="nav-link" title="Subscriptores" href="{{route('inventario.subscribers')}}"><em class="fa fa-dashboard"></em> Subscriptores</a></li>

                        @endrole                       
                    </ul>
                    <a href="{{url('logout')}}" class="logout-button"><em class="fa fa-power-off"></em> Signout</a>
                </nav>
                <main class="col-xs-12 col-sm-8 col-lg-9 col-xl-10 pt-3 pl-4 ml-auto">
                    <header class="page-header row justify-center">
                        <div class="col-md-6 col-lg-8" >
                            <h1 class="float-left text-center text-md-left"></h1>
                        </div>
                        <div class="dropdown user-dropdown col-md-6 col-lg-4 text-center text-md-right"><a class="btn btn-stripped dropdown-toggle" href="https://example.com" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="{{ URL::asset('img/noprofile.svg')}}" alt="profile photo" class="circle float-left profile-photo" width="50" height="auto">
                            <div class="username mt-1">
                                <h4 class="mb-1">{{ Auth::user()->name }}</h4>
                                <h6 class="text-muted">Super Admin</h6>
                            </div>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" style="margin-right: 1.5rem;" aria-labelledby="dropdownMenuLink">
                                {{-- <a class="dropdown-item" href="#"><em class="fa fa-user-circle mr-1"></em> View Profile</a> --}}
                                 {{-- <a class="dropdown-item" href="#"><em class="fa fa-sliders mr-1"></em> Preferences</a> --}}
                                 <a class="dropdown-item" href="{{url('logout')}}"><em class="fa fa-power-off mr-1"></em> Logout</a></div>
                        </div>
                        <div class="clear"></div>
                    </header>

    













