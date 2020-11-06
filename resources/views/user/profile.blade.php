@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Perfil</div>

                <div class="card-body">
                    
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
                        </div>
                        <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                            
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                    <b>Nombre completo:</b>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    {{$user->admin->nombre_completo}}
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3 text-right">
                                    <b>Email:</b>
                                </div>
                                <div class="col-xs-8 col-sm-8 col-md-8 col-lg-8">
                                    {{$user->email}}
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-right">
                            <a href="{{route('modificar', $id)}}" class="btn btn-warning">
                                Modificar
                            </a>
                        </div>
                    </div>
                    
                    
                        
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection