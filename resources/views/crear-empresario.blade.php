@extends("master")
@section("title") Crear nuevo empresario @endsection
@section("content")

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 text-right">
            <a href="{{route('empresarios.index')}}" class="btn btn-danger"> Regresar a la lista </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
                <form action="{{route('empresarios.store')}}" method="POST">
                @csrf
                <div class="card shadow">
                    @if(Session::has('success'))
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">× </button>
                            {{Session::get('success')}}
                        </div>
                    @elseif(Session::has('failed'))
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert">× </button>
                            {{Session::get('failed')}}
                        </div>
                    @endif

                    <div class="card-header">
                        <h4 class="card-title"> Crear Nuevo Empresario</h4>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="nombre"> Nombre </label>
                            <input type="text" name="nombre" class="form-control" id="nombre" value="{{old('nombre')}}">
                            {!!$errors->first("nombre", "<span class='text-danger'>:message </span>")!!}
                        </div>

                        <div class="form-group">
                            <label for="razon_social"> Razon Social </label>
                            <textarea class="form-control" name="razon_social" id="razon_social">{{old('razon_social')}}</textarea>
                            {!!$errors->first("razon_social", "<span class='text-danger'>:message </span>") !!}
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"> Guardar </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
