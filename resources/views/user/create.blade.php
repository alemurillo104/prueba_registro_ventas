@extends('layouts.app')

@section('content')

@if($errors->any())
    <div class="msg msg-error"> {{$errors->first()}} </div>
@endif

<div class="row s12">
    <div class="col s12 m10 offset-m1 l10 offset-l1">
        <div class="card myCreateCard">

            <h4 class="center-align createTitle ">Registrar Cliente</h4><br>
            <form class="form-group" action="{{ route('admin.usuario.store') }}" method="POST">
                {{ csrf_field() }}

                <input class='filled-in hidden' type="checkbox" name="tipo" id="tipo" value="C" checked="checked" />

                <div class="row s12">
                    <div class="col s12 m4 l6 offset-l3">
                        <div class="form-group">
                            <label for="ci">CI: <sup>*</sup></label>
                            <input type="text" name="ci" required="" oninvalid="setCustomValidity('Debe colocar un CI')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                    <div class="col s12 m8 l6 offset-l3">
                        <div class="form-group">
                            <label for="name">Nombre: <sup>*</sup></label>
                            <input type="text" name="name" required="" oninvalid="setCustomValidity('Debe colocar un nombre')" oninput="setCustomValidity('')">
                        </div>
                    </div>
                </div>

                <div class="row s12">
                    <div class="col s12 m6 l6 offset-l3">
                        <div class="input-field">
                            <i class="material-icons prefix">phone</i>
                            <label for="phone">Telefono</label>
                            <input id="phone" type="tel" class="validate" name="phone" placeholder="Ejm: 71340091" pattern="[1-9]{1}[0-9]{7}" required="" oninvalid="setCustomValidity('Debe escribir un numero de telefono')" oninput="setCustomValidity('')"><br><br>
                        </div>
                    </div>
                    <div class="col s12 m12 l6 offset-l3">
                        <label for="genre">Género<sup>*</sup></label>
                        <select name="genre" id="genre"  required="" oninvalid="setCustomValidity('Seleccione el género')" oninput="setCustomValidity('')"
                            class="form-control browser-default" type="number">
                            <option class="truncate"  value="" disabled selected>Seleccione un género</option>
                            <option  id="0" value="F" >Femenino</option>
                            <option  id="1" value="M" >Masculino</option>
                        </select>
                    </div>

                </div>
               
                <div class="row s12">
                    <div class="col s12 l6 offset-l3">
                        <button class="btn waves-effect waves-light  #01579b light-blue darken-4 buttonText" type="submit" name="action">Guardar
                            <i class="material-icons right">send</i>
                        </button>
                        <a href="{{ route('admin.usuario.index') }}" class="btn btn-#1e88e5 blue darken-1 buttonText">Atras <i class="material-icons right ">arrow_back</i></a>
                    </div>
                </div>
            </form>
            <br>
        </div>
    </div>
</div>

@endsection

