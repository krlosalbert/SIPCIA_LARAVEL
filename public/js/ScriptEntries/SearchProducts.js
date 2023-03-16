/* function searchProducts(){ 

    var search= document.getElementById('search').value;

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
    });
    $.ajax({
        data: search,
        url: 'SearchProducts',
        type: 'POST',
    
        beforesend: function()
        {
        $('#ShowMsg').html("Mensaje antes de Enviar");
        },

        success: function(mensaje)
        {
        $('#ShowMsg').html(mensaje);
        }
    });
} */


$(document).ready(function() {
    $('#exampleModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Botón que activó el modal
        var id = button.data('id'); // Extraer el valor del atributo data-id
        var modal = $(this);
        modal.find('#id').val(id); // Actualizar el valor del input id en el formulario
        var modalTitle = $(this).find('.modal-title') // Obtener el título del modal
        modalTitle.text('Agregar Cantidad del producto ') // Actualizar el texto del título
    });
});