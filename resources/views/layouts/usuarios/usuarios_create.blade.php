@extends('layouts.app')
@section('title', 'Nuevo cliente')



@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;display:inline;"><i class="fas fa-plus-circle"></i> Nuevo Usuario </h2>
   <a href="{{url('clientes/'.$id)}}"><button class="btn-xs btn btn-primary" type="button"><i class="fas fa-chevron-left"></i> Atrás</button></a> 

 @if ($errors->any())
    @foreach($errors->all() as $key)
         <p>{{$key}}</p>
    @endforeach

 @endif



   <form id="newuser" onsubmit="realizaProceso();return false; " >
      @csrf

      <div class="formularios " id="nuevo_usuario">
       
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
        
         
            <div class="col-sm-4">
               <label>Correo</label>
               <input type="mail" name="correo" id="correo" class="form-control"    placeholder="Correo">
            </div> 
            <div class="col-sm-4">
               <label>Teléfono</label>
               <input type="number" name="telefono" id="telefono" class="form-control" placeholder="Telefono">
            </div>
            <div class="col-sm-12">
               <label>Tipo</label>
               <select class="form-control" id="tipo" name="tipo" required="">
                 <option value="principal">Principal</option>
                 <option value="secunadario">Sencundario</option>
               </select>
            </div>

            <input type="hidden" name="id_cliente" id="id_cliente" value="{{$id}}">
         
         <div class="col-sm-12" style="margin-top:15px;">
            <div id="resultado"></div>
            <button type="submit" name="enviar" id="enviar" class="btn-primary btn-block btn">
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
         var formData = new FormData(jQuery('#newuser') [0]); //Se crea el arreglo con los datos del form
         $.ajax({
           url: '{{url('usuarios')}}', // Al controlador donde van mis datos 
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
            $("#resultado").html('<div class="alert alert-success">'+data.mensaje+'</div>'); 
             document.getElementById("newuser").reset();
           }else{
           $("#resultado").html('<div class="alert alert-danger"><strong>ERROR!</strong>'+data.error+'</div>');
           }
         })
               .fail(function(jqXHR, textStatus, errorThrown) { //Si ocurre errores el jquery
                 var getErr = jqXHR.responseText;
                 console.log(getErr);
                 $("#resultado").html('<div class="alert alert-danger"><strong>ERROR!</strong>'+getErr+'</div>');
         
               })
          // Fin de ajax
          } else {
              swal("¡Error! ", msj, "error");
          }
           };
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




