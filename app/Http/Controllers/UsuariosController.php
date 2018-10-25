<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Usuario;

class UsuariosController extends Controller
{
 public function create($id){
  return view('layouts.usuarios.usuarios_create',compact('id'));
  }

  public function store(Request $request){
    if ($request->ajax()) {
       
       $validatedData = $request->validate(['nombre' => 'required', 'apellido' => 'required', 'tipo' => 'required', 'correo' => 'required', 'telefono' => 'required', ]);
       
       
       $cliente = Cliente::where('slug',$request->input('id_cliente'))->first();
       $id =  $cliente->id;

       if($request->input('tipo') == 'principal'){ 
       $user = Usuario::where('tipo','principal')->where('cliente_id',$id)->first();
       if($user!=null){
       $user->tipo = 'secundario';
       $user->save();}
       }
       $Cliente = Cliente::where('id',$id)->first();
       


       $Cliente->usuarios()->create([
           'nombre'     => $request->input('nombre'),
           'apellido'   => $request->input('apellido'),
           'cargo'      => $request->input('cargo'),
           'tipo'       => $request->input('tipo'),
           'correo'     => $request->input('correo'),
           'telefono'   => $request->input('telefono'),
        ]);
      return response()->json(['mensaje' => 'Registro creado con exito', 'status' => 'ok'], 200);
    }
  }

    public function edit($slug,$id){
      $cliente = Cliente::where('slug',$slug)->first();
      $usuario = Usuario::where('id',$id)->first();
     return view('layouts.usuarios.usuarios_edit', compact('usuario','cliente'));
    }

    public function update(Request $request, usuario $usuario)
    {
      if ($request->ajax()) {    
        $usuario->fill($request->except('id_cliente'));
        $id = $request->input('id_cliente');

        if($request->input('tipo') == 'principal'){
        $user = Usuario::where('tipo','principal')->where('cliente_id',$id)->first();
        if($user!=null){
        $user->tipo = 'secundario';
        $user->save();}
        }else{
         $var= Usuario::where('tipo','principal')->where('id',$usuario->id)->first();
         if($var!=null){ 
         return response()->json(['error' => 'Este usuario es principal debe escoger a otro usuario como principal para que este sea secundario', 'status' => '0'], 200);
         }

        }




        $usuario->save();

        // $usuarios = usuario::find(1);

        return response()->json(['mensaje' => 'Edición Exitosa', 'status' => 'ok'], 200);
      }
    }

    public function destroy($id,$slug)
    {
      $cliente = Cliente::where('slug',$slug)->first();  
      $usuario = Usuario::where('id',$id)->first();
      if($usuario->tipo == 'principal'){
        $user = Usuario::where('tipo','secundario')->where('cliente_id',$cliente->id)->first();
        if(count($user)){
        $user->tipo = 'principal';
        $user->save();
        }else{
        return redirect('clientes/'.$slug);
        }
        }
        $usuario->delete();
        return redirect('clientes/'.$slug);
    }
}
