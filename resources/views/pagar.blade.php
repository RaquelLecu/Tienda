<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'Laravel') }}</title>
  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('./css/styles.css') }}">
  <!-- Scripts -->
  <script src="https://js.stripe.com/v3/"></script>
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
    <div id='pago'>
      @php
      $total = 0;
      @endphp
      @foreach (session('carrito') as $index=>$item)
      @php
      $total+= $item->precio;
      @endphp
      @endforeach
      <p id='numProducto'>Numero de productos: {{ session('carritoNum') }}</p>
      <p id='totalPagar'>total: {{ $total }}€</p>
      <form action="{{ url('/createCharge') }}" method="post" id="payment-form">
        @csrf
        <div class="form-row">
          <label for="card-element">
            Tarjeta de Credito o Debito (prueba: 42)
          </label>
          <div id="card-element">
            <!-- A Stripe Element will be inserted here. -->
          </div>
          <!-- Used to display form errors. -->
          <div id="card-errors" role="alert"></div>
        </div>
        <button id='pagar'>Pagar</button>
      </form>
    </div>
  </main>
  <script>
    // Create a Stripe client.
    var stripe = Stripe('pk_test_51MpvuTFUFhVojPW4nSzo6KbMWGwmeZgjIwj2zLRafhNWXCrL67glGrMm7vSDCXK2gsmn8mhf8MLr3MC5XFlS1EiG009AmeAf8O');
    // Create an instance of Elements.
    var elements = stripe.elements();
    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
      base: {
        color: '#32325d',
        lineHeight: '18px',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
          color: '#aab7c4'
        }
      },
      invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
      }
    };
    // Create an instance of the card Element.
    var card = elements.create('card', {
      style: style
    });
    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');
    // Handle real-time validation errors from the card Element.
    card.addEventListener('change', function(event) {
      var displayError = document.getElementById('card-errors');
      if (event.error) {
        displayError.textContent = event.error.message;
      } else {
        displayError.textContent = '';
      }
    });
    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
      event.preventDefault();
      stripe.createToken(card).then(function(result) {
        if (result.error) {
          // Inform the user if there was an error.
          var errorElement = document.getElementById('card-errors');
          errorElement.textContent = result.error.message;
        } else {
          // Send the token to your server.
          stripeTokenHandler(result.token);
        }
      });
    });

    function stripeTokenHandler(token) {
      // Insert the token ID into the form so it gets submitted to the server
      var form = document.getElementById('payment-form');
      var hiddenInput = document.createElement('input');
      hiddenInput.setAttribute('type', 'hidden');
      hiddenInput.setAttribute('name', 'stripeToken');
      hiddenInput.setAttribute('value', token.id);
      form.appendChild(hiddenInput);
      // Submit the form
      form.submit();
    }
  </script>
</body>

</html>