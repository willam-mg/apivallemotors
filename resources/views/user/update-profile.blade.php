@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfil</div>

                <div class="card-body">
                    <form method="POST" action="{{route('update', $id)}}" enctype='multipart/form-data'>
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                @if ($user->admin)
                                    @if ($user->admin->foto)
                                        <img src="/uploads/{{$user->admin->foto}}" alt="foto" width="100%">
                                    @else
                                        <img src="/img/no-image-user.png" alt="foto" width="100%">
                                    @endif
                                @else
                                    <img src="/img/no-image-user.png" alt="foto" width="100%">
                                @endif
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="foto">Foto</label>
                                            <input type="file" accept="image/*" name="foto">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="nombre_completo">Nombre completo</label>
                                            <input type="text" class="form-control" value="{{$user->admin->nombre_completo}}" name="nombre_completo">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input type="email" class="form-control" value="{{$user->email}}" name="email">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                                <a href="{{route('profile')}}" class="btn btn-default">
                                    Cerrar
                                </a>
                                <button type="submit" class="btn btn-warning">
                                    Modificar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection