@extends('layouts.app')

@section('title', 'Nuevo cliente') 

@section('content')

<div class="container-fluid cm-container-white">
    <h2 style="margin-top:0; margin-bottom:35px">Clientes</h2>
    <table id="grid" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Fecha de registro</th>
                <th>#</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Fecha de registro</th>
                <th>#</th>
            </tr>
        </tfoot>
        <tbody>
            @foreach($Clientes as $key)
            <tr>
                <td>
                    {{$key->id}}
                </td>
                <td>
                    {{$key->nombre}}
                </td>
                <td>
                    {{$key->tipo}}
                </td>
                <td>
                    {{$key->nombre}}
                </td>
                <td>
                    <a href="{{url('clientes/'.$key->slug)}}"><button class="btn  btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></button></a>
                    <a href="{{url('clientes/'.$key->slug.'/edit')}}"><button class="btn btn-primary btn-xs"><i class="fas fa-pencil-alt"></i></button></a>
                    <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal" data-target="#delete<?=$key->id;?>"><i class="fas fa-trash-alt"></i></button>
                   
                </td>
                <!-- MODALES PARA ACCIONES EN CLIENTES-->
                <!-- Modal Editar-->
                <div id="edit{{$key->id}}" class="modal fade " role="dialog">
                    <div class="modal-dialog" style="margin-top:10vw;">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Editar categoría</h4>
                            </div>
                            <div class="modal-body">
                                <form id="editar{{$key->id}}" onsubmit="realizaProceso(
                                $('#id{{$key->id}}').val() 
                                );return false; ">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label>Nombre de la categoría</label>
                                            <input type="text" name="nombre" id="nombre" value="<?=$key->nombre;?>" required="" class="form-control" placeholder="Ej: Anime">
                                            <input type="hidden" name="id" id="id" value="{{$key->id}}">

                                            <input type="hidden" name="id{{$key->id}}" id="id{{$key->id}}" value="{{$key->id}}">
                                        </div>
                                        <div class="col-md-12" id="resultado2{{$key->id}}" style="margin-top:15px;"></div>
                                        <div class="col-sm-12" style="margin-top:20px;">
                                        <button class="btn btn-lg btn-block btn-primary" type="submit">
                                         Editar
                                        </button>
                                        </div>
                                    </div>
                                </form>
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
                                <form method="POST" action="{{url('clientes/'.$key->slug)}}" >
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
               <!-- FIN DE MODALES PARA ACCIONES DE CLIENTES -->
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection