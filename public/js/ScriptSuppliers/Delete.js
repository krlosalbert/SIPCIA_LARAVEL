$('.btn-delete').click(function (e) {
    e.preventDefault();
    var id = $(this).data('id');
    swal({
        title: "¿Estas Seguro?",
        text: "Una vez eliminado no se puede acceder a la informacion",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
    .then((willDelete) => {
        if (willDelete) {
            swal("Listo!", "Proveedor Eliminado con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                 });
                $.ajax({
                    url: 'DeleteSuppliers/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/ViewSuppliers'); 
                        } else {
                            swal('Error!','The record could not be deleted.','error');
                        }
                    }
                });
            }) 
        }
    });
    
});