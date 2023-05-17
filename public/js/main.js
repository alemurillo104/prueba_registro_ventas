

function getFecha() {
    var dateObj = new Date();
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    var day = dateObj.getUTCDate();
    var year = dateObj.getUTCFullYear();

    newdate = day + "/" + month + "/" + year;
    // newdate = year + "/" + month + "/" + day;
    return newdate;
}

function getFechaF() {
    var dateObj = new Date();
    var month = dateObj.getUTCMonth() + 1; //months from 1-12
    var day = dateObj.getUTCDate();
    var year = dateObj.getUTCFullYear();

    // newdate = day + "-" + month + "-" + year;
    newdate = year + "-" + month + "-" + day;
    return newdate;
}



function cambiarModo() {
    var nav = document.getElementById('navitem');
    var ul = document.getElementById('slide-out');

    var navcolor = '';
    var valorStyle = '';

    if ($("#swModo").is(':checked')) {
        console.log('SI esta check entonces es claro')
        // console.log('SI esta check entonces es oscuro')
        valorStyle = "font-family:vendana; background-color: #FFFFFF";
        navcolor = "#f44336 red";

    }else{
        console.log('no esta check entonces es oscuro')
        valorStyle = "font-family:vendana; background-color: #587DBE; color: #FFFFFF";
        navcolor = "#000000 black";
        // console.log('no esta check entonces es claro')
    }

    nav.className = navcolor;
    ul.style = valorStyle;
    //ejecutaria un ajax 
    $.ajax({
        url: '/usuario/modo',
        method: "GET",
        data:{
            color: navcolor,
            valorStyle : valorStyle,
            _token: $('input[name="_token"]').val()
        },
        success: function (data) {
            console.log("length= "+ data);
        }
    })

}


function clicks() {
    console.log('omggg');
    var nav = document.getElementById('navitem');
    nav.className = "#eeff41 lime accent-2";
}


function cambiarTema() {
    var nav = document.getElementById('navitem');
    //ul
    var ul = document.getElementById('slide-out');

    var seleccion = document.getElementById('temaid');
    var color = '';
    var stylesUrl = '';
    // console.log(seleccion);
    if($('#temaid1').is(":checked")){
        console.log('temaid1')
        //la configuracion de Adulto

        color = "#039be5 light-blue darken-1";
        stylesUrl = "stylesAdulto";
        valorStyle = "font-family:vendana; background-color: #E0E0E0";

        
    }else if($('#temaid2').is(":checked")){
        console.log('temaid2')
        //la configuracion de Joven
        
        color = "#ffe0b2 orange lighten-4";
        stylesUrl = "stylesJoven";
        valorStyle = "font-family:courier; background-color: #F1E4E4";

        
    }else if($('#temaid3').is(":checked")){
        console.log('temaid3')
        //la configuracion de Niño

        color = "#d1c4e9 deep-purple lighten-4";
        stylesUrl = "stylesNino";
        valorStyle = "font-family:arial; background-color: #F5F5F5";
        
    }else{
        console.log('default')
        color = "#000000 black";
        stylesUrl = "stylesAdulto";
        valorStyle = "font-family:arial; background-color: #D9DBDB";
    }

    nav.className = color;
    ul.style = valorStyle;
    //ejecutaria un ajax 
    $.ajax({
        url: '/usuario/config',
        method: "GET",
        data:{
            color: color,
            stylesUrl : stylesUrl,
            valorStyle : valorStyle,
            _token: $('input[name="_token"]').val()
        },
        success: function (data) {
            console.log("length= "+ data);
        }
    })

}