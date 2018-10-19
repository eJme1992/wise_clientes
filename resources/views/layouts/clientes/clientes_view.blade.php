@extends('layouts.app')
@section('title', 'Nuevo cliente')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
@section('content')
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
               <h3><b>{{$Cliente->nombre}}</b><span style="font-size:14px;"> - {{$Cliente->tipo}}</span></h3>
               <div class="row">
                  <div class="col-md-6">
                     <label>
                     <i class="fa fa-envelope"></i> Correo principal:
                     </label> 
                     {{$Cliente->correo}}
                  </div>
                  <div class="col-md-6">
                     <i class="fa fa-mobile-phone"></i>
                     <label>Teléfono principal:</label> {{$Cliente->telefono}}
                  </div>
                  <div class="col-md-12">
                     <label>Descripción:</label> {{$Cliente->descripcion}}
                  </div>
               </div>
               <hr>
               <h4>Contacto principal</h4>
               <div class="row">
                  <div class="col-md-6">
                     <i class="fa fa-user"></i> <label>Nombre y apellido:</label> {{$user->nombre}} {{$user->apellido}}
                  </div>
                  <div class="col-md-6">
                     <i class="fa fa-desktop"></i> <label>Cargo:</label> {{$user->cargo}}
                  </div>
                  <div class="col-md-6">
                     <i class="fa fa-envelope"></i> <label>Correo:</label> {{$user->correo}} 
                  </div>
                  <div class="col-md-6">
                     <i class="fa fa-mobile-phone"></i> <label>Teléfono:</label> {{$user->telefono}} 
                  </div>
               </div>
            </div>
            <div id="t1" class="profile-content tab-pane fade" >
               <h2 style="margin-top:0; margin-bottom:35px; display:inline;">Lista usuarios</h2> 
                <a href="{{url('usuarios/create')}}"><button class="btn btn-primary btn-xs">Nuevo Usuarios</button></a>
               <table id="grid" class="table table-striped table-bordered" cellspacing="0" width="100%">
                  <thead>
                     <tr>
                        <th>ID</th>
                        <th>Nombre y Apellido</th>
                        <th>Cargo</th>
                        <th>Tipo</th>
                        <th>#</th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($usuarios as $key)
                     <tr>
                        <td>
                           {{$key->id}}
                        </td>
                        <td>
                           {{$key->nombre}}   {{$key->apellido}}
                        </td>
                        <td>
                           {{$key->cargo}}
                        </td>
                        <td>
                           {{$key->tipo}}
                        </td>
                        <td>
                           <a href="{{url('usuarios/'.$key->id)}}"><button class="btn  btn-xs"><i class="fa-paint-brush  fa"></i></button></a>
                           <button class="btn btn-xs" data-title="Delete" data-toggle="modal" data-target="#view<?=$key->id;?>"><i class="fa fa-eye" aria-hidden="true"></i></button>
                           <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                        </td>
                        <!-- MODALES PARA ACCIONES EN usuarios-->
                        <!-- Modal Editar-->
                        <div id="view{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <div class="modal-content">
                                 <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">FICHA DE USUARIO</h4>
                                 </div>
                                 <div class="modal-body">
                                 </div>
                                 <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">cerrar</button>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- MODAL ELIMINAR -->
                        <div id="delete{{$key->id}}" class="modal fade " role="dialog">
                           <div class="modal-dialog" style="margin-top:10vw;">
                              <!-- Modal content-->
                              <div class="modal-content">
                                 <div class="modal-body text-center">
                                    <h3> ¿Esta Seguro que desea eliminar la categoría: <b><?=$key->nombre;?></b>?</h3>
                                 </div>
                                 <div class="modal-footer">
                                    <form method="POST" action="{{url('usuarios/'.$key->slug)}}" >
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
                        <!-- FIN DE MODALES PARA ACCIONES DE usuarios -->
                     </tr>
                     @endforeach
                  </tbody>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>
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
<style type="text/css">
   /***
   User Profile Sidebar by @keenthemes
   A component of Metronic Theme - #1 Selling Bootstrap 3 Admin Theme in Themeforest: http://j.mp/metronictheme
   Licensed under MIT
   ***/
   body {
   background: #F1F3FA;
   }
   /* Profile container */
   .profile {
   margin: 20px 0;
   }
   /* Profile sidebar */
   .profile-sidebar {
   padding: 20px 0 10px 0;
   background: #fff;
   }
   .profile-userpic img {
   float: none;
   margin: 0 auto;
   width: 100%;
   }
   .profile-usertitle {
   text-align: center;
   margin-top: 20px;
   }
   .profile-usertitle-name {
   color: #5a7391;
   font-size: 16px;
   font-weight: 600;
   margin-bottom: 7px;
   }
   .profile-usertitle-job {
   text-transform: uppercase;
   color: #5b9bd1;
   font-size: 12px;
   font-weight: 600;
   margin-bottom: 15px;
   }
   .profile-userbuttons {
   text-align: center;
   margin-top: 10px;
   }
   .profile-userbuttons .btn {
   text-transform: uppercase;
   font-size: 11px;
   font-weight: 600;
   padding: 6px 15px;
   margin-right: 5px;
   }
   .profile-userbuttons .btn:last-child {
   margin-right: 0px;
   }
   .profile-usermenu {
   margin-top: 30px;
   }
   .profile-usermenu ul li {
   border-bottom: 1px solid #f0f4f7;
   }
   .profile-usermenu ul li:last-child {
   border-bottom: none;
   }
   .profile-usermenu ul li a {
   color: #93a3b5;
   font-size: 14px;
   font-weight: 400;
   }
   .profile-usermenu ul li a i {
   margin-right: 8px;
   font-size: 14px;
   }
   .profile-usermenu ul li a:hover {
   background-color: #fafcfd;
   color: #5b9bd1;
   }
   .profile-usermenu ul li.active {
   border-bottom: none;
   }
   .profile-usermenu ul li.active a {
   color: #5b9bd1;
   background-color: #f6f9fb;
   border-left: 2px solid #5b9bd1;
   margin-left: -2px;
   }
   /* Profile Content */
   .profile-content {
   padding: 20px;
   background: #fff;
   min-height: 460px;
   }
   label {
   color:#2582C1;
   }
   .fa {
   color: #e74c3c;
   }
</style>
@endsection
