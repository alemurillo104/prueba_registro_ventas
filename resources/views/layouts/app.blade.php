<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    
    <!-- Styles -->
    <link type="text/css" rel="stylesheet" href="{{'/css/materialize.min.css'}}"  media="screen,projection"/>

    <link type="text/css" rel="stylesheet" href="{{'/css/alerts.css'}}"/>
    <link type="text/css" rel="stylesheet" href="{{'/css/stylesTable.css'}}"/>
    <link type="text/css" rel="stylesheet" href="{{'/css/basic/mybasicstyles.css'}}"/>

    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.3/css/fontawesome.min.css" class="">
    
    
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <script src="http://code.jquery.com/jquery-2.1.1.js"></script>
    

    <script src="/js/materialize.js"></script>
    <script src="/js/materialize.min.js"></script>
   
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>

    <style>
        header, main, footer, nav {
            font-family: Segoe UI, Arial, Helvetica, sans-serif;
        }
        @media only screen and (max-width : 992px) {
            header, main, footer, nav {
                padding-left: 0;
            }
        }
        .info{
            background-color: rgb(153, 153, 153) 
        }
    </style>
    @yield('astylesCSS')

</head>
<body>
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper #1565c0 blue darken-3">
            <a href="{{ route('admin.sell.create') }}" class="brand-logo" style="padding-left: 25px"><small>Registro de ventas</small></a>
            <a href="#" data-target="mobile-demo" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="{{ route('admin.usuario.index') }}">Clientes</a></li>
                <li><a href="{{ route('admin.product.index') }}">Productos</a></li>
                <li><a href="{{ route('admin.sell.index') }}">Ventas</a></li>
            </ul>
            </div>
        </nav>
    </div>
      <ul class="sidenav" id="mobile-demo">
        <li><a href="{{ route('admin.usuario.index') }}">Clientes</a></li>
        <li><a href="{{ route('admin.product.index') }}">Productos</a></li>
        <li><a href="{{ route('admin.sell.index') }}">Ventas</a></li>
      </ul>
              
    <main class="py-4">
        <div  style="margin: 20px 25px 20px 17px">
            @yield('content')
        </div>
    </main>
</body>
@yield('astylesJS')

<script>
    $(document).ready(function(){
        $('.sidenav').sidenav();
    });
</script>
@stack('script2')
</html>