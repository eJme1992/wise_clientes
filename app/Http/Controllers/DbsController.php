<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Db;

class DbsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id){
  return view('layouts.Dbs.Dbs_create',compact('id'));
  }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    if ($request->ajax()) {
       
       $validatedData = $request->validate(['dominio' => 'required', 'user' => 'required', 'pass' => 'required']);
       
       
       $cliente = Cliente::where('slug',$request->input('id_cliente'))->first();       


       $cliente->Dbs()->create([
           'dominio'     => $request->input('dominio'),
           'name'     => $request->input('name'),
           'user'     => $request->input('user'),
           'pass'     => $request->input('pass')
           
        ]);
      return response()->json(['mensaje' => 'Registro creado con exito', 'status' => 'ok'], 200);
    }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug,$id){
      $cliente = Cliente::where('slug',$slug)->first();
      $Db    = Db::where('id',$id)->first();
     return view('layouts.Dbs.Dbs_edit', compact('Db','cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request, Db $Db)
    {
      if ($request->ajax()) {    
        
         $Db->fill($request->except('id_cliente'));
         $id = $request->input('id_cliente');
         $Db->save();
         return response()->json(['mensaje' => 'Este usuario es principal debe escoger a otro usuario como principal para que este sea secundario', 'status' => 'ok'], 200);
         }

        }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$slug)
    {
         $Db = Db::where('id',$id)->first();
         $Db->delete();
        return redirect('clientes/'.$slug);
    }
}
