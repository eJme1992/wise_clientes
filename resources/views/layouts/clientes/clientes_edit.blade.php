@extends('layouts.app')
@section('title', 'Editar cliente')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


@section('content')
<div class="container-fluid cm-container-white">
   <h2 style="margin-top:0;">Editar cliente</h2>
   <form id="editcliente" class="row"  method="POST">
      @csrf
      @method('PUT')
      <div class="col-md-4">
          <img src="{{url('/img/programa/'.$Cliente->logo)}}" alt="" class="img-responsive">
          <div class="col-sm-12">
            <label>Logo:</label>
            <input type="file" name="logo" id="logo" class="form-control">
         </div>
      </div>   
      <div class="col-md-8" id="nuevo_cliente">
        <div class="col-sm-6">
            <label>Nombre:</label>
            <input type="text" name="nombre" id="nombre" class="form-control" required="" placeholder="Cliente" value="{{$Cliente->nombre}}">
         </div>
         <div class="col-sm-6">
            <label>Tipo:</label>
            <select name="tipo" id="tipo" class="form-control" required="">

               <option @if($Cliente->tipo=='Persona Natural') selected @endif>
               Persona Natural
               </option>
               <option @if($Cliente->tipo=='Persona Jurídica') selected @endif>
               Persona Jurídica
               </option>
            </select>
         </div>
         <div class="col-sm-12">
            <label>Descripción:</label>
            <textarea name=descripcion" id="descripcion" class="form-control" required="">{{$Cliente->descripcion}}</textarea>
         </div>
        
         <div class="col-sm-4">
            <label>Correo Principal:</label>
            <input type="mail" name="correo" id="correoc" class="form-control" required="" placeholder="Correo Principal" value="{{$Cliente->correo}}">
         </div>
         <div class="col-sm-4">
            <label>Teléfono principal:</label>
            <input type="number" name="telefono" id="telefonoc" class="form-control" required="" placeholder="Telefono principal" value="{{$Cliente->telefono}}">
         </div>
         <div class="col-sm-12" style="margin-top:15px;">
            <div class="resultado"></div>
            <button type="submit"  name="enviar" id="enviar" class="btn-primary btn-block btn">
            Editar <i class="fas fa-pencil-alt"></i>
            </button>	
         </div>
      </div>
   </form>
</div>
<script >
         $(document).ready(function() {
               $("#editcliente").submit(function(event) {
               event.preventDefault();
         
             var msj = '1';
         //validaciones con js
         
        if (msj === "1") {
         var formData = new FormData($('#editcliente') [0]);
         $.ajax({
           url: '{{url('clientes/'.$Cliente->slug)}}',
           type: 'POST',
           contentType: false,
           processData: false,
           dataType: 'json',
           data: formData,
           beforeSend: function() {
             $("#resultado").html('<div class="alert alert-success">Procesando...!</div>');
           }
         })
         .done(function(data, textStatus, jqXHR) {
            var getData = jqXHR.responseJSON; // dejar esta linea
           if(data.status=='ok'){ //ver controlador, status es el nombre la clave cuando se creo
            $("#resultado").html('<div class="alert alert-success">'+data.mensaje+'</div>'); //
            window.location.href ='{{url('clientes/'.$Cliente->slug.'/edit')}}';
           }else{
           $("#resultado").html('<div class="alert alert-danger"><strong>ERROR!</strong>'+data.error+'</div>');
           }
         })
               .fail(function(jqXHR, textStatus, errorThrown) {
                 var getErr = jqXHR.responseText;
                 console.log(getErr);
                 $("#resultado").html('<div class="alert alert-danger"><strong>ERROR!</strong>'+getErr+'</div>');
         
               })
          // Fin de ajax
          } else {
              swal("¡Error! ", msj, "error");
          }
          });
         
         });//fin ready
      </script>
@endsection




