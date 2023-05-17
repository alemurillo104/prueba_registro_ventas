@extends('layouts.app')

@section('content')

    <div class="col s12 ">
        <div class="card myCard" >
            <div class="row s12 valign-wrapper">
                <div class="col s12 l10">
                    <h5 class="indexTitle" >Venta # {{ $details[0]->id_sell }}</h5>
                </div>
                <div class="col s12 right-align l2">
                </div>
            </div>

            <table id="items_sells" class="table table-bordered display" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Descripcion</th>
                        <th>Precio Unitario</th>
                        <th>Cantidad</th>
                        <th>Subtotal</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($details as $key => $detail)
                    <tr>
                        <td>{{ $detail->id }}</td>
                        <td>{{ $detail->product_name }}</td>
                        <td>{{ $detail->unit_price }}</td>
                        <td>{{ $detail->amount }}</td>
                        <td>{{ $detail->subtotal }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> 
@endsection
