@extends('layouts.app')

@section('content')

@if($errors->any())
    <div class="msg msg-error"> {{$errors->first()}} </div>
@endif

<div class="row s12">
    <div class="col s12 m10 offset-m1 l10 offset-l1">
        <div class="card myCreateCard">

            <h4 class="center-align createTitle ">Registrar Producto</h4><br>
            <form class="form-group" action="{{ route('admin.product.store') }}" method="POST">
                {{ csrf_field() }}

                <input class='filled-in hidden' type="checkbox" name="tipo" id="tipo" value="C" checked="checked" />

                <div class="row s12">
                    <div class="col s12 m8 l8">
                        <div class="form-group">
                            <label for="name">Nombre: <sup>*</sup></label>
                            <input type="text" name="name" required="" oninvalid="setCustomValidity('Debe colocar un nombre')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col s12 m8 l4">
                        <label for="price">Precio($us):</label>
                        <input class="center-align td-text" type="number" id="price" placeholder="Ejm: 100" name="price"  required="">
                   </div>
                </div>

               
                <div class="row s12">
                    <div class="col s12 l6">
                        <button class="btn waves-effect waves-light  #01579b light-blue darken-4 buttonText" type="submit" name="action">Guardar
                            <i class="material-icons right">send</i>
                        </button>
                        <a href="{{ route('admin.product.index') }}" class="btn btn-#1e88e5 blue darken-1 buttonText">Atras <i class="material-icons right ">arrow_back</i></a>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
</div>

@endsection

