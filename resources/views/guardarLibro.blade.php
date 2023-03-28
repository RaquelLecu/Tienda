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
        <div class='up'>
            <h1>Guardar Libro</h1>
            <form action="{{ url('/upLibro') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" value="" required><br><br>
                <label for="descripcion">Descripcion:</label><br>
                <input type="text" id="descripcion" name="descripcion" value="" required><br><br>
                <label for="precio">Precio:</label><br>
                <input type="number" step='0.01' id="precio" name="precio" value="" required><br><br>
                <label for="foto">Foto:</label><br>
                <input type="file" id="foto" name="foto" value="" required><br><br>
                <label for="categoria_id">Categoria:</label><br>
                <input type="number" id="categoria_id" name="categoria_id" value="" required><br><br>
                <button type="submit">Guardar</button><br>
            </form>
        </div>
        <div class='up'>
            <h1>Cambiar Libro</h1>
            <p>Introduce el id de el libro que quieres cambiar</p>
            <form action="{{ url('/updateLibro') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="id">ID:</label><br>
                <input type="text" id="id" name="id" value="" required><br><br>
                <label for="nombre">Nombre:</label><br>
                <input type="text" id="nombre" name="nombre" value="" required><br><br>
                <label for="descripcion">Descripcion:</label><br>
                <input type="text" id="descripcion" name="descripcion" value="" required><br><br>
                <label for="precio">Precio:</label><br>
                <input type="number" step='0.01' id="precio" name="precio" value="" required><br><br>
                <label for="foto">Foto:</label><br>
                <input type="file" id="foto" name="foto" value="" required><br><br>
                <label for="categoria_id">Categoria:</label><br>
                <input type="number" id="categoria_id" name="categoria_id" value="" required><br><br>
                <button type="submit">Actualizar</button><br>
            </form>
        </div>
        <div class='up'>
            <h1>Borrar Libro</h1>
            <p>Introduce el id de el libro que quieres borrar</p>
            <form action="{{ url('/deleteLibro') }}" method="post" enctype="multipart/form-data">
                @csrf
                <label for="id">ID:</label><br>
                <input type="text" id="id" name="id" value="" required><br><br>
                <button type="submit">Borrar</button><br>
            </form>
        </div>
    </main>
</body>

</html>