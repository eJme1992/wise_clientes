<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Host;

class hostsController extends Controller
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
  return view('layouts.hosts.hosts_create',compact('id'));
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
       
       /*$validatedData = $request->validate(['host' => 'required', 'user' => 'required', 'pass' => 'required']);*/
       
       
       $cliente = Cliente::where('slug',$request->input('id_cliente'))->first();       


       $cliente->hosts()->create([
       
           'hosting'         => $request->input('hosting'),
           'plan'            => $request->input('plan'),
           'url_cpanel'      => $request->input('url_cpanel'),
           'user'            => $request->input('user'),
           'pass'            => $request->input('pass'),
           'cuenta'          => $request->input('cuenta'),
           'pin'             => $request->input('pin')
           
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
      $host    = host::where('id',$id)->first();
     return view('layouts.hosts.hosts_edit', compact('host','cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request, host $host)
    {
      if ($request->ajax()) {    
        
         $host->fill($request->except('id_cliente'));
         $id = $request->input('id_cliente');
         $host->save();
         return redirect('hosts/edit'.$id.''.$host->id);
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
         $host = host::where('id',$id)->first();
         $host->delete();
        return redirect('clientes/'.$slug);
    }
}
