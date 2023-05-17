@extends('layouts.app')

@section('content')

    <div class="col s12 ">
        <div class="card myCard" >
            <div class="row s12 valign-wrapper">
                <div class="col s12 l10">
                    <h5 class="indexTitle" >Ventas</h5>
                </div>
                <div class="col s12 right-align l2">
                    <a href="{{ route('admin.sell.create') }}" role="button" class="btn btn-#01579b light-blue darken-4 " id="buttonIdText" >Añadir</a>
                </div>
            </div>

            <table id="items_sells" class="table table-bordered display" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Fecha</th>
                        <th>Descripcion</th>
                        <th>Total($us)</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sells as $key => $sell)
                    <tr>
                        <td>{{ $sell->id }}</td>
                        <td>{{ $sell->date }}</td>
                        <td>{{ $sell->observation }}</td>
                        <td>{{ $sell->total }}</td>
                        <td>
                            <a class="btn-floating btn-small waves-effect waves-light #1e88e5 blue darken-1 tooltipped" data-position="top" data-tooltip="Ver más" href="{{route('admin.sell.show', [$sell->id])}}"><i class="tiny material-icons">navigate_next</i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> 
@endsection
