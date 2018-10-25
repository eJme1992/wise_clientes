<?php


namespace App\Http\Controllers;

use App\Cliente;
use App\Usuario;
use App\Web;
use App\host;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class ClientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function __construct(Request $request)
    {
      
    }

    public function index(Request $request)
    {
        //$request->user()->AutorizarRoles(['admin'],['user']);
        $Clientes = Cliente::all();
        return view('layouts.clientes.clientes',compact('Clientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.clientes.clientes_create',compact('Clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      if($request->ajax()){ 
        
       $validatedData = $request->validate([
        'nombrec'     => 'required',
        'logo'        => 'required|image',
        'tipo'        => 'required',
        'correoc'      => 'required',
        'telefonoc'    => 'required',
       ]);
      
       $Cliente               = new Cliente();
       if  ($request->file('logo')) {
           $file = $request->file('logo');
           $name = time().$file->getClientOriginalName();
           $name = str_replace(' ', '', $name);
           $name = $Cliente->limpiarCaracteresEspeciales($name);
           $file->move(public_path().'/img/programa/',$name);
           
       }
     
        
        $Cliente->nombre       = $request->input('nombrec');
        $Cliente->tipo         = $request->input('tipo');  
        $Cliente->descripcion  = $request->input('tipo');
        $Cliente->logo         = $name; 
        $Cliente->correo       = $request->input('correoc');  
        $Cliente->telefono     = $request->input('telefonoc');
        $Cliente->slug         = uniqid($request->input('nombrec'));
        $Cliente->save();

        if($request->input('p')==1){
        $correo = $request->input('correoc'); 
        $telefono = $request->input('telefonoc');
        }else{
        $correo = $request->input('correo'); 
        $telefono = $request->input('telefono');
        }


     $Cliente->usuarios()->create([
           'nombre'     => $request->input('nombre'),
           'apellido'   => $request->input('apellido'),
           'cargo'      => $request->input('cargo'),
           'tipo'       => 'principal',
           'correo'     => $correo,
           'telefono'   => $telefono
        ]);


          return response()->json([
                   'mensaje'=> 'Registro creado con exito',
                   'status'=> 'ok'
          ],200);
        
    }
  }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $Cliente)
    {  
       $user = Usuario::where('tipo','principal')->where('cliente_id',$Cliente->id)->first();
       $cliente = Cliente::findOrFail($Cliente->id);
       $usuarios = $cliente->usuarios;
       $hosts = $cliente->hosts;
       $mails = $cliente->mails;
       $dbs = $cliente->dbs;
       $sociales = $cliente->sociales;

       $webs = Web::join('hosts', 'hosts.id', '=', 'webs.host_id')->join('clientes', 'clientes.id', '=', 'hosts.cliente_id')->where('cliente_id',$Cliente->id)->get();

       return view('layouts.clientes.clientes_view',compact('Cliente','user','usuarios','hosts','mails','dbs','sociales','webs'));  
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $Cliente)
    {

     return view('layouts.clientes.clientes_edit',compact('Cliente'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $Cliente)
    { 
      if($request->ajax()){ 

   

       $Cliente->fill($request->except('logo'));       
      
      /* $user = Usuario::findOrFail($Cliente->id)->where('tipo','principal')->first();
       $user->tipo = 'standar';
       $user->save();*/
    
       
       if  ($request->file('logo')) {
           $file = $request->file('logo');
           $name = time().$file->getClientOriginalName();
           $name = str_replace(' ', '', $name);
           $name = $Cliente->limpiarCaracteresEspeciales($name);
           //$name = str_replace(' ', '', $Cliente->logo);
           $Cliente->logo = $name;
           $file->move(public_path().'/img/programa/',$name);
       }
       $Cliente->save();
     
       //$Clientes = Cliente::find(1);
          return response()->json([
                   'mensaje'=> 'Edición Exitosa',
                   'status'=> 'ok'
          ],200);
        
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $Cliente)
    {
       $file_path = public_path().'/img/programa/'.$Cliente->logo;
       \File::delete($file_path);
       $Cliente->delete();
       return redirect('clientes');
    }
}
