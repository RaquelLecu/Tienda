<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('./css/styles.css') }}">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <script src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
    <script src="js/jquery.rating.pack.js"></script>
    <script>
        $(document).ready(function() {
            $('input.star').rating();
        });
    </script>
    <style>
        .star_content {
    margin-bottom: 5px;
    float: left;
    width: 100%;
}
 
.star {
    overflow: hidden;
    float: left;
    margin: 0 1px 0 0;
    width: 16px;
    height: 18px;
    cursor: pointer;
}
 
.star a {
    display: block;
    width: 100%;
    background-position: 0 0;
}
 
.star {
    position: relative;
    top: -1px;
    float: left;
    width: 14px;
    overflow: hidden;
    cursor: pointer;
    font-size: 14px;
    font-weight: normal;
}
 
.star a {
    display: block;
    position: absolute;
    text-indent: -5000px;
}
 
div.star:after {
    content: "\f006";
    font-family: "FontAwesome";
    display: inline-block;
    color: #777676;
}
 
div.star.star_on {
    display: block;
}
 
div.star.star_on:after {
    content: "\f005";
    font-family: "FontAwesome";
    display: inline-block;
    color: #ef8743;
}
 
div.star.star_hover:after {
    content: "\f005";
    font-family: "FontAwesome";
    display: inline-block;
    color: #ef8743;
}
    </style>
</head>

<body class="font-sans antialiased">

    @auth
    @include('layouts.navigation')
    @if(!session()->has('carrito'))
    {{ session()->put('carrito', []); }}
    {{ session()->put('carritoNum', 0); }}
    @endif
    @if(Auth::user()->admin)
    <nav id='nav-principal'>
        <button class='btnNav'><a href="{{url('/verLibros')}}">Ver Libros</a></button>
        <button class='btnNav'><a href="{{url('/verCategorias')}}">Ver Categorias</a></button>
        <button class='btnNav'><a href="{{url('/verCarrito')}}">Ver Carrito: {{ session('carritoNum') }}</a></button>
        <button class='btnNav'><a href="{{url('/guardarCategoria')}}">Gestionar Categoria</a></button>
        <button class='btnNav'><a href="{{url('/guardarLibro')}}">Gestionar Libros</a></button>
        <button class='btnNav'><a href="{{url('/guardarUsuario')}}">Gestionar Usuario</a></button>
    </nav>
    @else
    <nav id='nav-principal'>
        <button class='btnNav'><a href="{{url('/verLibros')}}">Ver Libros</a></button>
        <button class='btnNav'><a href="{{url('/verCategorias')}}">Ver Categorias</a></button>
        <button class='btnNav'><a href="{{url('/verCarrito')}}">Ver Carrito: {{ session('carritoNum') }}</a></button>
    </nav>
    @endif
    @endauth
    @guest
    @include('layouts.navigationguest')
    <nav id='nav-principal'>
        <button class='btnNav'><a href="{{url('/verLibros')}}">Ver Libros</a></button>
        <button class='btnNav'><a href="{{url('/verCategorias')}}">Ver Categorias</a></button>
    </nav>
    @endguest

    <main>
        <div>
        <form action="index.php" method="post">
        <div class="star_content">
            <input name="rate" value="1" type="radio" class="star"/> 
            <input name="rate" value="2" type="radio" class="star"/> 
            <input name="rate" value="3" type="radio" class="star"/> 
            <input name="rate" value="4" type="radio" class="star" checked="checked"/> 
            <input name="rate" value="5" type="radio" class="star"/>
        </div>
        <button type="submit" name="submitRatingStar" class="btn btn-primary btn-sm">Enviar</button>
        </form>
        </div>
    </main>
</body>

</html>