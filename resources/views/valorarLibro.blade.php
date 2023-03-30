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
</head>

<body class="font-sans antialiased">

    @auth
    @include('layouts.navigation')
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
            <h1>Valorar Libro</h1>

            <div class='producto'>
                <form action="/valoracion" method="post">
                @csrf
                    <input type='text' name='id' value='{{ $libro->id }}' hidden>
                    <p class="producTitulo">{{ $libro->nombre }}</p>
                    <img src="{{ $libro->foto }}" alt="foto" />
                    <div class="star_content">
                        <input name="rate" value="1" type="radio" class="star" />
                        <input name="rate" value="2" type="radio" class="star" />
                        <input name="rate" value="3" type="radio" class="star" />
                        <input name="rate" value="4" type="radio" class="star" />
                        <input name="rate" value="5" type="radio" class="star" />
                    </div>
                    <button type="submit">Enviar</button>
                </form>
            </div>
        </div>
    </main>
</body>

</html>