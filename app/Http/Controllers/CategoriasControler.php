<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoriasControler extends Controller
{
    function ver(){
        $categoria=Categoria::all();
    	return view('verCategoria',['categorias'=>$categoria]);
    }
    function guardar(){
        if (Auth::check()) {
            $usuario = Auth::user();
            if($usuario->admin){
                $categoria=Categoria::all();
    	        return view('guardarCategoria',['Categorias'=>$categoria]);
            }else{
                return view('noPasar');
            }            
        } else {
            return view('noPasar');
        }
    }

    function guardarCategoria(Request $r){
        $path = $r->foto->store('images','public');
        $categoria = new Categoria;
        $categoria->nombre = $r->nombre;
        $categoria->foto = 'storage/'.$path;
        $categoria->save();
        return redirect('/verCategorias');
    }
    function updateCategoria(Request $r){
        $path = $r->foto->store('images','public');
        $categoria = Categoria::find($r->id);
        Storage::delete(str_replace('storage/', '', $categoria->foto));
        $categoria->nombre = $r->nombre;
        $categoria->foto = 'storage/'.$path;
        $categoria->save();
        return redirect('/verCategorias');
    }
    function deleteCategoria(Request $r){
        $categoria = Categoria::find($r->id);
        Storage::delete(str_replace('storage/', '', $categoria->foto));
        $categoria->delete();
        return redirect('/verCategorias');
    }
    
}
