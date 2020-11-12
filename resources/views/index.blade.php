@extends("master")

@section("title") Empresarios @endsection
@section("content")

<div class="row mb-4">
    {{-- <div class="col-xl-6">
        @if(Session::has('success'))
            <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">× </button>
                {{Session::get('success')}}
            </div>
        @else
            <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert">× </button>
                {{Session::get('failed')}}
            </div>
        @endif
    </div> --}}

    <div class="col-xl-6 text-right">
        <a href="{{route('empresarios.create')}}" class="btn btn-success "> Agregar mas </a>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <th> Id </th>
        <th> Nombre </th>
        <th> Email </th>
        <th> Action </th>
    </thead>

    <tbody>

        @if(count($empresarios) > 0)
            @foreach($empresarios as $empresario)
                <tr>
                    <td> {{$empresario->id}} </td>
                    <td> {{$empresario->nombre}} </td>
                    <td> {{$empresario->email}} </td>
                    <td>
                        <form action="{{route('empresarios.destroy', $empresario->id)}}" method="POST">
                            @csrf
                            @method('DELETE')

                            <a href="{{route('empresarios.show', $empresario->id)}}" class="btn btn-sm btn-info"> Ver </a>
                            <a href="{{route('empresarios.edit', $empresario->id)}}" class="btn btn-sm btn-success"> Editar </a>

                            <button type="submit" class="btn btn-sm btn-danger"> Borrar </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
    </tbody>
</table>

{!! $empresarios->links() !!}
@endsection
