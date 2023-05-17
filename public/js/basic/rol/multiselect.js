$(document).ready(function(){
    $('select').formSelect();
});

$("input[name='acceso']").change(function(val){

    var acceso = $("input[name='acceso']:checked").val();
    console.log( acceso );

    $.ajax({
        url:"{{url('getPermisosAcceso')}}",
        method: "POST",
        data:{
            acceso : acceso,
            _token: $('input[name="_token"]').val()
        },
    }).done(function(resp){
        console.log(resp);
        resp = JSON.parse(resp);
        if (resp.ok) {
            console.log(resp.data);
            permisos = JSON.parse(resp.data);

            $('#permisos').empty();
            $('#permisos').append('<option selected="" disabled="" >Seleccione los permisos: </option>');

            $.each(permisos, function(i,permiso){
                $('#permisos').append('<option value="'+permiso.id+'">'+permiso.descripcion+'</option>');
                $('#permisos').formSelect();
            });
            
        }else{
            console.log(resp.msg);
        }
        
    })
});