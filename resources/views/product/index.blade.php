@extends('layouts.app')

@section('content')

    <div class="col s12 ">
        <div class="card myCard" >
            <div class="row s12 valign-wrapper">
                <div class="col s12 l10">
                    <h5 class="indexTitle" >Productos</h5>
                </div>
                <div class="col s12 right-align l2">
                    <a href="{{ route('admin.product.create') }}" role="button" class="btn btn-#01579b light-blue darken-4 " id="buttonIdText" >Añadir</a>
                </div>
            </div>

            <table id="items_products" class="table table-bordered display" width="100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $key => $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->price }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div> 
@endsection