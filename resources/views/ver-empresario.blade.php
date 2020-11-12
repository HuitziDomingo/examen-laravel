@extends("master")
@section("title") Mostrar Empresario @endsection
@section("content")

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 text-right">
            <a href="{{route('articles.index')}}" class="btn btn-danger"> Back to Articles </a>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12 m-auto">
            <div class="card shadow">
                <div class="card-header">
                    <h4 class="card-title"> Mostar Empresario </h4>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="title"> Nombre </label>
                        <input type="text" readonly name="nombre" class="form-control" id="title" value="@if(!empty($empresario)) {{$empresario->nombre}} @endif">
                    </div>

                    <div class="form-group">
                        <label for="email"> Description </label>
                        <textarea class="form-control" readonly name="email" id="email">@if(!empty($empresario)) {{$empresario->email}} @endif</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
