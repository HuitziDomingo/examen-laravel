@extends("master")
@section("title") Actualizar Empresario @endsection
@section("content")

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 text-right">
            <a href="{{route('empresarios.index')}}" class="btn btn-danger"> Regresar </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
            <form action="{{route('empresarios.update', $empresarios->id)}}" method="POST">
                @csrf
                @method('PUT')
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
                        <h4 class="card-title"> Actualizar Empresario </h4>
                    </div>

                    <div class="card-body">
                        <div class="form-group">
                            <label for="title"> Title </label>
                            <input type="text" name="nombre" class="form-control" id="title" value="@if(!empty($empresario)) {{$empresario->nombre}} @endif">
                            {!!$errors->first("title", "<span class='text-danger'>:message </span>")!!}
                        </div>

                        <div class="form-group">
                            <label for="razon_social"> Description </label>
                            <textarea class="form-control" name="razon_social" id="razon_social">@if(!empty($empresario)){{$empresario->razon_social}}@endif</textarea>
                            {!!$errors->first("razon_social", "<span class='text-danger'>:message </span>") !!}
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-success"> Actualizar </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
