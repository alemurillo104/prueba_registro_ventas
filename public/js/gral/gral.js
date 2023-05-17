
    function dateFormat(fecha) {
        var GMT_BO = "T00:00:00-04:00"; //GMT-4
        var d = new Date(`${fecha}${GMT_BO}`);
        var datestring = ("0" + d.getDate()).slice(-2) + "-" + ("0"+(d.getMonth()+1)).slice(-2) + "-" + d.getFullYear();
        return datestring;
    }


    function compareTime(time1, time2) {
        return new Date(time1) > new Date(time2);
    }

    function setCurrentDate(){
        var now = new Date();
        var day = ("0" + now.getDate()).slice(-2);
        var month = ("0" + (now.getMonth() + 1)).slice(-2);
        var today = now.getFullYear() + "-" + (month) + "-" + (day);
        return today;
    }

    //creo que este puede bloquear o limpiar TODOS los toasts de la app de todos los usuarios CUIDADO

    function clearToasts() {
        M.Toast.dismissAll();
    }

    function displayToastMessage(mensaje) {
        var toastHTML = `<span>${mensaje}</span><button onclick="return clearToasts();" class="btn-flat toast-action">OK</button>`;
        M.toast({html: toastHTML,  classes: 'rounded'});
    }