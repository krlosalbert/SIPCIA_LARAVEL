//llamo los campos por sus id y le asigno variables
/*const userCedula = document.getElementById("cedula");
const userName = document.getElementById("name");
const userLastName = document.getElementById("lastName");
const userEmail = document.getElementById("email");
const userRole = document.getElementById("role");
const userAddres = document.getElementById("addres");
const userPhone = document.getElementById("phone");
const userPassword = document.getElementById("password");
const userRepeatPassword = document.getElementById("repeatPassword");

//llamo los respectivos alerts por id y le asigno variables
const alertSuccess = document.getElementById("alertSuccess");
const alertDanger = document.getElementById("alertDanger");
const alertCedula = document.getElementById("alertCedula");
const alertName = document.getElementById("alertName");
const alertLastName = document.getElementById("alertLastName");
const alertPhone = document.getElementById("alertPhone");
const alertAddres = document.getElementById("alertAddres");
const alertRole = document.getElementById("alertRole");
const alertEmail = document.getElementById("alertEmail");
const alertPassword = document.getElementById("alertPassword");
const alertRepeatPassword = document.getElementById("alertRepeatPassword");

// uso las expresiones regulares para poder validar bien las contraseñas
const regUserCedula = /^\d+$/;
const regUserName = /^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/;
const regUserLastName = /^[A-Za-zÑñÁáÉéÍíÓóÚúÜü\s]+$/;
const regUserEmail = /^[a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,15})$/;
const regUserPhone = /^\d+$/;
const regUserAddres = /[A-Za-z0-9]/;
const regUserPassword = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])([A-Za-z\d$@$!%*?&]|[^ ]){8,15}$/;

//declaro la alerta de error por si las contraseñas no cumplen con lo requerido
const showErrPasword = () => {
    alertDanger.classList.remove("d-none");
};

//asigno la funcion para pintar los respectivos mensajes de error
const pintarMensajeError = (errores) => {
    errores.forEach((item) => {
        item.tipo.classList.remove("d-none");
        item.tipo.textContent = item.msg;
    });
};

//llamo al evento listener para evitar el envio del formulario y hacer la respectiva validacion
$('#form').submit(function(e){
    e.preventDefault();

    //declaro el array que me va a contener las diferentes alertas
    const errores = [];

    // validar cedula
    if (!regUserCedula.test(userCedula.value) || !userCedula.value.trim()) {
        userCedula.classList.add("is-invalid");

        errores.push({
            tipo: alertCedula,
            msg: "Formato no válido campo Cedula, solo numeros",
        });
    } else {
        userCedula.classList.remove("is-invalid");
        userCedula.classList.add("is-valid");
        alertCedula.classList.add("d-none");
    }

    // validar nombre
    if (!regUserName.test(userName.value) || !userName.value.trim()) {
        userName.classList.add("is-invalid");

        errores.push({
            tipo: alertName,
            msg: "Formato no válido campo nombre, solo letras",
        });
    } else {
        userName.classList.remove("is-invalid");
        userName.classList.add("is-valid");
        alertName.classList.add("d-none");
    }
    // validar Apellido
    if (!regUserLastName.test(userLastName.value) || !userLastName.value.trim()) {
        userLastName.classList.add("is-invalid");

        errores.push({
            tipo: alertLastName,
            msg: "Formato no válido campo Apellido, solo letras",
        });
    } else {
        userLastName.classList.remove("is-invalid");
        userLastName.classList.add("is-valid");
        alertLastName.classList.add("d-none");
    }

    // validar email
    if (!regUserEmail.test(userEmail.value) || !userEmail.value.trim()) {
        userEmail.classList.add("is-invalid");

        errores.push({
            tipo: alertEmail,
            msg: "Escriba un correo válido",
        });
    } else {
        userEmail.classList.remove("is-invalid");
        userEmail.classList.add("is-valid");
        alertEmail.classList.add("d-none");
    }
    //pregunto si la variable existe porque depende el formulario se va a usar
    if(userRole){
        var role = userRole.options[userRole.selectedIndex].value;
        
        // validar Role
        if (role != 0) {
            userRole?.classList.remove("is-invalid");
            userRole?.classList.add("is-valid");
            alertRole?.classList.add("d-none");
        } else {
            userRole.classList.add("is-invalid");
    
            errores.push({
                tipo: alertRole,
                msg: "Seleccione un Rol",
            });
        }
    }

    // validar telefono
    if (!regUserPhone.test(userPhone.value) || !userPhone.value.trim()) {
        userPhone.classList.add("is-invalid");

        errores.push({
            tipo: alertPhone,
            msg: "Formato no válido campo Telefono, solo numeros",
        });
    } else {
        userPhone.classList.remove("is-invalid");
        userPhone.classList.add("is-valid");
        alertPhone.classList.add("d-none");
    }

    // validar direccion
    if (!regUserAddres.test(userAddres.value) || !userAddres.value.trim()) {
        userAddres.classList.add("is-invalid");

        errores.push({
            tipo: alertAddres,
            msg: "Formato no válido campo Direccion, solo letras, - , numeros",
        });
    } else {
        userAddres.classList.remove("is-invalid");
        userAddres.classList.add("is-valid");
        alertAddres.classList.add("d-none");
    }

    // validar contraseña
    if (!regUserPassword.test(userPassword.value) || !userPassword.value.trim()) {
        userPassword.classList.add("is-invalid");

        errores.push({
            tipo: alertPassword,
            msg: showErrPasword(),
        });
    } else {
        userPassword.classList.remove("is-invalid");
        userPassword.classList.add("is-valid");
        alertPassword.classList.add("d-none");
    }

    // validar confirmacion de contraseña
    if (userPassword.value != userRepeatPassword.value) {

        userPassword.classList.add("is-invalid");
        userRepeatPassword.classList.add("is-invalid");

        errores.push({
            tipo: alertPassword,
            msg: "Contraseñas no coinciden",
        });
        errores.push({
            tipo: alertRepeatPassword,
            msg: "Contraseñas no coinciden",
        });

    } else {
        userPassword.classList.remove("is-invalid");
        userPassword.classList.add("is-valid");
        alertPassword.classList.add("d-none");
        alertDanger.classList.add("d-none");

        userRepeatPassword.classList.remove("is-invalid");
        userRepeatPassword.classList.add("is-valid");
        alertRepeatPassword.classList.add("d-none");
    }

    //pregunto para poder pintar los diferentes mensajes de error
    if (errores.length !== 0) {
        pintarMensajeError(errores);
        return;
    }else{*/

   /* $('.btn-register').click(function (e) {
        e.preventDefault();
        swal("Listo!", "Usuario Guardado con Exito!", "success")
            .then((value) => {
                $(this).submit();
            }) 
    });*/
 //   }
//});