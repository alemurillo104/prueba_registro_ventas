@extends('layouts.app')

@section('content')

@if($errors->any())
    <div class="msg msg-error"> {{$errors->first()}} </div>
@endif

    <div class="col s12 ">
        <div class="card myCreateCard"  >
            <div class="row s12">
                <h4 class="center-align  createTitle ">Registrar Venta</h4>
                <form name="myForm" action="{{route('admin.sell.store')}}" method="POST">
                    <br><hr>
                    <div class="row">
                        <div class="col s12 m4 l4 xl3">
                            <label for="id_user">Cliente<sup>*</sup></label>
                            <select name="id_user" id="id_user"  required="" oninvalid="setCustomValidity('Debe escoger al cliente')" oninput="setCustomValidity('')"
                                class="browser-default td-text" type="number">
                                <option value="" disabled selected>Seleccione un cliente</option>
                                @foreach($users as $usuario)
                                <option value="{{$usuario->id}}" >{{$usuario->name}} </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col s12 m4 l4 xl2">
                            <div class="form-group">
                                <label for="fecha">Fecha: <sup>*</sup></label>
                                <input type="date" max="2050-12-31" min="<?= date('Y-m-d'); ?>" value="<?= date('Y-m-d'); ?>" name="fecha" class="form-control form-control-lg" required="" oninvalid="setCustomValidity('Debe colocar la fecha actual!')" oninput="setCustomValidity('')">
                            </div>
                        </div>
                        <div class="col s12 m4 l4 xl7">
                            <div class="form-group">
                                <label for="observation">Observación: <sup>*</sup></label>
                                <input type="text" name="observation" >
                            </div>
                        </div>
                    </div>
        
                   <div class="row">
                        <hr> <p class="center-align presupuestoCreateTitle " ><b>BUSCADOR DE PRODUCTOS</b></p> <hr> <br>

                        <div class="col s12 m4 l3 xl4">
                            <label for="id_product">Producto: <sup>*</sup></label>
                            <select disabled class="browser-default td-text" id="id_product" name="id_product" onchange="productSelected({{ $products }});">
                                <option value="" disabled selected>Seleccionar:</option>
                                @foreach($products as $product)
                                <option value="{{$product->id}}">{{$product->name}}</option>
                                @endforeach
                            </select>
                       </div>
                        <div class="col s12 m2 l3 xl2">
                            <label for="precio">Precio($us):</label>
                            <input disabled class="center-align td-text" type="number" id="precio" placeholder="Ejm: 100" name="precio"  required="">
                       </div>
                        <div class="col s12 m2 l2 xl1">
                            <label for="cantidad">Cantidad:</label>
                            <input type="number" disabled class="center-align td-text" type="text" id="cantidad" placeholder="Ejm: 1" name="cantidad" value="{{ 1 }}"  required>
                       </div>
                        <div class="col s12 m3 l3 xl2" >
                            <label for="subtotal">Subtotal($us):</label>
                            <select  class="browser-default" id="subtotal" name="subtotal[]" >
                            </select>
                       </div>
                        <div class="col s12 m5 l4 xl3 center-align input-field inline" style="padding-top: 20px;">
                            <a disabled onclick="return addItemTabla(id,{{ $products }})" id="agregar" name="agregar" class="buttonText waves-light btn tiny agregar #1e88e5 blue darken-1">Agregar</a>
                            <a disabled  onclick="return editPrecioTablaId(id)"  id="editar2" name="editar2" class="buttonText waves-light btn tiny editar2  #f9a825 yellow darken-3">Editar</a>
                            <a id="borrar" onclick="return limpiarBuscadorSC()" name="borrar" class=" buttonText waves-light btn tiny borrar #311b92 deep-purple darken-4 ">Limpiar</a>
                        </div>
                   </div>
        
                    <div class="row">
                        <div class="card presupuestoCard ">
                        <hr> <p class="center-align presupuestoCreateTitle" ><b>DETALLE DE VENTA</b></p> <hr> <br>

                        <table class="bordered responsive-table border-box " cellspacing="0" width="100%" id="detalleTabla">
                            <thead>
                                <tr>
                                    <th class="center-align th-text"style="width: 100px" > # </th>
                                    <th class="center-align th-text" >Producto </th>
                                    <th class="center-align th-text"  style="width: 100px">Precio($us) </th>
                                    <th class="center-align th-text"  style="width: 100px">Cantidad </th>
                                    <th class="center-align th-text"  style="width: 100px">Subtotal </th>
                                    <th class="center-align th-text" style="width: 100px">Acciones </th>
                                </tr>
                            </thead>
                            <tbody id="tuplas_detalles" > 
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>-</td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>

                            <tfoot class="footer">
                                <tr>
                                    <td colspan="3"></td>
                                    <td class="center-align" colspan="1"><small><b>TOTAL ($us)</b></small></td>
                                    <td class="center-align" >
                                        <input disabled class="center-align" type="number" min="0" max="100" id="total" name="total" value="{{ 0 }}" > 
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                    </div>
                   
                    <div class="row">
                        <input type="submit" class="btn btn-success #01579b light-blue darken-4 buttonText" value="Guardar">
                        <a href="{{ route('admin.sell.index') }}" class="btn btn-#1e88e5 blue darken-1 buttonText">Atras <i class="material-icons right ">arrow_back</i></a>
                    </div>
                </form>
            </div>
        </div>
    </div> 
  

@endsection

@section('astylesJS')

    <script>
        var i = 1;
        var items = [];
        
        //Usuario Seleccionado
        $('#id_user').change(function() {
            $('#id_product').prop('disabled', false);
        })

        //Producto Seleccionado
        function productSelected(datos) {

            limpiarBuscadorSC();

            var id = $('#id_product').val();
            var producto = datos.find(p => p.id == id);

            $('#precio').prop('disabled', false);
            $('#precio').val(producto.price); //idk
            $('#cantidad').prop('disabled', false);
            //obtengo la cantidad y añado el subtotal
        
            var cantidad = document.getElementById('cantidad').value;
            var subtotal = parseFloat(producto.price) * parseFloat(cantidad);
            $('#subtotal').append('<option value="'+subtotal+'">'+subtotal+'</option>');
            $("#agregar").removeAttr('disabled');

        }
       
       //Accion: actualizar cantidad
        $('#cantidad').on('change', function(e) {
            var nueva_cantidad = $(this).val();
            var precio = $('#precio').val();
            var subtotal = parseFloat(precio) * Number(nueva_cantidad);
            $('#subtotal').empty();
            $('#subtotal').append('<option value="'+subtotal+'">'+subtotal+'</option>');
        })

       //Accion: actualizar precio
        $('#precio').on('change', function(e) {
            var nuevo_precio = $(this).val();
            var cantidad = $('#cantidad').val();
            var subtotal = parseFloat(nuevo_precio) * Number(cantidad);
            $('#subtotal').empty();
            $('#subtotal').append('<option value="'+subtotal+'">'+subtotal+'</option>');
        })

       //Adicionar item a la tabla
        function addItemTabla(id, datos) {
            if (items.length == 0) {
                $('#detalleTabla tbody').empty(); 
            }

            var id = $('#id_product').val();
            var producto = datos.find(p => p.id == id);

            var precio = document.getElementById('precio').value;
            var cantidad = document.getElementById('cantidad').value;
            var subtotal = document.getElementById('subtotal');
            var subtotal_text= subtotal.options[subtotal.selectedIndex].text;

            var precioF = parseFloat(precio);
            var cantidadF = parseFloat(cantidad);
            var subtotalF = parseFloat(subtotal_text);

            $('#tuplas_detalles').append('\
                <tr  id="row'+i+'">\
                    <td class="center-align" style="width: 30px" > '+i+'</td>\
                    <td class="hide" style="width: 30px" >\
                        <label><input type="checkbox" class="filled-in" id="id_precio'+i+'"  value="'+datos[0].id+'" name="id_precio[]" checked="checked" /><span></span></label>\
                    </td>\
                    <td  class="hide" > <input  class="center-align" type="text" id="id_producto'+i+'" name="id_producto[]" value="'+producto.id+'"  required> </td>\
                    \
                    <td  class="hide" > <input  class="center-align" type="text" id="i_producto'+i+'" name="i_producto[]" value="'+producto.name+'"  required> </td>\
                    <td class="center-align td-text"> '+producto.name+' </td>\
                    \
                    <td class="center-align"> <div class="custom-select">\
                        <select class="browser-default center-align" id="i_precio'+i+'" name="i_precio[]"  >\
                            <option  value="'+precio+'" >'+precio+'</option>\
                        </select>\
                    </div></td>\
                    <td class="center-align"> <div class="custom-select">\
                        <select class="browser-default center-align" id="i_cantidad'+i+'" name="i_cantidad[]"  >\
                            <option value='+cantidad+'> '+cantidad+'</option>\
                        </select>\
                    </div></td>\
                    <td class="center-align"> <div class="custom-select">\
                        <select class="browser-default center-align" id="i_subtotal'+i+'" name="i_subtotal[]"   >\
                            <option value='+subtotal_text+'  >'+subtotal_text+'</option>\
                        </select>\
                    </div></td>\
                    <td class="center-align"> \
                        <a name="editar" id="'+i+'" value="'+datos[0].id+'" class=" center-align btn_edit btn-floating btn-small waves-effect waves-light #1e88e5 yellow darken-1 tooltipped" data-position="top" data-tooltip="Editar"><i class="tiny material-icons">edit</i></a>\
                        <a name="remove" id="'+i+'" class=" center-align btn_remove btn-floating btn-small waves-effect waves-light #1e88e5 red darken-1 tooltipped" data-position="top" data-tooltip="Eliminar"><i class="tiny material-icons">delete</i></a>\
                    </td>\
                </tr>\
            ');

            $('#id_product').prop('disabled', false);
            
            var nuevoDato = {
                i: i,
                id_product: producto.id,
                precio_t: precio,
                cantidad_t: cantidad,
                subtotal_t: subtotal_text
            };

            items.push(nuevoDato);

            //actualizo el total
            var valor = document.getElementById('total').value;
            var nuevo_total = parseFloat(subtotal_text) + Number(valor);
            $('#total').val(nuevo_total);

            limpiarBuscadorSC();
            i++;
        }

        //Actualizar item con nueva información a la tabla
        function editPrecioTablaId(id) {
            //recupero antes de cambiarlo
            var row_ant_subtotal = document.getElementById(`i_subtotal${actual_id_row_tabla}`).value;

            var precio = document.getElementById('precio').value;
            var cantidad = document.getElementById('cantidad').value;
            var subtotal = document.getElementById('subtotal');
            var subtotal_text = subtotal.options[subtotal.selectedIndex].text;

            var precioF = parseFloat(precio);
            var cantidadF = parseFloat(cantidad);
            var subtotalF = parseFloat(subtotal_text);


            $(`#i_precio${actual_id_row_tabla}`).empty();
            $(`#i_cantidad${actual_id_row_tabla}`).empty();
            $(`#i_subtotal${actual_id_row_tabla}`).empty();

            $(`#i_precio${actual_id_row_tabla}`).append('<option value=' + precio + ' >' + precio + '</option>');
            $(`#i_cantidad${actual_id_row_tabla}`).append('<option value=' + cantidad + ' >' + cantidad + '</option>');
            $(`#i_subtotal${actual_id_row_tabla}`).append('<option value=' + subtotal_text + ' >' + subtotal_text + '</option>');

            var valor = document.getElementById('total').value;
            var nuevo_total = parseFloat(valor) - parseFloat(row_ant_subtotal);

            nuevo_total = parseFloat(nuevo_total) + parseFloat(subtotal_text);
            $('#total').val(nuevo_total);
            limpiarBuscadorSC();
        }

        //Remover item de la tabla
        $(document).on('click', '.btn_remove', function(){  

            var button_id = $(this).attr("id");   

            //obtener valor a restar
            var row_subtotal = document.getElementById(`i_subtotal${button_id}`).value;

            //restar en el subtotal
            var valor = document.getElementById('total').value;
            var nuevo_total = parseFloat(valor) - parseFloat(row_subtotal);
            $('#total').val(nuevo_total);

            items = items.filter(item => ( item.i != button_id) );

            limpiarBuscadorSC();

            $('#row'+button_id+'').remove();
        });

        //Editar y rellenar los selects con esta información
        $(document).on('click', '.btn_edit', function () {
            var button_id = $(this).attr("id");

            actual_id_row_tabla = button_id;

            var precio = $(`#i_precio${button_id}`).val();
            var cantidad = $(`#i_cantidad${button_id}`).val();
            var subtotal = $(`#i_subtotal${button_id}`).val();

            limpiarBuscadorSC(); 

            $('#precio').val(precio);
            $('#precio').prop('disabled', false);
            $('#cantidad').val(cantidad);
            $('#cantidad').prop('disabled', false);
            $('#subtotal').append('<option value="i_subtotal' + button_id + '">' + subtotal + '</option>');

            $("#editar2").removeAttr('disabled');
        });

        //Limpiar buscador

        function limpiarBuscadorSC() {
            $('#precio').val('');
            $('#precio').prop('disabled', true);
            $('#cantidad').val(1);
            $('#cantidad').prop('disabled', true);
            $('#subtotal').empty();

            $("#agregar").attr('disabled', true);
            $("#editar2").attr('disabled', true);
        }

    </script>
@endsection
    