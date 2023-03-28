<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class LibreriaControler extends Controller
{
    function index(){
        $categorias=Categoria::all();
        $libros=Producto::all();
    	return view('home',['categorias'=>$categorias, 'libros'=>$libros]);
    }
}
