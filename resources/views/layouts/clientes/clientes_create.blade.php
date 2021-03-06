@extends('layouts.app')
@section('title', 'Nuevo cliente')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;">Nuevo cliente <i class="fas fa-plus-circle"></i></h2>

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newcliente">
      @csrf
      <div class="formularios" id="nuevo_cliente">
         <div class="col-sm-6">
            <label>Nombre:</label>
            <input type="text" name="nombrec" id="nombrec" class="form-control" required="" placeholder="Cliente">
         </div>
         <div class="col-sm-6">
            <label>Tipo:</label>
            <select name="tipo" id="tipo" class="form-control" required="">
               <option>Persona Natural</option>
               <option>Persona Jurídica</option>
            </select>
         </div>
         <div class="col-sm-12">
            <label>Descripción:</label>
            <textarea name=descripcion" id="descripcion" class="form-control" required=""></textarea>
         </div>
         <div class="col-sm-4">
            <label>Logo:</label>
            <input type="file" name="logo" id="logo" class="form-control" required="">
         </div>
         <div class="col-sm-4">
            <label>Correo Principal:</label>
            <input type="mail" name="correoc" id="correoc" class="form-control" required="" placeholder="Correo Principal">
         </div>
         <div class="col-sm-4">
            <label>Teléfono principal:</label>
            <input type="number" name="telefonoc" id="telefonoc" class="form-control" required="" placeholder="Telefono principal">
         </div>
         <div class="col-sm-12" style="margin-top:15px;">
              <div id="resultado"></div>
            <button type="button" onclick="cliente();" name="enviar" id="enviar" class="btn-primary btn-block btn">
            Siguiente <i class="fas fa-chevron-right"></i>
            </button>	
         </div>
      </div>
      <div class="formularios ocultar" id="nuevo_usuario">
         <div class="col-sm-12">
            <h4 style="display:inline;">Persona de contacto</h4>
            <button class="btn-xs btn btn-primary" type="button" onclick="mostrar()"> <i class="fas fa-chevron-left"></i> Atrás</button>
         </div>
         <div class="col-sm-6">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required="" placeholder="Nombre">
         </div>
         <div class="col-sm-6">
            <label>Apellido:</label>
            <input type="text" name="apellido" id="apellido" class="form-control" required="" placeholder="Apellido">
         </div>
         <div class="col-sm-4">
            <label>Cargo:</label>
            <input type="text" name="cargo" id="cargo" class="form-control" required="" placeholder="Cargo">
         </div>
         <div class="col-sm-6" id="datosp">
            <label>¿Usar los mismo datos de contacto que la ficha de empresa?</label><br>	
            <span><input type="radio" id="p"  name="p"   onclick="sidatos();"/> No</span>
            <span><input type="radio" id="p"  name="p" checked  onclick="nodatos();"/> Si</span>  
         </div>
         <div class="ocultar" id="datos">
            <div class="col-sm-4">
               <label>Correo</label>
               <input type="mail" name="correo" id="correo" class="form-control"    placeholder="Correo">
            </div> 
            <div class="col-sm-4">
               <label>Teléfono</label>
               <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Telefono">
            </div>
         </div>
         <div class="col-sm-12" style="margin-top:15px;">
            <div id="resultado1"></div>
            <button onclick="realizaProceso();return false; " type="button" name="enviar" id="enviar" class="btn-primary btn-block btn">
            Crear <i class="fas fa-check"></i>
            </button>	
         </div>
      </div>
   </form>
</div>


<script type="text/javascript"> 
  function realizaProceso() {
         
             var msj = '1'; 
         //validaciones con js
         
         if (msj === "1") { //tres igual para decir que es identico
         var formData = new FormData(jQuery('#newcliente') [0]); //Se crea el arreglo con los datos del form
         $.ajax({
           url: '{{url('clientes')}}', // Al controlador donde van mis datos 
           type: 'POST', 
           contentType: false,
           processData: false, //Le dice que tipo de dato va a recibir
           dataType: 'json',
           data: formData,  
           beforeSend: function() {
             $("#resultado").html('<div class="alert alert-success">Procesando...!</div>');
           }
         })
         .done(function(data, textStatus, jqXHR) {
           var getData = jqXHR.responseJSON; // vguarda los errores si los hay en la ejecucion del js
         
           if(data.status=='ok'){ //ver controlador, status es el nombre la clave cuando se creo
            $("#resultado").html('<div class="alert alert-success">'+data.mensaje+'</div>'); //
             document.getElementById("nuevo_cliente").className -= " ocultar";
             document.getElementById("nuevo_usuario").className += " ocultar";
             document.getElementById("newcliente").reset();
           }else{
           $("#resultado").html('<div class="alert alert-danger"><strong>ERROR!</strong>'+data.error+'</div>');
           }
         })
               .fail(function(jqXHR, textStatus, errorThrown) { //Si ocurre errores el jquery
                 var getErr = jqXHR.responseText;
                 console.log(getErr);
                 $("#resultado1").html('<div class="alert alert-danger"><strong>ERROR!</strong>'+getErr+'</div>');
         
               })
          // Fin de ajax
          } else {
              swal("¡Error! ", msj, "error");
          }
           };

   function cliente(){  
   document.getElementById("nuevo_cliente").className += " ocultar";
   document.getElementById("nuevo_usuario").className -= " ocultar";
   $("#resultado").html('<div></div>');
   $("#resultado1").html('<div></div>');
   }
   function mostrar(){  
   document.getElementById("nuevo_cliente").className -= " ocultar";
   document.getElementById("nuevo_usuario").className += " ocultar";
   }
   
   function sidatos(){  
   document.getElementById("datos").className -= " ocultar";
   }
   function nodatos(){  
   document.getElementById("datos").className += " ocultar";
   }
</script>
<style type="text/css">
   .ocultar{
   display: none;
   }
   span{
   margin-right:15px; margin-left:15px;
   }
   .col-sm-6,.col-sm-12,.col-sm-4{
   margin-top:15px;
   }
</style>
@endsection




