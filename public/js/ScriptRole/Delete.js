function DeleteRole(x){
   
    swal({
        title: "¿Estas Seguro?",
        text: "Una vez eliminado no se puede acceder a la informacion",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {

            swal("Listo!", "Rol Eliminado con Exito!", "success")
            .then((value) => {
                window.location.replace('?action=/DeleteRole&id='+x);
            }) 
        }
    });
}