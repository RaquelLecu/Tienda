<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use Illuminate\Support\Facades\Auth;

class CarritoControler extends Controller
{
    function upCarrito(Request $r){
        $num = session('carritoNum');
        $num++;
        session()->put('carritoNum', $num);
        $libro = Producto::find($r->id);
        $items = session('carrito');
        array_push($items, $libro);
        session()->put('carrito', $items);
        return redirect('/verCarrito');
    }

    function borrarItem(Request $r){
        $num = session('carritoNum');
        $num--;
        session()->put('carritoNum', $num);
        $items = session('carrito');
        unset($items[$r->item]);
        session()->put('carrito', $items);
        return redirect('/verCarrito');
    }

    function ver(){
        return view('verCarrito');
    }
}
