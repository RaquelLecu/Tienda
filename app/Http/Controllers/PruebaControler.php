<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class PruebaControler extends Controller
{
    function probar(){
        $categoria=Categoria::all();
    	return view('view3');
    }
    function prueba(){
        return view('noPasar');
    }
}