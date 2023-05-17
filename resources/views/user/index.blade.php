@extends('layouts.app')

@section('content')

    <div class="col s12 ">
        <div class="card myCard" >
            <div class="row s12 valign-wrapper">
                <div class="col s12 l10">
                    <h5 class="indexTitle" >Clientes</h5>
                </div>
                <div class="col s12 right-align l2">
                    <a href="{{ route('admin.usuario.create') }}" role="button" class="btn btn-#01579b light-blue darken-4 " id="buttonIdText" >Añadir</a>
                </div>
            </div>

            <table id="items_users" class="table table-bordered display" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>NIT/CI</th>
                        <th>Telefono</th>
                        <th>Sexo</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($usuarios as $key => $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->ci }}</td>
                        <td>{{ $user->phone }}</td>
                        <td>{{ $user->genre }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> 
@endsection
