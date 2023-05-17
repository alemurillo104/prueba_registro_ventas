// console.log('holiwis desde core cotizacion create');

var actual_id_row_tabla = -1;

var actual_id_tamanio = -1;

var i = 1;

var datos = [];

var items = [];

function clearToasts() {
    M.Toast.dismissAll();
}

function displayToastMessage(mensaje) {
    var toastHTML = `<span>${mensaje}</span><button onclick="return clearToasts();" class="btn-flat toast-action">OK</button>`;
    M.toast({html: toastHTML,  classes: 'rounded'});
}

function validarItemsDiferentes(datoItem) {

    if (items.length != 0) {
        
        const resp = items.filter( item => ( item.id_servicio == datoItem.id_servicio ) );
        return (resp.length != 0) ; // Si es != 0 = Existe, Si es 0 = No existe 
    }
    //si es 0, lo añado nomas
    return false;
}

function validarPreciosValidos(precioT, cantidadT, subtotalT) {

    var msg = '';

    if (isNaN(precioT) || precioT == 0) {
        msg = (isNaN(precioT)) 
            ? 'Debe introducir un precio válido!'
            : 'El precio debe ser mayor a 0!';

    }else if(isNaN(cantidadT)  || cantidadT == 0){
        msg = (isNaN(cantidadT)) 
            ? 'Debe introducir una cantidad válida [mayor a 1]!'
            : 'La cantidad debe ser mayor a 0!';
        
    }else if(isNaN(subtotalT) || subtotalT == 0){
        msg = (isNaN(subtotalT)) 
            ? 'Debe introducir una precio y cantidad válida [mayor a 1]!'
            : 'El subtotal debe ser mayor a 0!';
    }

    return msg;
}

function editPrecioTablaId(id) {
    console.log(id);
    console.log('actual_id_row_tabla= ', actual_id_row_tabla);

    //recupero antes de cambiarlo
    var row_ant_subtotal = document.getElementById(`i_subtotal${actual_id_row_tabla}`).value;

    var precio   = document.getElementById('precio').value;
    var cantidad = document.getElementById('cantidad').value;
    var subtotal = document.getElementById('subtotal');
    var subtotal_text= subtotal.options[subtotal.selectedIndex].text;

    var precioF = parseFloat(precio);
    var cantidadF = parseFloat(cantidad);
    var subtotalF = parseFloat(subtotal_text);

    var mensaje = validarPreciosValidos(precioF, cantidadF, subtotalF);

    if(mensaje != '') {
        // alert(mensaje);
        displayToastMessage(mensaje);
    }else{

        $(`#i_precio${actual_id_row_tabla}`).empty();
        $(`#i_cantidad${actual_id_row_tabla}`).empty();
        $(`#i_subtotal${actual_id_row_tabla}`).empty();

        $(`#i_precio${actual_id_row_tabla}`).append('<option value='+precio+' >'+precio+'</option>');
        $(`#i_cantidad${actual_id_row_tabla}`).append('<option value='+cantidad+' >'+cantidad+'</option>');
        $(`#i_subtotal${actual_id_row_tabla}`).append('<option value='+subtotal_text+' >'+subtotal_text+'</option>');

        var valor = document.getElementById('subtotal_total').value;
        var nuevo_tsubtotal = parseFloat(valor) - parseFloat(row_ant_subtotal);

        nuevo_tsubtotal = parseFloat(nuevo_tsubtotal) + parseFloat(subtotal_text);
        $('#subtotal_total').val(nuevo_tsubtotal);

        //actualizo el total tambien lol
        var descuento = $('#descuento').val();
        var total = parseFloat(nuevo_tsubtotal) - Number(descuento);

        if (total < 0) {
            // alert('El total no puede ser menor a cero!'); 
            displayToastMessage('El total no puede ser menor a cero!');

            $('#descuento').val(0);
            $('#total').val(nuevo_tsubtotal); //creo

        }else{
            $('#total').val(total);
        }
         
        limpiarBuscadorSC();
    }
}



function addPrecioTabla(id) {
    console.log('datos antes de agregar a tabla detalle = ',datos);
    
    var precio = document.getElementById('precio').value;
    var cantidad = document.getElementById('cantidad').value;
    var subtotal = document.getElementById('subtotal');
    var tipo = document.getElementById('tipo');
    var subtotal_text= subtotal.options[subtotal.selectedIndex].text;
    var tipo_text= tipo.options[tipo.selectedIndex].text;

    var precioF = parseFloat(precio);
    var cantidadF = parseFloat(cantidad);
    var subtotalF = parseFloat(subtotal_text);

    var mensaje = validarPreciosValidos(precioF, cantidadF, subtotalF);

    mensaje = (validarItemsDiferentes(datos[0])) ? 'El servicio ya esta en su detalle de cotizacion' : '';

    if(mensaje != '') {
        // alert(mensaje);
        // clearToasts();
        displayToastMessage(mensaje);
    }else{

        $('#tuplas_detalles').append('\
            <tr  id="row'+i+'">\
                <td class="center-align" style="width: 30px" > '+i+'</td>\
                <td class="hide" style="width: 30px" >\
                    <label><input type="checkbox" class="filled-in" id="id_precio'+i+'"  value="'+datos[0].id+'" name="id_precio[]" checked="checked" /><span></span></label>\
                </td>\
                <td  class="hide" > <input  class="center-align" type="text" id="id_servicio'+i+'" name="id_servicio[]" value="'+datos[0].id_servicio+'"  required> </td>\
                \
                <td  class="hide" > <input  class="center-align" type="text" id="i_servicio'+i+'" name="i_servicio[]" value="'+datos[0].servicio_descripcion+'"  required> </td>\
                <td class="center-align td-text"> '+datos[0].servicio_descripcion+' </td>\
                \
                <td  class="hide" > <input  class="center-align" type="text" id="i_grado'+i+'" name="i_grado[]" value="'+datos[0].grado_descripcion+'"  required> </td>\
                <td class="center-align td-text">'+datos[0].grado_descripcion+'</td>\
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
                <td  class="hide" > <input  class="center-align" type="text" id="i_tipo'+i+'" name="i_tipo[]" value="'+tipo_text+'"  required> </td>\
                <td class="center-align td-text">'+tipo_text+'</td>\
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

        $('#id_categoria').prop('disabled', false);
        
        var nuevoDato = {
            ...datos[0],
            i: i,
            id_precio: datos[0].id,
            precio_t: precio,
            cantidad_t: cantidad,
            subtotal_t: subtotal_text
        };

        items.push(nuevoDato);
        console.log('nuevos items= ', items);

        //actualizo el subtotal_total
        var valor = document.getElementById('subtotal_total').value;
        var nuevo_tsubtotal = parseFloat(subtotal_text) + Number(valor);
        $('#subtotal_total').val(nuevo_tsubtotal);

        $('#descuento').prop('disabled', false);

        //actualizo el total tambien lol
        var descuento = $('#descuento').val();
        var total = parseFloat(nuevo_tsubtotal) - Number(descuento);
        $('#total').val(total);


        limpiarBuscadorSC();
        i++;
    }
}

$(document).on('click', '.btn_remove', function(){  

    var button_id = $(this).attr("id");   

    //obtener valor a restar
    var row_subtotal = document.getElementById(`i_subtotal${button_id}`).value;

    //restar en el subtotal
    var valor = document.getElementById('subtotal_total').value;
    var nuevo_tsubtotal = parseFloat(valor) - parseFloat(row_subtotal);
    $('#subtotal_total').val(nuevo_tsubtotal);

    //actualizo el total tambien lol
    var descuento = $('#descuento').val();
    var total = parseFloat(nuevo_tsubtotal) - Number(descuento);

    if (total < 0) {
        $('#descuento').val(0);
        $('#total').val(nuevo_tsubtotal); //creo

    }else{
        $('#total').val(total);
    }

    items = items.filter(item => ( item.i != button_id) );

    limpiarBuscadorSC();

    $('#row'+button_id+'').remove();
});

//boton editar y rellenar los selects con esta info
$(document).on('click', '.btn_edit', function(){  
    var button_id = $(this).attr("id");   

    actual_id_row_tabla = button_id;

    var servicio = $(`#i_servicio${button_id}`).val() ;
    var grado    = $(`#i_grado${button_id}`).val() ;
    var precio   = $(`#i_precio${button_id}`).val() ;
    var cantidad = $(`#i_cantidad${button_id}`).val() ;
    var subtotal = $(`#i_subtotal${button_id}`).val() ;
    var tipo     = $(`#i_tipo${button_id}`).val() ;

    limpiarBuscadorSC(1); //TODO: Probar

    $('#id_servicio').append('<option value="i_servicio'+button_id+'">'+servicio+'</option>');
    $('#id_grado')   .append('<option value="i_grado'+button_id+'">'+grado+'</option>');
    $('#precio')     .val(precio);
    $('#precio')     .prop('disabled', false);
    $('#cantidad')   .val(cantidad);
    $('#cantidad')   .prop('disabled', false);
    $('#subtotal')   .append('<option value="i_subtotal'+button_id+'">'+subtotal+'</option>');
    $('#tipo')       .append('<option value="i_tipo'+button_id+'">'+tipo+'</option>');

    $("#editar2").removeAttr('disabled');
});


//Escoger cliente
$('#id_cliente').change(function() {

    $('#id_categoria').prop('disabled', false);
    limpiarBuscadorSC();

    var id_cliente = $(this).val();

    $.ajax({
        url:'/cliente/getVehiculosCliente',
        // url:"{{ route('admin.cliente.vehiculo')}}", //Es sintaxis de blade y cono el archivo no es .blade.php no lo reconoce y parsea mal
        method: "POST",
        data:{
            id_cliente : id_cliente,
            _token: $('input[name="_token"]').val()
        },
    }).done(function(resp){

        resp = JSON.parse(resp);
        console.log(resp);
        if (resp.ok) {
            vehiculos = JSON.parse(resp.data);
            $('#id_vehiculo').empty();
            $('#id_tamanio').empty();
            $('#cotizacionTabla tbody').empty(); //Reinicia toda la tabla porque es otro precio

            $('#id_vehiculo').append('<option selected="" disabled="" >Seleccione el vehiculo: </option>');

            $.each(vehiculos, function(i,vehiculo){
                $('#id_vehiculo').append('<option value="'+vehiculo.id+'">'+vehiculo.nro_placa+' - '+vehiculo.marca+' '+vehiculo.modelo+' ('+vehiculo.tamanio_abreviatura+') </option>');
                // $('#id_vehiculo').append('<option value="'+vehiculo.id+'">'+vehiculo.nro_placa+' - '+vehiculo.marca+' '+vehiculo.modelo+' </option>');
            });

        }else{
            // alert(resp.msg);
            displayToastMessage(resp.msg);
        }
    })
})

//Escoger vehiculo
$('#id_vehiculo').change(function() {

    $('#id_categoria').prop('disabled', false);
    limpiarBuscadorSC();

    var id_vehiculo = $(this).val();

    $.ajax({
        url:'/vehiculo/getTamanioByIdVehiculo',
        // url:"{{ route('admin.vehiculo.tamanio')}}",
        method: "POST",
        data:{
            id_vehiculo : id_vehiculo,
            _token: $('input[name="_token"]').val()
        },
    }).done(function(resp){

        resp = JSON.parse(resp);
        console.log(resp);
        if (resp.ok) {
            tamanio = JSON.parse(resp.data);

            if (actual_id_tamanio != tamanio.id) {
                actual_id_tamanio = tamanio.id;
                
                $('#id_tamanio').empty(); 
                $('#id_tamanio').append('<option value="'+tamanio.id+'">'+tamanio.nombre+'</option>');
                $('#cotizacionTabla tbody').empty(); //Reinicia toda la tabla porque es otro precio
            }

        }else{
            // alert(resp.msg);
            displayToastMessage(resp.msg);
        }
    })
})

//Escoger categoria
$('#id_categoria').change(function() {

    //reinicio
    limpiarBuscadorSC(1);

    var id_vehiculo = document.getElementById('id_vehiculo').value;
    var id_categoria = $(this).val(); 

    //buscar servicios con esa id_categoria

    $.ajax({
        url:'/servicio/all',
        // url:"{{ route('admin.servicio.idcategoria')}}",
        method: "POST",
        data:{
            id_categoria : id_categoria,
            id_vehiculo : id_vehiculo,
            _token: $('input[name="_token"]').val()
        },
    }).done(function(resp){

        resp = JSON.parse(resp);
        if (resp.ok) {
            servicios = JSON.parse(resp.data);

            $('#id_servicio').append('<option selected="" disabled="" >Seleccione los servicios: </option>');

            $.each(servicios, function(i,servicio){
                $('#id_servicio').append('<option value="'+servicio.id+'">'+servicio.descripcion+'</option>');
                $('#id_servicio').formSelect();
            });

        }else{
            // alert(resp.msg);
            displayToastMessage(resp.msg);
        }
    })
})

//Escoger servicio
$('#id_servicio').change(function() {
    
    var id_vehiculo = document.getElementById('id_vehiculo').value;
    var id_servicio = $(this).val(); 

    //reinicio
    limpiarBuscadorSC(2);
    //buscar servicios con esa id_categoria

    $.ajax({
        url:'/servicio/getServicioPrecioGrados',
        // url:"{{ route('admin.servicio.precio.grados')}}",
        method: "POST",
        data:{
            id_servicio : id_servicio,
            id_vehiculo : id_vehiculo,
            _token: $('input[name="_token"]').val()
        },
    }).done(function(resp){
        resp = JSON.parse(resp);
        if (resp.ok) {
            var arr = JSON.parse(resp.data);

            var tipo_str = (arr.servicio.tipo == 'G') ? 'General' : 'Por Pieza' ;
            //añado el tipo
            $('#tipo').append('<option selected="" disabled="" >Seleccione el tipo de servicio: </option>');
            $('#tipo').append('<option selected value="'+arr.servicio.id+'">'+tipo_str+'</option>');


            $('#id_grado').append('<option selected="" disabled="" >Seleccione el grado de daño: </option>');
            var unicoSelected = (arr.unico) ? 'selected' : '' ;

            $.each(arr.grados, function(i,grado){
                $('#id_grado').append('<option '+unicoSelected+' value="'+grado.id+'">'+grado.descripcion+'</option>');
                $('#id_grado').formSelect();
            });

            if (arr.unico) {  //un solo grado de danio

                console.log('debo desplegar los precios, porque solo tengo un solo grado');
                console.log(arr.precios);

                $.each(arr.precios, function(i,precio){
                    $('#precio').prop('disabled', false);
                    $('#precio').val(precio.precio); //idk
                    $('#cantidad').prop('disabled', false);
                    //obtengo la cantidad y añado el subtotal
                
                    var cantidad = document.getElementById('cantidad').value;
                    var subtotal = parseFloat(precio.precio) * parseFloat(cantidad);
                    $('#subtotal').append('<option value="'+subtotal+'">'+subtotal+'</option>');

                    $("#agregar").removeAttr('disabled');
                });

                datos = arr.precios;
                console.log('datos (Danio directo) = ', datos);
            }
        }else{
            // alert(resp.msg);
            displayToastMessage(resp.msg);
        }
    })
})

//Escoger grado
$('#id_grado').change(function () {

    var id_grado = $(this).val();
    var id_vehiculo = document.getElementById('id_vehiculo').value; //para tamanio
    var id_servicio = document.getElementById('id_servicio').value; 

    //reinicio
    limpiarBuscadorSC(3);

    $.ajax({
        url:'/servicio/getServicioPrecio',
        // url:"{{ route('admin.servicio.precio')}}",
        method: "POST",
        data:{
            id_servicio : id_servicio,
            id_vehiculo : id_vehiculo,
            id_grado : id_grado,
            _token: $('input[name="_token"]').val()
        },
    }).done(function(resp){

        resp = JSON.parse(resp);
        if (resp.ok) {

            var precios = JSON.parse(resp.data);
            datos = JSON.parse(resp.data);
            console.log('datos (escogiendo idgrado, despues de ajax) = ', datos);

            $.each(precios, function(i,precio){
                $('#precio').prop('disabled', false);
                $('#precio').val(precio.precio); //idk
                $('#cantidad').prop('disabled', false);
                //obtengo la cantidad y añado el subtotal
            
                var cantidad = document.getElementById('cantidad').value;
                var subtotal = parseFloat(precio.precio) * parseFloat(cantidad);
                $('#subtotal').append('<option value="'+subtotal+'">'+subtotal+'</option>');

                $("#agregar").removeAttr('disabled');
            });
        }else{
            // alert(resp.msg);
            displayToastMessage(resp.msg);
        }
    })
})

$(document).ready(function() {
    $('textarea#observacion').characterCounter();

    $('input:text[name="cantidad"]').keyup(function(ev){
        var cantidad = $(this).val();
        console.log('cantidad= ', cantidad);
        $("#cantidad").text(cantidad).trigger('change');
    })

    $('input:text[name="precio"]').keyup(function(ev){
        var precio = $(this).val();
        console.log('precio= ', precio);
        $("#precio").text(precio).trigger('change');
    })

    $('#descuento').keyup(function(ev){
        var descuento = $(this).val();
        console.log('descuento= ', descuento);
        $("#descuento").text(descuento).trigger('change');
    })

    $('#cantidad').on('change', function(e) {
        var nueva_cantidad = $(this).val();
        var precio = $('#precio').val();
        var subtotal = parseFloat(precio) * Number(nueva_cantidad);
        $('#subtotal').empty();
        $('#subtotal').append('<option value="'+subtotal+'">'+subtotal+'</option>');
    })

    $('#precio').on('change', function(e) {
        
        var nuevo_precio = $(this).val();
        var cantidad = $('#cantidad').val();
        var subtotal = parseFloat(nuevo_precio) * Number(cantidad);
        $('#subtotal').empty();
        $('#subtotal').append('<option value="'+subtotal+'">'+subtotal+'</option>');
    })

    $('#descuento').on('change', function(e) {
        
        var nuevo_descuento = $(this).val();
        var subtt = $('#subtotal_total').val();
        var total = parseFloat(subtt) - Number(nuevo_descuento);

        if (total < 0) {
            // alert('El total no puede ser menor a cero!');
            displayToastMessage('El total no puede ser menor a cero!');
            $('#descuento').val(0);
            $('#total').val(subtt);

        }else{
            $('#total').val(total);
        }
    })

});

function resizingObs() {
    M.textareaAutoResize($('#observacion'));
}

//Limpiar buscador

function limpiarBuscadorSC(opcion = 9) {
    console.log('limpiarBuscadorSC click');

    switch (opcion) {
        case 1: 
            $('#id_servicio').empty(); 
            $('#id_grado').empty();
            $('#tipo').empty(); //creo
            break;
        case 2: 
            $('#id_grado').empty(); 
            break;
        case 9: 
            $('#id_categoria').val(''); 
            $('#id_servicio').empty(); 
            $('#id_grado').empty();
            $('#tipo').empty(); //creo
            break;
        default:
            console.log('oki, ninguna opcion'); 
            break;
    }

    $('#precio').val('');
    $('#precio').prop('disabled', true);
    $('#cantidad').val(1);
    $('#cantidad').prop('disabled', true);
    // $('#tipo').empty(); //creo
    $('#subtotal').empty();

    $("#agregar").attr('disabled', true);
    $("#editar2").attr('disabled', true);
}
