//modal para modificar las entradas
$(document).ready(function() {
    $('.update_invoice_btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        /* console.log(id); */
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "get",
            url: '/ReadUpdateInvoices/'+id,
            /* data: { id: id }, */
            success: function(response) {
                $('#update_invoices #body').html(response);
                console.log(response);
            }
        });
    });
});


//modal para eleminar la factura
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

            swal("Listo!", "Factura Eliminada con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'DeleteInvoices/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/ViewInvoices'); 
                        } else {
                            swal('Error!','The record could not be deleted.','error');
                        }
                    }
                });
            }) 
        }
    });
});