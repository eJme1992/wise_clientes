<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Web;
use App\Host;
use App\db;

class websController extends Controller
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
        $cliente = Cliente::where('slug',$id)->first();
       //$cliente = Cliente::findOrFail($id);
       //$dbs = $cliente->dns;
       $hosts = Host::where('cliente_id',$cliente->id)->get();  
       $dbs = Db::where('cliente_id',$cliente->id)->get(); 
       return view('layouts.webs.webs_create',compact('id','hosts','dbs'));
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
       
       /*$validatedData = $request->validate(['web' => 'required', 'user' => 'required', 'pass' => 'required']);*/
      //cliente = Cliente::where('slug',$request->input('id_cliente'))->first();       
       $host = Host::where('id',$request->input('hosting_id'))->first();  

     $host->webs()->create([
           'db_id'        => $request->input('db_id'),
           'url'          => $request->input('url'),
           'url_admin'    => $request->input('url_admin'),
           'tipo'         => $request->input('tipo'),
           'user'         => $request->input('user'),
           'pass'         => $request->input('pass')    
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
      $web    = web::where('id',$id)->first();
     return view('layouts.webs.webs_edit', compact('web','cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request, web $web)
    {
      if ($request->ajax()) {    
        
         $web->fill($request->except('id_cliente'));
         $id = $request->input('id_cliente');
         $web->save();
         return redirect('webs/edit'.$id.''.$web->id);
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
         $web = web::where('id',$id)->first();
         $web->delete();
        return redirect('clientes/'.$slug);
    }
}
