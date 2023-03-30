<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LibrosControler extends Controller
{
    function ver(){
        $libros=Producto::all();
        $valoracion=[];
        foreach($libros as $lib){
            $valoracionPromedio = $lib->averageRating();
            array_push($valoracion, $valoracionPromedio);
        }
    	return view('verLibro',['libros'=>$libros,'valoracion'=>$valoracion]);
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
        $libro = Producto::find($r->id);
        Storage::delete(str_replace('storage/', '', $libro->foto));
        $libro->nombre = $r->nombre;
        $libro->descripcion = $r->descripcion;
        $libro->precio = doubleval($r->precio);
        $libro->foto = 'storage/'.$path;
        $libro->categoria_id = intval($r->categoria_id);
        $libro->save();
        return redirect('/verLibros');
    }
    function deleteLibro(Request $r){
        $libro = Producto::find($r->id);
        Storage::delete(str_replace('storage/', '', $libro->foto));
        $libro->delete();
        return redirect('/verLibros');
    }

    function catLibros(Request $r){
        $libros=Producto::where('categoria_id','=',$r->id)->get();
    	$valoracion=[];
        foreach($libros as $lib){
            $valoracionPromedio = $lib->averageRating();
            array_push($valoracion, $valoracionPromedio);
        }
    	return view('verLibro',['libros'=>$libros,'valoracion'=>$valoracion]);
    }

    function valorarLibro(Request $r){
        $libro = Producto::find($r->id);
        return view('valorarLibro', ['libro'=>$libro]);
    }

    function valoracion(Request $r){
        $libro = Producto::find($r->id);
        $usuario = Auth::user();
        $rating = new \willvincent\Rateable\Rating;
        $rating->rating = $r->rate;
        $rating->user_id = $usuario->id;
        $libro->ratings()->save($rating);
        return redirect('/verLibros');   
    }    
       
}
