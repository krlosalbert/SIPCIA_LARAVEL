//para activar el modal y buscar los productos
$(document).ready(function() {
    $('#buscar-btn').click(function() {
        var search = $('#search').val();
        $.ajax({
            type: "GET",
            url: "/SearchProducts",
            data: { search: search },
            success: function(response) {
            $('#searchs-products #body').html(response);
            }
        });
    });
});

//para mostrar el modal y solicitar la cantidad
$(document).ready(function() {
    $('#amount').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var id = button.data('id'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#id').val(id); // Actualizar el valor del input id en el formulario
    });
});

//modal para visualizar los detalles de las entradas
$(document).ready(function() {
    $('.details-btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/details_entries",
            data: { id: id },
            success: function(response) {
                $('#details-entries #body').html(response);
                console.log(response);
            }
        });
    });
});


//modal para modificar las entradas
$(document).ready(function() {
    $('.update_btn').click(function() {
        var id = $(this).closest('button').data('id'); // obtener el valor de "data-id"
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "post",
            url: "/ReadUpdateEntries",
            data: { id: id },
            success: function(response) {
                $('#update_entries #body').html(response);
            }
        });
    });
});

//script para eliminar las entradas
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

            swal("Listo!", "Entrada Eliminada con Exito!", "success")
            .then((value) => {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: 'DeleteEntries/' + id,
                    type: 'DELETE',
                    success: function (data) {
                        if (data.success) {
                            window.location.replace('/ViewEntries'); 
                        } else {
                            swal('Error!','The record could not be deleted.','error');
                        }
                    }
                });
            }) 
        }
    });
});