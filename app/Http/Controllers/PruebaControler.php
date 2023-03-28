<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class PruebaControler extends Controller
{
    function probar($ruta){
        $categoria=Categoria::all();
    	return view('view3',['Categorias'=>$categoria, 'ruta'=>$ruta]);
    }
    function prueba(){
        return view('noPasar');
    }
}