<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class pagoControler extends Controller
{
    function pagar(Request $request){   
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);
        if ($validator->fails()) {
            return redirect('/verCarrito')->withErrors($validator);
        }     
    	return view('pagar');
    }
    public function validarCaptcha(Request $request)
    {
        // Validar el captcha
        $validator = Validator::make($request->all(), [
            'g-recaptcha-response' => 'required|captcha'
        ]);

        // Si la validación falla, regresar al usuario con el error
        if ($validator->fails()) {
            return redirect('/')->withErrors($validator);
        }

        // Si la validación es correcta, continuar con el procesamiento del formulario
        // ...
    }

    function charge(){
        require_once(base_path('/vendor/autoload.php'));

        \Stripe\Stripe::setApiKey("sk_test_51MpvuTFUFhVojPW4ViL9bWPV9KdmbrimIl0roC1yY91GonoGWmMWYaU9bnOjycAHKEqj32FznNFPhTTOwQizODys00Py7mpp3B");
      
        $token = $_POST["stripeToken"];

        $carrito = session('carrito');
        $totalCompra = 0;
        foreach ($carrito as $producto) {
            $totalCompra += $producto->precio;
        }
      
        $charge = \Stripe\Charge::create([
          "amount" => $totalCompra*100,
          "currency" => "eur",
          "description" => "Pago en mi tienda...",
          "source" => $token
        ]);
        session()->put('carritoNum', 0);
        session()->put('carrito', []);
        return view('createcharge', ['charge'=>$charge]);
    }
}
