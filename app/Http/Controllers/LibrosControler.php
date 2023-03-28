<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use Illuminate\Http\Request;

class LibrosControler extends Controller
{
    function ver(){
        $libros=Producto::all();
        $algo=Producto::find(4);
        $valoracionPromedio = $algo->averageRating();
    	return view('verLibro',['libros'=>$libros, 'valoracionPromedio' => $valoracionPromedio]);
    }
    function carrito(){
        $libros=Producto::all();
    	return redirect('/verLibros');;
    }
    function guardar(){
        if (Auth::check()) {
            $usuario = Auth::user();
            if($usuario->admin){
                $libros=Producto::all();
                return view('guardarLibro',['libros'=>$libros]);
            }else{
                return view('noPasar');
            }            
        } else {
            return view('noPasar');
        }
    }

    function upLibro(Request $r){
        $path = $r->foto->store('images','public');
        //$path = $r->file()->store('images','public');
        $libro = new Producto;
        $libro->nombre = $r->nombre;
        $libro->descripcion = $r->descripcion;
        $libro->precio = doubleval($r->precio);
        $libro->foto = 'storage/'.$path;
        $libro->categoria_id = intval($r->categoria_id);
        $libro->save();
        return redirect('/verLibros');
    }
    function updateLibro(Request $r){
        $path = $r->foto->store('images','public');
        $libro = Producto::where('id','=',$r->id)->first();
        $libro->nombre = $r->nombre;
        $libro->descripcion = $r->descripcion;
        $libro->precio = doubleval($r->precio);
        $libro->foto = 'storage/'.$path;
        $libro->categoria_id = intval($r->categoria_id);
        $libro->save();
        return redirect('/verLibros');
    }
    function deleteLibro(Request $r){
        $libro = Producto::where('id','=',$r->id);
        $libro->delete();
        return redirect('/verLibros');
    }

    function catLibros(Request $r){
        $libros=Producto::where('categoria_id','=',$r->id)->get();
    	return view('verLibro',['libros'=>$libros]);
    }
}
