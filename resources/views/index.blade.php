<x-app-layout>
    <style>
        header{ margin-bottom: 35px;}
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div id='showdiv' class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-sm-6">
                <div class="">
                    <div class="">
                        <h1>Bienvenido a la página principal</h1>
                        <table id='mostrar' class="table-fixed">
                        <thead>
                            <tr>
                            <th class="">Nombe</th>
                            <th class="">Email</th>
                            <th class="">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($empresarios as $emp)
                                <tr id="__{{$emp->id}}">
                                <td class="border px-4 py-2">
                                    {{$emp->id}}) {{$emp->nombre}}
                                </td>
                                <td class="border px-4 py-2">{{$emp->email}}</td>
                                <td class="border px-4 py-2">
                                    <button class="btn-show" data-id='{{$emp->id}}' >Ver</button> -
                                    <button class="btnUpdate" data-id='{{$emp->id}}'>Editar</button> -
                                    @if ($emp->activo == 1)
                                        <button  class="btnToogle" data-id='{{$emp->id}}'>Inactivar</button> -
                                    @else
                                        <button  class="btnToogle" data-id='{{$emp->id}}'>Activar</button> -
                                    @endif
                                    <button class="btnDelete" data-id='{{$emp->id}}'>Eliminar</button>
                                </td>
                                </tr>
                            @endforeach
                        </tbody>
                        </table>
                    </div>
                </div>
        </div>


        <div class="col-sm-6">
            <div class="">
                <div class="">
                    <form class="" method="post" action="create" id="agregar">
                        @csrf
                        <h1>Insertar datos de empleado</h1>
                        <div class="form-group">
                            <label class="" for="codigo">
                                Código
                            </label>
                            <input class="form-control" id="codigo" type="text" placeholder="#2020" name="codigo">
                        </div>
                        <div class="form-group">
                            <label for="razon_social">Razon Social</label>
                            <textarea class="form-control" name="razon_social" id="razon_social" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label class="" for="nombre">
                                Nombre
                            </label>
                            <input class="form-control" id="nombre" type="text" placeholder="Juan Nieves" name="nombre">
                        </div>
                        <div class="form-group">
                            <label class="" for="pais">
                                Pais
                            </label>
                            <input class="form-control" id="pais" type="text" placeholder="Colombia" name="pais">
                        </div>
                        <div class="form-group">
                            <label class="" for="tipo_moneda">
                                Tipo de moneda
                            </label>
                            <input class="form-control" id="tipo_moneda" type="text" placeholder="MXN" name="tipo_moneda">
                        </div>
                        <div class="form-group">
                            <label class="" for="estado">
                                Estado
                            </label>
                            <input class="form-control" id="estado" type="text" placeholder="Medellin" name="estado">
                        </div>
                        <div class="form-group">
                            <label class="" for="ciudad">
                                Ciudad
                            </label>
                            <input class="form-control" id="ciudad" type="text" placeholder="Medellin" name="ciudad">
                        </div>
                        <div class="form-group">
                            <label class="" for="telefono">
                                Telefono
                            </label>
                            <input class="form-control" id="telefono" type="text" placeholder="456765434567865" name="telefono">
                        </div>
                        <div class="form-group">
                            <label class="" for="email">
                                Email
                            </label>
                            <input class="form-control" id="email" type="text" placeholder="maria@admin.net" name="email">
                        </div>
                        <button type="submit" class="btn btn-primary" id="btncrear">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
        </div>
    </div>


</x-app-layout>
