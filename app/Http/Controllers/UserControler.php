<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserControler extends Controller
{
    function guardar(){
        if (Auth::check()) {
            $usuario = Auth::user();
            if($usuario->admin){
                $user=User::all();
    	        return view('guardarUsuario',['user'=>$user]);
            }else{
                return view('noPasar');
            }            
        } else {
            return view('noPasar');
        }
    }

    function upUser(Request $r){
        $user = new User;
        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = $r->password;
        $user->save();
        return redirect('/guardarUsuario');
    }
    function updateUser(Request $r){
        $user = User::where('id','=',$r->id)->first();
        $user->name = $r->name;
        $user->email = $r->email;
        $user->password = $r->password;
        $user->save();
        return redirect('/guardarUsuario');
    }
    function deleteUser(Request $r){
        $user = User::where('id','=',$r->id);
        $user->delete();
        return redirect('/guardarUsuario');
    }
}
