<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cliente;
use App\Mail;

class MailsController extends Controller
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
  return view('layouts.mails.mails_create',compact('id'));
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
       
       $validatedData = $request->validate(['mail' => 'required', 'user' => 'required', 'pass' => 'required']);
       
       
       $cliente = Cliente::where('slug',$request->input('id_cliente'))->first();       


       $cliente->mails()->create([
           'mail'     => $request->input('mail'),
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
      $mail    = Mail::where('id',$id)->first();
     return view('layouts.mails.mails_edit', compact('mail','cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
       public function update(Request $request, mail $mail)
    {
      if ($request->ajax()) {    
        
         $mail->fill($request->except('id_cliente'));
         $id = $request->input('id_cliente');
         $mail->save();
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
         $mail = Mail::where('id',$id)->first();
         $mail->delete();
        return redirect('clientes/'.$slug);
    }
}
