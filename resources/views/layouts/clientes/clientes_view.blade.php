@extends('layouts.app')
@section('title', 'Nuevo cliente')
@section('content')
<!-- MODAL ELIMINAR -->
<div id="delete{{$Cliente->id}}" class="modal fade " role="dialog">
   <div class="modal-dialog" style="margin-top:10vw;">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-body text-center">
            <h3> ¿Esta Seguro que desea eliminar a: <b><?=$Cliente->nombre;?></b>?</h3>
         </div>
         <div class="modal-footer">
            <form method="POST" action="{{url('clientes/'.$Cliente->slug)}}" >
               @csrf
               @method('DELETE')
               <button type="submit" class="btn btn-danger">Si</button>
               <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            </form>
         </div>
      </div>
   </div>
</div>
<!-- FIN MODAL ELIMINAR -->
<div class="container-fluid">
   <div class="row profile">
      <div class="col-md-3">
         <div class="profile-sidebar panel panel-default">
            <!-- SIDEBAR USERPIC -->
            <div class="profile-userpic panel-body">
               <img src="{{url('/img/programa/'.$Cliente->logo)}}" alt="">
            </div>
            <!-- END SIDEBAR USERPIC -->
            <!-- SIDEBAR USER TITLE -->
            <div class="profile-usertitle">
               <div class="profile-usertitle-name">
                  {{$Cliente->nombre}}
               </div>
            </div>
            <!-- END SIDEBAR USER TITLE -->
            <!-- SIDEBAR BUTTONS -->
            <div class="profile-userbuttons">
               <a href="{{url('clientes/'.$Cliente->slug.'/edit')}}">
               <button type="button" class="btn btn-success btn-sm btn-block"><i class="fas fa-pencil-alt"></i> Editar</button></a>
               <button type="button" class="btn btn-danger btn-sm btn-block" ata-title="Delete" data-toggle="modal" data-target="#delete<?=$Cliente->id;?>"><i class="fas fa-trash-alt"></i> Eliminar</button>
            </div>
            <!-- END SIDEBAR BUTTONS -->
            <!-- SIDEBAR MENU -->
            <div class="profile-usermenu">
               <ul class="nav">
                  <li class="active">
                     <a data-toggle="tab" href="#home">
                     <i class="glyphicon glyphicon-home"></i>
                     Perfil
                     </a>
                  </li>
                    <li>
                     <a data-toggle="tab" href="#t2">
                     <i class="fab fa-edge"></i>
                     Sitios web </a>
                  </li>
                    <li>
                     <a data-toggle="tab" href="#t3">
                     <i class="fas fa-server"></i>
                     Hosting </a>
                  </li>
                    <li>
                     <a data-toggle="tab" href="#t4">
                     <i class="fas fa-database"></i>
                     Bases de datos </a>
                  </li>
                    <li>
                     <a data-toggle="tab" href="#t5">
                     <i class="fa fa-envelope"></i>
                     Web Mail </a>
                  </li>
                 <li>
                     <a data-toggle="tab" href="#t6">
                     <i class="fab fa-facebook-f"></i>
                     Redes sociales </a>
                  </li>
                  <li>
                     <a data-toggle="tab" href="#t1">
                     <i class="glyphicon glyphicon-user"></i>
                     Usuarios </a>
                  </li>
               </ul>
            </div>
            <!-- END MENU -->
         </div>
      </div>
      <div class="col-md-9">
         <div class="panel panel-default tab-content">
            <div id="home" class="profile-content tab-pane fade in active" >
               @include('layouts.clientes.sub.ficha_cliente')
            </div>
            <div id="t1" class="profile-content tab-pane fade" >
               @include('layouts.clientes.sub.usuarios')
            </div>
              <div id="t2" class="profile-content tab-pane fade" >
               @include('layouts.clientes.sub.web')
            </div>
              <div id="t3" class="profile-content tab-pane fade" >
               @include('layouts.clientes.sub.hosts')
            </div>
              <div id="t4" class="profile-content tab-pane fade" >
               @include('layouts.clientes.sub.dbs')
            </div>
              <div id="t5" class="profile-content tab-pane fade" >
               @include('layouts.clientes.sub.mails')
            </div>
              <div id="t6" class="profile-content tab-pane fade" >
               @include('layouts.clientes.sub.redes')
            </div>
         <!-- REDES SOCIALES -->
         





         </div>
      </div>
   </div>
</div>
 <link rel="stylesheet" type="text/css" href="{{asset('css/perfil_cliente.css')}}">
@endsection
