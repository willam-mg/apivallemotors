@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Usuarios</div>

                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Foto</th>
                                    <th>Nombre completo</th>
                                    <th>Email</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($usuarios as $user)
                                    <tr>
                                        <td>
                                            @if ($user->admin->foto)
                                                <img src="{{'uploads/'.$user->admin->foto}}" alt="foto" width="40px" style="border-radius:50%" height="40px">
                                            @else
                                                <img src="img/no-image-user.png" alt="foto" width="40px" style="border-radius:50%" height="40px">
                                            @endif
                                        </td>
                                        <td>{{$user->admin->nombre_completo}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>
                                            <a href="{{ route('profile', ['id' => $user->id]) }}" class="btn btn-info" title="Ver usuario">
                                                <span class="fa fa-search"></span>
                                                Ver
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $usuarios->links() }}

                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection