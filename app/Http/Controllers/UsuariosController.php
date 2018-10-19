<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuariosController extends Controller
{
   public function create(){
    return view('layouts.usuarios.usuarios_create', compact('usuarios'));
  }

  public function store(Request $request){
    if ($request->ajax()) {
      $validatedData = $request->validate(['nombrec' => 'required', 'logo' => 'required|image', 'tipo' => 'required', 'correoc' => 'required', 'telefonoc' => 'required', ]);
     
      $usuario = new usuario();
      if ($request->file('logo')) {
        $file = $request->file('logo');
        $name = time() . $file->getClientOriginalName();
        $name = str_replace(' ', '', $name);
        $name = $usuario->limpiarCaracteresEspeciales($name);
        $file->move(public_path() . '/img/programa/', $name);
      }

      $usuario->nombre = $request->input('nombrec');
      $usuario->tipo = $request->input('tipo');
      $usuario->descripcion = $request->input('tipo');
      $usuario->logo = $name;
      $usuario->correo = $request->input('correoc');
      $usuario->telefono = $request->input('telefonoc');
      $usuario->slug = uniqid($request->input('nombrec'));
      $usuario->save();
      if ($request->input('p') == 1) {
        $correo = $request->input('correoc');
        $telefono = $request->input('telefonoc');
      }
      else {
        $correo = $request->input('correo');
        $telefono = $request->input('telefono');
      }

      $usuario->usuarios()->create(['nombre' => $request->input('nombre') , 'apellido' => $request->input('apellido') , 'cargo' => $request->input('cargo') , 'tipo' => 'principal', 'correo' => $correo, 'telefono' => $telefono]);
      return response()->json(['mensaje' => 'Registro creado con exito', 'status' => 'ok'], 200);
    }
  }

    public function edit(Usuario $usuario){
      return view('layouts.usuarios.usuarios_edit', compact('usuario'));
    }

    public function update(Request $request, usuario $usuario)
    {
      if ($request->ajax()) {
        $usuario->fill($request->except('logo'));
        /* $user = Usuario::findOrFail($usuario->id)->where('tipo','principal')->first();
        $user->tipo = 'standar';
        $user->save();*/
        if ($request->file('logo')) {
          $file = $request->file('logo');
          $name = time() . $file->getClientOriginalName();
          $name = str_replace(' ', '', $name);
          $name = $usuario->limpiarCaracteresEspeciales($name);

          // $name = str_replace(' ', '', $usuario->logo);

          $usuario->logo = $name;
          $file->move(public_path() . '/img/programa/', $name);
        }

        $usuario->save();

        // $usuarios = usuario::find(1);

        return response()->json(['mensaje' => 'Edición Exitosa', 'status' => 'ok'], 200);
      }
    }

    public function destroy(usuario $usuario)
    {
      $file_path = public_path() . '/img/programa/' . $usuario->logo;
      File::delete($file_path);
      $usuario->delete();
      return redirect('usuarios');
    }
}
